<?php

namespace Database\Seeders;

use App\Models\Games\Game;
use App\Models\RatingHistory\RatingHistory;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RatingHistorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->command->info('Создание истории рейтинга...');

        // Получаем пользователей и игры
        $users = User::pluck('id')->toArray();
        $games = Game::pluck('id')->toArray();

        if (empty($users)) {
            $this->command->error('Нет пользователей в базе данных!');
            return;
        }

        if (empty($games)) {
            $this->command->error('Нет игр в базе данных!');
            return;
        }

        $batchSize = 500;
        $totalRecords = 15000;
        $batches = ceil($totalRecords / $batchSize);

        $descriptions = [
            'earn' => [
                'Победа в игре',
                'Участие в игре',
                'Приглашение реферала',
                'Активность в игре',
                'Достижение в игре',
                'Бонус за активность',
                'Награда за участие',
                'Бонус за реферала',
                'Ежедневный бонус',
                'Недельный бонус',
            ],
            'spend' => [
                'Отсутствие на проекте более недели',
                'Неактивность более 7 дней',
                'Штраф за неактивность',
                'Понижение рейтинга за отсутствие',
            ],
        ];

        for ($batch = 0; $batch < $batches; $batch++) {
            $records = [];
            $currentBatchSize = min($batchSize, $totalRecords - ($batch * $batchSize));

            for ($i = 0; $i < $currentBatchSize; $i++) {
                $userId = $users[array_rand($users)];
                $type = rand(1, 10) <= 8 ? 'earn' : 'spend'; // 80% начислений, 20% списаний
                
                $gameId = null;
                $points = 0;
                $description = '';

                if ($type === 'earn') {
                    // Начисления
                    $gameId = rand(1, 10) <= 7 ? $games[array_rand($games)] : null; // 70% с игрой, 30% без (рефералы)
                    
                    if ($gameId) {
                        // Начисления от игр
                        $points = rand(10, 100);
                        $description = $descriptions['earn'][array_rand($descriptions['earn'])];
                    } else {
                        // Начисления за рефералов
                        $points = rand(50, 200);
                        $description = 'Приглашение реферала';
                    }
                } else {
                    // Списания за неактивность
                    $points = rand(5, 30);
                    $description = $descriptions['spend'][array_rand($descriptions['spend'])];
                }

                // Случайная дата за последний год
                $daysAgo = rand(0, 365);
                $createdAt = now()->subDays($daysAgo);

                $records[] = [
                    'user_id' => $userId,
                    'game_id' => $gameId,
                    'points' => $points,
                    'type' => $type,
                    'description' => $description,
                    'details' => null,
                    'created_at' => $createdAt,
                    'updated_at' => $createdAt,
                ];
            }

            // Batch insert для производительности
            DB::table('rating_history')->insert($records);

            $created = min(($batch + 1) * $batchSize, $totalRecords);
            $this->command->info("Создано {$created} / {$totalRecords} записей");
        }

        $this->command->info('История рейтинга создана успешно!');
    }
}

