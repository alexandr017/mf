<?php

namespace App\Services\LiveMatches;

use App\Models\LiveMatches\LiveMatch;
use App\Models\Tournaments\TournamentMatch;
use App\Models\Tournaments\TournamentSeason;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class MatchResultGenerator
{
    /**
     * Генерирует результат матча заранее
     *
     * @param TournamentMatch $match
     * @return LiveMatch
     */
    public function generateResult(TournamentMatch $match): LiveMatch
    {
        // Получаем ТОП игроков обеих команд
        $team1Players = $this->getTopPlayers($match->team_1);
        $team2Players = $this->getTopPlayers($match->team_2);

        // Если у команды нет игроков, создаем фиктивных
        if (empty($team1Players)) {
            $team1Players = $this->createDummyPlayers($match->team_1, 11);
        }
        if (empty($team2Players)) {
            $team2Players = $this->createDummyPlayers($match->team_2, 11);
        }

        // Генерируем количество голов (0-5 для каждой команды)
        $score1 = rand(0, 5);
        $score2 = rand(0, 5);

        // Генерируем события (голы и передачи) с временными метками
        $events = $this->generateEvents($team1Players, $team2Players, $score1, $score2);

        // Создаем live match
        $startedAt = now();
        $endsAt = $startedAt->copy()->addMinutes(15);

        $liveMatch = LiveMatch::create([
            'match_id' => $match->id,
            'started_at' => $startedAt,
            'ends_at' => $endsAt,
            'status' => 'live',
            'score_1' => $score1,
            'score_2' => $score2,
            'current_minute' => 0,
            'events' => $events,
            'players_positions' => $this->generateInitialPositions($team1Players, $team2Players),
        ]);

        return $liveMatch;
    }

    /**
     * Получить ТОП игроков команды (по рейтингу)
     */
    private function getTopPlayers(int $teamId, int $limit = 11): array
    {
        // Получаем последний сезон
        $latestSeason = TournamentSeason::orderBy('year_start', 'desc')->first();
        
        if (!$latestSeason) {
            // Если нет сезона, возвращаем пустой массив или случайных пользователей
            return [];
        }

        return DB::table('user_teams')
            ->join('users', 'user_teams.user_id', '=', 'users.id')
            ->where('user_teams.team_id', $teamId)
            ->where('user_teams.season_id', $latestSeason->id)
            ->orderBy('users.rating', 'desc')
            ->limit($limit)
            ->select('users.id', 'users.name', 'users.rating')
            ->get()
            ->toArray();
    }

    /**
     * Генерирует события матча (голы и передачи)
     */
    private function generateEvents(array $team1Players, array $team2Players, int $score1, int $score2): array
    {
        $events = [];

        // Генерируем голы первой команды
        if (!empty($team1Players) && $score1 > 0) {
            for ($i = 0; $i < $score1; $i++) {
                $scorerIndex = array_rand($team1Players);
                $scorer = $team1Players[$scorerIndex];
                $assister = null;
                
                // 50% вероятность передачи
                if (rand(0, 1) && count($team1Players) > 1) {
                    $assisterIndex = array_rand($team1Players);
                    // Убеждаемся, что ассистент не тот же, что и бомбардир
                    while ($assisterIndex === $scorerIndex && count($team1Players) > 1) {
                        $assisterIndex = array_rand($team1Players);
                    }
                    $assister = $team1Players[$assisterIndex];
                }

                // Генерируем случайную минуту матча (0-90 минут, но в реальных секундах это 0-900)
                // Ускорение в 6 раз: 90 минут матча = 15 минут реального времени
                $matchMinute = rand(1, 90); // Минута матча (для отображения)
                $realSeconds = (int)(($matchMinute / 90) * 900); // Реальные секунды (0-900)
                
                $events[] = [
                    'type' => 'goal',
                    'team' => 1,
                    'minute' => $matchMinute, // Минута матча для отображения (1-90)
                    'scorer_id' => $scorer->id ?? null,
                    'scorer_name' => $scorer->name ?? 'Игрок',
                    'assister_id' => $assister ? ($assister->id ?? null) : null,
                    'assister_name' => $assister ? ($assister->name ?? 'Игрок') : null,
                    'timestamp' => $realSeconds, // Реальные секунды от начала матча (0-900)
                ];
            }
        }

        // Генерируем голы второй команды
        if (!empty($team2Players) && $score2 > 0) {
            for ($i = 0; $i < $score2; $i++) {
                $scorerIndex = array_rand($team2Players);
                $scorer = $team2Players[$scorerIndex];
                $assister = null;
                
                // 50% вероятность передачи
                if (rand(0, 1) && count($team2Players) > 1) {
                    $assisterIndex = array_rand($team2Players);
                    // Убеждаемся, что ассистент не тот же, что и бомбардир
                    while ($assisterIndex === $scorerIndex && count($team2Players) > 1) {
                        $assisterIndex = array_rand($team2Players);
                    }
                    $assister = $team2Players[$assisterIndex];
                }

                // Генерируем случайную минуту матча (0-90 минут, но в реальных секундах это 0-900)
                $matchMinute = rand(1, 90); // Минута матча (для отображения)
                $realSeconds = (int)(($matchMinute / 90) * 900); // Реальные секунды (0-900)
                
                $events[] = [
                    'type' => 'goal',
                    'team' => 2,
                    'minute' => $matchMinute, // Минута матча для отображения (1-90)
                    'scorer_id' => $scorer->id ?? null,
                    'scorer_name' => $scorer->name ?? 'Игрок',
                    'assister_id' => $assister ? ($assister->id ?? null) : null,
                    'assister_name' => $assister ? ($assister->name ?? 'Игрок') : null,
                    'timestamp' => $realSeconds, // Реальные секунды от начала матча (0-900)
                ];
            }
        }

        // Сортируем события по времени
        usort($events, function($a, $b) {
            return $a['timestamp'] <=> $b['timestamp'];
        });

        return $events;
    }

    /**
     * Генерирует начальные позиции игроков на поле
     */
    private function generateInitialPositions(array $team1Players, array $team2Players): array
    {
        $positions = [
            'team1' => [],
            'team2' => [],
        ];

        // Простая расстановка: 4-4-2
        $formation1 = [
            ['x' => 10, 'y' => 50], // GK
            ['x' => 25, 'y' => 20], ['x' => 25, 'y' => 40], ['x' => 25, 'y' => 60], ['x' => 25, 'y' => 80], // Defense
            ['x' => 40, 'y' => 25], ['x' => 40, 'y' => 45], ['x' => 40, 'y' => 55], ['x' => 40, 'y' => 75], // Midfield
            ['x' => 60, 'y' => 40], ['x' => 60, 'y' => 60], // Forward
        ];

        $formation2 = [
            ['x' => 90, 'y' => 50], // GK
            ['x' => 75, 'y' => 20], ['x' => 75, 'y' => 40], ['x' => 75, 'y' => 60], ['x' => 75, 'y' => 80], // Defense
            ['x' => 60, 'y' => 25], ['x' => 60, 'y' => 45], ['x' => 60, 'y' => 55], ['x' => 60, 'y' => 75], // Midfield
            ['x' => 40, 'y' => 40], ['x' => 40, 'y' => 60], // Forward
        ];

                foreach ($team1Players as $index => $player) {
            if (isset($formation1[$index])) {
                $positions['team1'][] = [
                    'user_id' => $player->id ?? null,
                    'name' => $player->name ?? "Игрок " . ($index + 1),
                    'x' => $formation1[$index]['x'],
                    'y' => $formation1[$index]['y'],
                    'base_x' => $formation1[$index]['x'], // Сохраняем базовые координаты
                    'base_y' => $formation1[$index]['y'],
                ];
            }
        }

        foreach ($team2Players as $index => $player) {
            if (isset($formation2[$index])) {
                $positions['team2'][] = [
                    'user_id' => $player->id ?? null,
                    'name' => $player->name ?? "Игрок " . ($index + 1),
                    'x' => $formation2[$index]['x'],
                    'y' => $formation2[$index]['y'],
                    'base_x' => $formation2[$index]['x'], // Сохраняем базовые координаты
                    'base_y' => $formation2[$index]['y'],
                ];
            }
        }

        return $positions;
    }

    /**
     * Создает фиктивных игроков для команды, если у нее нет игроков
     */
    private function createDummyPlayers(int $teamId, int $count = 11): array
    {
        $team = \App\Models\Teams\Team::find($teamId);
        $teamName = $team ? $team->name : "Команда {$teamId}";
        
        $players = [];
        for ($i = 1; $i <= $count; $i++) {
            $players[] = (object)[
                'id' => null, // Фиктивный игрок, нет ID пользователя
                'name' => "Игрок {$i} ({$teamName})",
                'rating' => rand(50, 100),
            ];
        }
        
        return $players;
    }
}

