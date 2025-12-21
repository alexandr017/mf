<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Teams\Team;
use App\Models\Tournaments\TournamentMatch;
use App\Models\Tournaments\TournamentStage;
use App\Models\Tournaments\TournamentSeason;

class LiveMatchesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * Создает несколько тестовых матчей для запуска live трансляций
     */
    public function run(): void
    {
        $this->command->info('Создание тестовых матчей для live трансляций...');

        // Получаем команды
        $teams = Team::where('status', 1)->get();
        
        if ($teams->count() < 2) {
            $this->command->error('Недостаточно команд для создания матчей. Нужно минимум 2 команды.');
            return;
        }

        // Получаем последний сезон или создаем тестовый
        $season = TournamentSeason::orderBy('year_start', 'desc')->first();
        
        if (!$season) {
            $this->command->error('Не найден сезон. Создайте сезон перед запуском сидера.');
            return;
        }

        // Получаем или создаем тестовую стадию
        $stage = TournamentStage::where('tournaments_season_id', $season->id)
            ->where('type', 'league_round')
            ->first();

        if (!$stage) {
            // Создаем тестовую стадию
            $stage = TournamentStage::create([
                'tournaments_season_id' => $season->id,
                'name' => 'Тестовая стадия для Live матчей',
                'type' => 'league_round',
                'stage_order' => 1,
            ]);
            $this->command->info("Создана тестовая стадия: {$stage->name}");
        }

        // Создаем несколько матчей
        $matchesToCreate = 5; // Количество матчей
        $created = 0;
        $teamIds = $teams->pluck('id')->toArray();
        $usedPairs = []; // Для отслеживания уже использованных пар команд

        for ($i = 0; $i < $matchesToCreate; $i++) {
            // Выбираем случайные команды
            shuffle($teamIds);
            $team1 = $teamIds[0];
            $team2 = $teamIds[1] ?? $teamIds[0];
            
            // Убеждаемся, что команды разные
            if ($team1 === $team2 && count($teamIds) > 1) {
                $team2 = $teamIds[1];
            }
            
            // Пропускаем, если такая пара уже использована
            $pairKey = min($team1, $team2) . '_' . max($team1, $team2);
            if (in_array($pairKey, $usedPairs)) {
                // Пробуем найти другую пару
                $found = false;
                for ($j = 0; $j < count($teamIds) - 1; $j++) {
                    for ($k = $j + 1; $k < count($teamIds); $k++) {
                        $t1 = $teamIds[$j];
                        $t2 = $teamIds[$k];
                        $key = min($t1, $t2) . '_' . max($t1, $t2);
                        if (!in_array($key, $usedPairs)) {
                            $team1 = $t1;
                            $team2 = $t2;
                            $pairKey = $key;
                            $found = true;
                            break 2;
                        }
                    }
                }
                if (!$found) {
                    $this->command->warn("Все возможные пары команд уже использованы. Пропускаем оставшиеся матчи.");
                    break;
                }
            }
            
            $usedPairs[] = $pairKey;

            // Проверяем, не существует ли уже такой матч
            $existingMatch = TournamentMatch::where('stage_id', $stage->id)
                ->where(function($query) use ($team1, $team2) {
                    $query->where(function($q) use ($team1, $team2) {
                        $q->where('team_1', $team1)->where('team_2', $team2);
                    })->orWhere(function($q) use ($team1, $team2) {
                        $q->where('team_1', $team2)->where('team_2', $team1);
                    });
                })
                ->first();

            if ($existingMatch) {
                $this->command->warn("Матч между командами {$team1} и {$team2} уже существует, пропускаем...");
                continue;
            }

            // Создаем матч
            $match = TournamentMatch::create([
                'stage_id' => $stage->id,
                'group_id' => null,
                'team_1' => $team1,
                'team_2' => $team2,
                'date' => now()->addDays($i)->setTime(15, 0), // Разные даты, одинаковое время
                'status' => 'scheduled', // Запланирован, готов к запуску
                'score_1' => null,
                'score_2' => null,
            ]);

            $team1Name = Team::find($team1)->name ?? "Team {$team1}";
            $team2Name = Team::find($team2)->name ?? "Team {$team2}";

            $this->command->info("Создан матч #{$match->id}: {$team1Name} vs {$team2Name}");
            $created++;
        }

        $this->command->info("Создано матчей: {$created} из {$matchesToCreate}");
        $this->command->info('Матчи готовы к запуску через админ-панель!');
        $this->command->info('Перейдите в /admin/matches и нажмите "Запустить" для любого матча.');
    }
}

