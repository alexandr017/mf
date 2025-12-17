<?php

namespace Database\Seeders;

use App\Models\Teams\Team;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RatingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->command->info('Заполнение таблицы ratings...');

        // Получаем все команды
        $teams = Team::all();

        if ($teams->isEmpty()) {
            $this->command->warn('Команды не найдены. Сначала запустите TeamsSeeder.');
            return;
        }

        // Очищаем таблицу перед заполнением
        DB::table('ratings')->truncate();

        foreach ($teams as $team) {
            // Генерируем случайные данные
            // Количество игр от 10 до 38 (типичный сезон)
            $games = fake()->numberBetween(10, 38);
            
            // Побед, ничьих и поражений должны в сумме давать games
            // Генерируем победи и поражения, остальное - ничьи
            $wins = fake()->numberBetween(0, min($games, 25));
            $remainingGames = $games - $wins;
            $losses = fake()->numberBetween(0, min($remainingGames, 15));
            $draws = max(0, $remainingGames - $losses); // Убеждаемся, что draws не отрицательное
            
            // Разница мячей: от -30 до +50
            $goalDifference = fake()->numberBetween(-30, 50);
            
            // Очки: победа = 3, ничья = 1, поражение = 0
            $points = ($wins * 3) + ($draws * 1);

            DB::table('ratings')->insert([
                'team_id' => $team->id,
                'games' => $games,
                'wins' => $wins,
                'draws' => $draws,
                'losses' => $losses,
                'goal_difference' => $goalDifference,
                'points' => $points,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        $this->command->info('Таблица ratings заполнена успешно! Создано записей: ' . $teams->count());
    }
}

