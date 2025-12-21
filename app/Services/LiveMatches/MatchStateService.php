<?php

namespace App\Services\LiveMatches;

use App\Models\LiveMatches\LiveMatch;
use App\Models\User;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class MatchStateService
{
    /**
     * Получить текущее состояние матча (с кешированием)
     */
    public function getMatchState(int $matchId): ?array
    {
        // Используем Cache для быстрого доступа (с автоматическим fallback на file cache)
        $cacheKey = "live_match:{$matchId}";
        
        // Пытаемся получить из кеша
        $state = Cache::get($cacheKey);
        
        if ($state) {
            return $state;
        }

        // Если нет в кеше, загружаем из БД
        $liveMatch = LiveMatch::where('match_id', $matchId)
            ->where('status', '!=', 'finished')
            ->first();

        if (!$liveMatch) {
            return null;
        }

        $state = $this->buildState($liveMatch);
        
        // Кешируем на 1 минуту (Cache автоматически выберет доступный драйвер)
        Cache::put($cacheKey, $state, 60);

        return $state;
    }

    /**
     * Обновить состояние матча
     */
    public function updateMatchState(LiveMatch $liveMatch): void
    {
        $state = $this->buildState($liveMatch);
        $cacheKey = "live_match:{$liveMatch->match_id}";
        
        // Обновляем в кеше (Cache автоматически выберет доступный драйвер)
        Cache::put($cacheKey, $state, 60);
        
        // Обновляем в БД
        $liveMatch->current_minute = $liveMatch->getCurrentMinute();
        $liveMatch->save();
    }

    /**
     * Построить состояние матча для передачи клиенту
     */
    private function buildState(LiveMatch $liveMatch): array
    {
        $elapsedSeconds = now()->diffInSeconds($liveMatch->started_at);
        
        // Эмулируем 90 минут матча за 15 реальных минут (ускорение в 6 раз)
        // 90 минут матча = 5400 секунд матча = 900 реальных секунд
        $matchSeconds = min(5400, (int)($elapsedSeconds * 6)); // Ускорение в 6 раз
        $matchMinute = (int)($matchSeconds / 60); // Текущая минута матча (0-90)
        
        // Фильтруем события, которые уже произошли (по реальным секундам)
        $visibleEvents = array_filter($liveMatch->events ?? [], function($event) use ($elapsedSeconds) {
            return $event['timestamp'] <= $elapsedSeconds;
        });

        // Подсчитываем счет на основе произошедших событий
        $currentScore1 = 0;
        $currentScore2 = 0;
        foreach ($visibleEvents as $event) {
            if ($event['type'] === 'goal') {
                if ($event['team'] === 1) {
                    $currentScore1++;
                } else {
                    $currentScore2++;
                }
            }
        }

        // Обновляем позиции игроков (реалистичная анимация)
        $playersPositions = $this->updatePlayerPositions(
            $liveMatch->players_positions ?? [],
            $elapsedSeconds
        );

        return [
            'match_id' => $liveMatch->match_id,
            'status' => $liveMatch->status,
            'score_1' => $currentScore1, // Текущий счет на основе произошедших событий
            'score_2' => $currentScore2,
            'final_score_1' => $liveMatch->score_1, // Финальный счет (для информации)
            'final_score_2' => $liveMatch->score_2,
            'current_minute' => $matchMinute, // Минута матча (0-90)
            'match_seconds' => $matchSeconds, // Секунды матча (0-5400)
            'elapsed_seconds' => $elapsedSeconds, // Реальные секунды (0-900)
            'remaining_seconds' => $liveMatch->getRemainingSeconds(),
            'events' => array_values($visibleEvents),
            'players_positions' => $playersPositions,
            'started_at' => $liveMatch->started_at->toIso8601String(),
            'ends_at' => $liveMatch->ends_at->toIso8601String(),
        ];
    }

    /**
     * Обновить позиции игроков (реалистичная анимация движения)
     */
    private function updatePlayerPositions(array $positions, int $elapsedSeconds): array
    {
        // Реалистичная анимация: игроки двигаются по полю с учетом их позиций
        $updated = [];
        
        foreach ($positions as $team => $players) {
            $updated[$team] = [];
            
            foreach ($players as $index => $player) {
                // Используем user_id или индекс для уникального seed
                $seed = ($player['user_id'] ?? $index) * 1000; // Увеличиваем seed для большей вариативности
                
                // Базовые координаты из начальной позиции (сохраняем исходные)
                // Если есть base_x/base_y, используем их, иначе текущие x/y
                $baseX = $player['base_x'] ?? $player['x'] ?? 50;
                $baseY = $player['base_y'] ?? $player['y'] ?? 50;
                
                // Сохраняем базовые координаты для следующих обновлений
                if (!isset($player['base_x'])) {
                    $player['base_x'] = $baseX;
                    $player['base_y'] = $baseY;
                }
                
                // Движение зависит от позиции игрока
                $movementFactor = $this->getMovementFactor($index);
                
                // Более плавное движение с разными частотами для разных игроков
                $time1 = $elapsedSeconds * 0.2 + $seed * 0.01;
                $time2 = $elapsedSeconds * 0.25 + $seed * 0.015;
                
                // Движение по X (вдоль поля) - более заметное
                $deltaX = sin($time1) * $movementFactor * 5;
                // Движение по Y (поперек поля)
                $deltaY = cos($time2) * $movementFactor * 4;
                
                // Обновляем позицию относительно базовой
                $newX = $baseX + $deltaX;
                $newY = $baseY + $deltaY;
                
                // Ограничиваем границы поля (с учетом позиции команды)
                if ($team === 'team1') {
                    // Команда слева - не выходит за пределы левой половины
                    $newX = max(5, min(48, $newX));
                } else {
                    // Команда справа - не выходит за пределы правой половины
                    $newX = max(52, min(95, $newX));
                }
                $newY = max(5, min(95, $newY));
                
                $updated[$team][] = [
                    'user_id' => $player['user_id'] ?? null,
                    'name' => $player['name'] ?? "Игрок " . ($index + 1),
                    'x' => $newX,
                    'y' => $newY,
                    'base_x' => $baseX, // Сохраняем базовые координаты
                    'base_y' => $baseY,
                ];
            }
        }

        return $updated;
    }

    /**
     * Получить коэффициент движения в зависимости от позиции игрока
     */
    private function getMovementFactor(int $playerIndex): float
    {
        // Индекс 0 - вратарь (мало двигается)
        // Индексы 1-4 - защитники (средне)
        // Индексы 5-8 - полузащитники (много)
        // Индексы 9-10 - нападающие (очень много)
        
        if ($playerIndex === 0) {
            return 0.3; // Вратарь
        } elseif ($playerIndex >= 1 && $playerIndex <= 4) {
            return 0.6; // Защитники
        } elseif ($playerIndex >= 5 && $playerIndex <= 8) {
            return 1.0; // Полузащитники
        } else {
            return 1.2; // Нападающие
        }
    }

    /**
     * Сохранить результат матча в основную таблицу
     */
    public function saveMatchResult(LiveMatch $liveMatch): void
    {
        if ($liveMatch->result_saved) {
            return;
        }

        DB::transaction(function() use ($liveMatch) {
            // Обновляем основной матч
            $liveMatch->match->update([
                'score_1' => $liveMatch->score_1,
                'score_2' => $liveMatch->score_2,
                'status' => 'finished',
            ]);

            // Сохраняем события в таблицу match_events (только для реальных игроков)
            foreach ($liveMatch->events as $event) {
                if ($event['type'] === 'goal') {
                    // Пропускаем фиктивных игроков (без ID)
                    if (!$event['scorer_id']) {
                        continue;
                    }

                    DB::table('match_events')->insert([
                        'match_id' => $liveMatch->match_id,
                        'user_id' => $event['scorer_id'],
                        'type' => 'goal',
                        'minute' => $event['minute'],
                        'description' => "Гол {$event['scorer_name']}" . 
                            ($event['assister_id'] ? " (передача {$event['assister_name']})" : ''),
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);

                    // Обновляем статистику игрока
                    User::where('id', $event['scorer_id'])->increment('goals');

                    if ($event['assister_id']) {
                        DB::table('match_events')->insert([
                            'match_id' => $liveMatch->match_id,
                            'user_id' => $event['assister_id'],
                            'type' => 'assist',
                            'minute' => $event['minute'],
                            'description' => "Голевая передача {$event['assister_name']}",
                            'created_at' => now(),
                            'updated_at' => now(),
                        ]);

                        User::where('id', $event['assister_id'])->increment('assists');
                    }
                }
            }

            // Помечаем как сохраненное
            $liveMatch->update(['result_saved' => true, 'status' => 'finished']);
        });
    }
}

