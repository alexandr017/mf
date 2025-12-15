<?php

namespace Database\Seeders;

use App\Models\Games\Game;
use App\Models\User;
use App\Models\UserGameResults\UserGameResult;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserGameResultsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->command->info('Начинаем создание 10,000 записей результатов игр...');
        
        $totalRecords = 10000;
        $chunkSize = 1000; // Обрабатываем по 1000 записей за раз
        $processed = 0;

        // Получаем всех пользователей и игр
        $userIds = User::pluck('id')->toArray();
        $gameIds = Game::where('status', 1)->pluck('id')->toArray();

        if (empty($userIds)) {
            $this->command->error('Нет пользователей в базе данных. Сначала запустите UsersSeeder.');
            return;
        }

        if (empty($gameIds)) {
            $this->command->error('Нет активных игр в базе данных. Сначала запустите GamesSeeder.');
            return;
        }

        for ($i = 0; $i < $totalRecords; $i += $chunkSize) {
            $currentBatchSize = min($chunkSize, $totalRecords - $i);
            $batch = [];

            for ($j = 0; $j < $currentBatchSize; $j++) {
                $userId = fake()->randomElement($userIds);
                $gameId = fake()->randomElement($gameIds);
                
                // Генерируем случайный счет (0-100)
                $score = fake()->numberBetween(0, 100);
                
                // Определяем победу (50% шанс)
                $win = fake()->boolean(50);
                
                // Баллы рейтинга зависят от победы и счета
                $ratingPointsEarned = $win 
                    ? fake()->numberBetween(10, 50) 
                    : fake()->numberBetween(0, 20);
                
                // Случайная дата в диапазоне последних 6 месяцев
                $playedAt = fake()->dateTimeBetween('-6 months', 'now');

                $batch[] = [
                    'user_id' => $userId,
                    'game_id' => $gameId,
                    'score' => $score,
                    'rating_points_earned' => $ratingPointsEarned,
                    'win' => $win,
                    'played_at' => $playedAt,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }

            // Batch insert для производительности
            DB::table('user_game_results')->insert($batch);
            
            $processed += $currentBatchSize;
            $this->command->info("Создано записей результатов игр: {$processed} / {$totalRecords}");
        }

        $this->command->info('Все записи результатов игр созданы успешно!');
    }
}

