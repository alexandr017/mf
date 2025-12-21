<?php

namespace Database\Seeders;

use App\Models\Teams\Team;
use App\Models\Tournaments\TournamentSeason;
use App\Models\User;
use App\Models\UserTeams\UserTeam;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserTeamsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->command->info('Начинаем заполнение user_teams...');

        $users = User::all();
        $teams = Team::all();
        $seasons = TournamentSeason::all();

        if ($teams->isEmpty()) {
            $this->command->error('Нет команд в базе данных. Сначала запустите TeamsSeeder.');
            return;
        }

        if ($seasons->isEmpty()) {
            $this->command->error('Нет сезонов в базе данных. Сначала запустите TournamentsSeeder.');
            return;
        }

        $teamIds = $teams->pluck('id')->toArray();
        $totalUsers = $users->count();
        $totalSeasons = $seasons->count();
        $processed = 0;

        $this->command->info("Всего пользователей: {$totalUsers}, сезонов: {$totalSeasons}");

        foreach ($users as $user) {
            foreach ($seasons as $season) {
                // Проверяем, не существует ли уже запись для этого пользователя и сезона
                $exists = UserTeam::where('user_id', $user->id)
                    ->where('season_id', $season->id)
                    ->exists();

                if (!$exists) {
                    // Выбираем случайную команду
                    $randomTeamId = fake()->randomElement($teamIds);

                    UserTeam::create([
                        'user_id' => $user->id,
                        'team_id' => $randomTeamId,
                        'season_id' => $season->id,
                    ]);
                }
            }

            $processed++;
            if ($processed % 100 === 0) {
                $this->command->info("Обработано пользователей: {$processed} / {$totalUsers}");
            }
        }

        $this->command->info("Готово! Заполнено user_teams для всех пользователей.");
    }
}

