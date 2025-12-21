<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->command->info('Начинаем создание 100,000 пользователей...');
        
        $totalUsers = 100000;
        $chunkSize = 1000; // Обрабатываем по 1000 пользователей за раз
        $processed = 0;

        // Получаем существующих пользователей для реферальной системы
        $existingUserIds = User::pluck('id')->toArray();
        $existingUserCount = count($existingUserIds);
        $lastUserId = $existingUserCount > 0 ? max($existingUserIds) : 0;

        for ($i = 0; $i < $totalUsers; $i += $chunkSize) {
            $batch = [];
            $currentBatchSize = min($chunkSize, $totalUsers - $i);

            for ($j = 0; $j < $currentBatchSize; $j++) {
                $goals = fake()->numberBetween(0, 500);
                $assists = fake()->numberBetween(0, 300);
                $rating = fake()->randomFloat(2, 0, 100);
                
                // 30% пользователей имеют реферала (только если уже есть пользователи)
                $referredById = null;
                if (fake()->boolean(30) && $existingUserCount > 0) {
                    $referredById = fake()->randomElement($existingUserIds);
                }

                $name = fake()->name();
                $nickname = Str::lower(Str::slug($name)) . '_' . Str::random(6);
                
                $batch[] = [
                    'name' => $name,
                    'nickname' => $nickname,
                    'email' => 'user_' . ($i + $j) . '_' . time() . '_' . Str::random(5) . '@example.com',
                    'password' => bcrypt('password'),
                    'goals' => $goals,
                    'assists' => $assists,
                    'rating' => $rating,
                    'referral_code' => Str::upper(Str::random(8)),
                    'referred_by_id' => $referredById,
                    'referrals_count' => 0,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }

            // Batch insert для производительности
            DB::table('users')->insert($batch);
            
            $processed += $currentBatchSize;
            $this->command->info("Создано пользователей: {$processed} / {$totalUsers}");

            // Обновляем список существующих пользователей для реферальной системы
            // Получаем только новые ID (после последнего известного)
            $newUserIds = DB::table('users')
                ->where('id', '>', $lastUserId)
                ->pluck('id')
                ->toArray();
            
            if (!empty($newUserIds)) {
                $existingUserIds = array_merge($existingUserIds, $newUserIds);
                $existingUserCount = count($existingUserIds);
                $lastUserId = max($newUserIds);
            }
        }

        // Обновляем referrals_count для пользователей, которые пригласили других
        $this->command->info('Обновляем счетчики рефералов...');
        DB::statement('
            UPDATE users u1
            SET referrals_count = (
                SELECT COUNT(*)
                FROM users u2
                WHERE u2.referred_by_id = u1.id
            )
        ');

        $this->command->info('Готово! Создано 100,000 пользователей.');
    }
}
