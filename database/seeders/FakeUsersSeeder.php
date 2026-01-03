<?php

namespace Database\Seeders;

use App\Models\Teams\Team;
use App\Models\User;
use App\Models\UserTeams\UserTeam;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class FakeUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->command->info('Начинаем создание фейковых пользователей для команд...');
        
        $teams = Team::all();
        $currentSeason = Carbon::now()->year;
        
        $positions = ['defender', 'midfielder', 'forward'];
        $firstNames = [
            'Александр', 'Дмитрий', 'Максим', 'Сергей', 'Андрей', 'Алексей', 'Артем', 'Илья',
            'Кирилл', 'Михаил', 'Никита', 'Матвей', 'Роман', 'Егор', 'Арсений', 'Иван',
            'Денис', 'Евгений', 'Данил', 'Тимур', 'Владислав', 'Игорь', 'Владимир', 'Павел',
            'Руслан', 'Марк', 'Лев', 'Константин', 'Олег', 'Ярослав'
        ];
        
        $lastNames = [
            'Иванов', 'Петров', 'Сидоров', 'Смирнов', 'Кузнецов', 'Попов', 'Соколов', 'Лебедев',
            'Козлов', 'Новиков', 'Морозов', 'Петров', 'Волков', 'Соловьев', 'Васильев', 'Зайцев',
            'Павлов', 'Семенов', 'Голубев', 'Виноградов', 'Богданов', 'Воробьев', 'Федоров', 'Михайлов',
            'Белов', 'Тарасов', 'Белов', 'Комаров', 'Орлов', 'Киселев'
        ];
        
        $totalCreated = 0;
        
        foreach ($teams as $team) {
            // Проверяем, сколько уже есть игроков в команде
            $existingPlayersCount = UserTeam::where('team_id', $team->id)
                ->where('season', $currentSeason)
                ->count();
            
            // Определяем, сколько нужно создать (7-12, но не больше лимита)
            $needed = rand(7, 12);
            $maxCanAdd = min($needed, 100 - $existingPlayersCount);
            
            if ($maxCanAdd <= 0) {
                $this->command->info("Команда {$team->name}: уже достаточно игроков ({$existingPlayersCount})");
                continue;
            }
            
            $this->command->info("Команда {$team->name}: создаем {$maxCanAdd} фейковых игроков (текущее количество: {$existingPlayersCount})");
            
            $users = [];
            for ($i = 0; $i < $maxCanAdd; $i++) {
                $firstName = fake()->randomElement($firstNames);
                $lastName = fake()->randomElement($lastNames);
                $name = "{$firstName} {$lastName}";
                $nickname = Str::lower(Str::slug($name)) . '_' . Str::random(6);
                
                // Начальный рейтинг от 0.5 до 5.0
                $rating = fake()->randomFloat(2, 0.5, 5.0);
                
                // Небольшое количество голов и ассистов
                $goals = fake()->numberBetween(0, 20);
                $assists = fake()->numberBetween(0, 15);
                
                $users[] = [
                    'name' => $name,
                    'nickname' => $nickname,
                    'email' => 'fake_' . Str::random(10) . '_' . time() . '_' . $i . '@fake.local',
                    'password' => bcrypt(Str::random(32)), // Случайный пароль, никто не будет входить
                    'preferred_position' => fake()->randomElement($positions),
                    'goals' => $goals,
                    'assists' => $assists,
                    'rating' => $rating,
                    'is_fake' => true,
                    'referral_code' => Str::upper(Str::random(8)),
                    'referrals_count' => 0,
                    'created_at' => now()->subDays(rand(1, 180)), // Созданы в разное время
                    'updated_at' => now(),
                ];
            }
            
            // Вставляем пользователей
            DB::table('users')->insert($users);
            
            // Получаем ID созданных пользователей
            $createdUserIds = DB::table('users')
                ->where('is_fake', true)
                ->whereIn('email', array_column($users, 'email'))
                ->pluck('id')
                ->toArray();
            
            // Привязываем их к команде
            $userTeams = [];
            foreach ($createdUserIds as $userId) {
                $userTeams[] = [
                    'user_id' => $userId,
                    'team_id' => $team->id,
                    'season' => $currentSeason,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
            
            DB::table('user_teams')->insert($userTeams);
            
            $totalCreated += count($createdUserIds);
            $this->command->info("  ✓ Создано и привязано к команде: " . count($createdUserIds) . " игроков");
        }
        
        $this->command->info("Готово! Всего создано фейковых пользователей: {$totalCreated}");
    }
}

