<?php

namespace Database\Seeders;

use App\Models\Achievements\Achievement;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserAchievementsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->command->info('Начинаем назначение достижений пользователям...');

        $achievements = Achievement::all();
        
        if ($achievements->isEmpty()) {
            $this->command->warn('Достижения не найдены. Сначала запустите AchievementsSeeder.');
            return;
        }

        $users = User::all();
        $totalUsers = $users->count();
        
        if ($totalUsers === 0) {
            $this->command->warn('Пользователи не найдены. Сначала запустите UsersSeeder.');
            return;
        }

        $userAchievements = [];
        $processed = 0;
        $chunkSize = 1000;

        foreach ($users->chunk($chunkSize) as $userChunk) {
            foreach ($userChunk as $user) {
                // Каждый пользователь получает от 0 до 5 случайных достижений
                $achievementsCount = fake()->numberBetween(0, 5);
                $randomAchievements = $achievements->random(min($achievementsCount, $achievements->count()));

                foreach ($randomAchievements as $achievement) {
                    // Проверяем условия для некоторых достижений
                    $shouldAssign = true;

                    // Стрелок - минимум 10 голов
                    if ($achievement->name === 'Стрелок' && $user->goals < 10) {
                        $shouldAssign = false;
                    }

                    // Бомбардир - минимум 50 голов
                    if ($achievement->name === 'Бомбардир' && $user->goals < 50) {
                        $shouldAssign = false;
                    }

                    // Легенда - минимум 100 голов
                    if ($achievement->name === 'Легенда' && $user->goals < 100) {
                        $shouldAssign = false;
                    }

                    // Ассистент - минимум 10 передач
                    if ($achievement->name === 'Ассистент' && $user->assists < 10) {
                        $shouldAssign = false;
                    }

                    // Плеймейкер - минимум 50 передач
                    if ($achievement->name === 'Плеймейкер' && $user->assists < 50) {
                        $shouldAssign = false;
                    }

                    // Мастер ассистов - минимум 100 передач
                    if ($achievement->name === 'Мастер ассистов' && $user->assists < 100) {
                        $shouldAssign = false;
                    }

                    // Новичок - рейтинг выше 50
                    if ($achievement->name === 'Новичок' && $user->rating < 50) {
                        $shouldAssign = false;
                    }

                    // Профи - рейтинг выше 70
                    if ($achievement->name === 'Профи' && $user->rating < 70) {
                        $shouldAssign = false;
                    }

                    // Элита - рейтинг выше 85
                    if ($achievement->name === 'Элита' && $user->rating < 85) {
                        $shouldAssign = false;
                    }

                    // Реферал - минимум 5 рефералов
                    if ($achievement->name === 'Реферал' && $user->referrals_count < 5) {
                        $shouldAssign = false;
                    }

                    // Амбассадор - минимум 20 рефералов
                    if ($achievement->name === 'Амбассадор' && $user->referrals_count < 20) {
                        $shouldAssign = false;
                    }

                    if ($shouldAssign) {
                        $userAchievements[] = [
                            'user_id' => $user->id,
                            'achievement_id' => $achievement->id,
                            'earned_at' => now()->subDays(fake()->numberBetween(0, 365)),
                            'created_at' => now(),
                            'updated_at' => now(),
                        ];
                    }
                }
            }

            // Batch insert для производительности
            if (!empty($userAchievements)) {
                // Удаляем дубликаты по user_id + achievement_id
                $unique = [];
                foreach ($userAchievements as $ua) {
                    $key = $ua['user_id'] . '_' . $ua['achievement_id'];
                    if (!isset($unique[$key])) {
                        $unique[$key] = $ua;
                    }
                }
                $userAchievements = array_values($unique);

                DB::table('user_achievements')->insert($userAchievements);
                $processed += count($userChunk);
                $this->command->info("Обработано пользователей: {$processed} / {$totalUsers}");
                $userAchievements = []; // Очищаем массив для следующей итерации
            }
        }

        $this->command->info('Готово! Достижения назначены пользователям.');
    }
}
