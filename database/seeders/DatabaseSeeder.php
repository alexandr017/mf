<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->command->info('Запуск сидеров...');
        
        // Сначала создаем достижения
        $this->call(AchievementsSeeder::class);
        
        // Затем создаем пользователей
        $this->call(UsersSeeder::class);
        
        // И наконец назначаем достижения пользователям
        $this->call(UserAchievementsSeeder::class);
        
        $this->command->info('Все сидеры выполнены!');
    }
}
