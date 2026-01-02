<?php

namespace Database\Seeders;

use App\Models\Teams\Team;
use App\Models\User;
use App\Models\UserTeams\UserTeam;
use App\Services\TeamTransferService;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserTeamsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->command->info('Привязка игроков к командам...');

        $transferService = new TeamTransferService();
        $currentSeason = $transferService->getCurrentSeason();

        // Проверяем наличие пользователей и команд
        $usersCount = User::count();
        $teamsCount = Team::count();
        
        if ($usersCount == 0) {
            $this->command->warn('Нет пользователей для привязки к командам.');
            return;
        }

        if ($teamsCount == 0) {
            $this->command->warn('Нет команд для привязки игроков.');
            return;
        }

        // Удаляем существующие привязки для текущего сезона
        UserTeam::where('season', $currentSeason)->delete();
        $this->command->info("Удалены существующие привязки для сезона {$currentSeason}.");

        $maxPlayersPerTeam = TeamTransferService::MAX_ACTIVE_PLAYERS;
        
        // Получаем ID всех команд
        $teamIds = Team::pluck('id')->toArray();
        shuffle($teamIds); // Перемешиваем для случайности
        
        // Инициализируем счетчики для каждой команды
        $teamPlayerCounts = array_fill_keys($teamIds, 0);

        // Получаем ID всех пользователей и перемешиваем
        $userIds = User::pluck('id')->toArray();
        shuffle($userIds);

        $assignedCount = 0;
        $batchSize = 100; // Обрабатываем по 100 записей за раз
        $batch = [];

        // Распределяем игроков по командам
        foreach ($userIds as $userId) {
            // Находим команду с наименьшим количеством игроков
            $availableTeamIds = array_filter($teamIds, function($teamId) use ($teamPlayerCounts, $maxPlayersPerTeam) {
                return $teamPlayerCounts[$teamId] < $maxPlayersPerTeam;
            });

            if (empty($availableTeamIds)) {
                $this->command->warn("Все команды заполнены. Осталось нераспределенных игроков: " . (count($userIds) - $assignedCount));
                break;
            }

            // Выбираем команду с наименьшим количеством игроков
            $selectedTeamId = null;
            $minCount = PHP_INT_MAX;
            foreach ($availableTeamIds as $teamId) {
                if ($teamPlayerCounts[$teamId] < $minCount) {
                    $minCount = $teamPlayerCounts[$teamId];
                    $selectedTeamId = $teamId;
                }
            }

            // Добавляем в батч
            $batch[] = [
                'user_id' => $userId,
                'team_id' => $selectedTeamId,
                'season' => $currentSeason,
                'created_at' => now(),
                'updated_at' => now(),
            ];

            $teamPlayerCounts[$selectedTeamId]++;
            $assignedCount++;

            // Вставляем батч при достижении размера
            if (count($batch) >= $batchSize) {
                DB::table('user_teams')->insert($batch);
                $batch = [];
                $this->command->info("Обработано: {$assignedCount} / {$usersCount}");
            }
        }

        // Вставляем оставшиеся записи
        if (!empty($batch)) {
            DB::table('user_teams')->insert($batch);
        }

        $this->command->info("Привязано игроков к командам: {$assignedCount}");
        
        // Выводим статистику по командам
        $this->command->info("\nСтатистика по командам:");
        $teams = Team::whereIn('id', $teamIds)->get(['id', 'name']);
        foreach ($teams as $team) {
            $count = $teamPlayerCounts[$team->id] ?? 0;
            $this->command->info("  {$team->name}: {$count} игроков");
        }
    }
}
