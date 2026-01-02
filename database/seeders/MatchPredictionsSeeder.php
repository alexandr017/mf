<?php

namespace Database\Seeders;

use App\Models\Games\MatchPrediction;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class MatchPredictionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $teams = [
            ['name' => 'Реал Мадрид', 'logo' => '/v1/images/demo/team-logo.jpg'],
            ['name' => 'Барселона', 'logo' => '/v1/images/demo/team-logo.jpg'],
            ['name' => 'Манчестер Сити', 'logo' => '/v1/images/demo/team-logo.jpg'],
            ['name' => 'Ливерпуль', 'logo' => '/v1/images/demo/team-logo.jpg'],
            ['name' => 'Бавария', 'logo' => '/v1/images/demo/team-logo.jpg'],
            ['name' => 'ПСЖ', 'logo' => '/v1/images/demo/team-logo.jpg'],
            ['name' => 'Челси', 'logo' => '/v1/images/demo/team-logo.jpg'],
            ['name' => 'Арсенал', 'logo' => '/v1/images/demo/team-logo.jpg'],
            ['name' => 'Ювентус', 'logo' => '/v1/images/demo/team-logo.jpg'],
            ['name' => 'Милан', 'logo' => '/v1/images/demo/team-logo.jpg'],
        ];

        $now = Carbon::now();
        
        // Создаем матчи на ближайшие 7 дней
        for ($i = 0; $i < 14; $i++) {
            $matchDate = $now->copy()->addDays($i)->setTime(18 + ($i % 3), 0);
            $deadline = $matchDate->copy()->subHour();
            
            $team1 = $teams[array_rand($teams)];
            $team2 = $teams[array_rand($teams)];
            
            // Убеждаемся, что команды разные
            while ($team1['name'] === $team2['name']) {
                $team2 = $teams[array_rand($teams)];
            }
            
            // Для первых 5 матчей ставим результаты (завершенные)
            $status = $i < 5 ? 'finished' : 'scheduled';
            $score1 = $i < 5 ? rand(0, 4) : null;
            $score2 = $i < 5 ? rand(0, 4) : null;
            
            MatchPrediction::create([
                'team_1_name' => $team1['name'],
                'team_2_name' => $team2['name'],
                'team_1_logo' => $team1['logo'],
                'team_2_logo' => $team2['logo'],
                'match_date' => $matchDate,
                'prediction_deadline' => $deadline,
                'score_1' => $score1,
                'score_2' => $score2,
                'status' => $status,
                'description' => "Матч между {$team1['name']} и {$team2['name']}",
            ]);
        }
        
        $this->command->info('Создано 14 матчей для прогнозов (5 завершенных, 9 запланированных)');
    }
}

