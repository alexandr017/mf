<?php

namespace App\Http\Controllers\Admin;

use App\Models\Teams\Team;
use App\Models\User;
use App\Models\UserTeams\UserTeam;
use App\Services\TeamTransferService;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

final class DashboardController extends AdminController
{
    protected TeamTransferService $transferService;

    public function __construct(TeamTransferService $transferService)
    {
        $this->transferService = $transferService;
    }

    public function index()
    {
        $currentSeason = $this->transferService->getCurrentSeason();
        
        // Общая статистика
        $totalUsers = User::count();
        $totalTeams = Team::count();
        
        // Пользователи с командами в текущем сезоне
        $usersWithTeams = UserTeam::where('season', $currentSeason)
            ->distinct('user_id')
            ->count('user_id');
        
        // Активные пользователи (заходили последние 2-3 недели)
        $twoWeeksAgo = Carbon::now()->subWeeks(2)->timestamp;
        
        $activeUsers = DB::table('sessions')
            ->where('last_activity', '>=', $twoWeeksAgo)
            ->whereNotNull('user_id')
            ->distinct('user_id')
            ->count('user_id');
        
        $activeUsersWithTeams = 0;
        if ($activeUsers > 0) {
            $activeUserIds = DB::table('sessions')
                ->where('last_activity', '>=', $twoWeeksAgo)
                ->whereNotNull('user_id')
                ->distinct('user_id')
                ->pluck('user_id')
                ->toArray();
            
            $activeUsersWithTeams = UserTeam::where('season', $currentSeason)
                ->whereIn('user_id', $activeUserIds)
                ->distinct('user_id')
                ->count('user_id');
        }
        
        // Расчет соотношений
        $totalCapacity = $totalTeams * TeamTransferService::MAX_ACTIVE_PLAYERS;
        $totalRatio = $totalCapacity > 0 ? ($usersWithTeams / $totalCapacity) * 100 : 0;
        $activeCapacity = $totalTeams * TeamTransferService::MAX_ACTIVE_PLAYERS;
        $activeRatio = $activeCapacity > 0 ? ($activeUsersWithTeams / $activeCapacity) * 100 : 0;
        
        // Динамика за последние 30 дней
        $daysAgo = [];
        $usersData = [];
        $teamsData = [];
        
        for ($i = 30; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i);
            $daysAgo[] = $date->format('d.m');
            
            $usersCount = User::where('created_at', '<=', $date->endOfDay())->count();
            $usersData[] = $usersCount;
            
            $teamsCount = Team::count(); // Команды не меняются, но можно добавить логику если нужно
            $teamsData[] = $teamsCount;
        }
        
        // Статистика команд по количеству игроков
        $teamsWithLowPlayers = []; // < 15 игроков
        $teamsWithFewPlayers = []; // 15-30 игроков
        
        $allTeams = Team::all();
        foreach ($allTeams as $team) {
            $playersCount = $this->transferService->getActivePlayersCount($team, $currentSeason);
            
            if ($playersCount < 15) {
                $teamsWithLowPlayers[] = [
                    'id' => $team->id,
                    'name' => $team->name,
                    'players_count' => $playersCount,
                ];
            } elseif ($playersCount >= 15 && $playersCount <= 30) {
                $teamsWithFewPlayers[] = [
                    'id' => $team->id,
                    'name' => $team->name,
                    'players_count' => $playersCount,
                ];
            }
        }
        
        // Статус системы
        $status = 'ok';
        $statusMessage = '';
        
        if ($totalRatio > 90) {
            $status = 'warning';
            $statusMessage = 'Критическая нехватка мест в командах!';
        } elseif ($totalRatio > 70) {
            $status = 'warning';
            $statusMessage = 'Нехватка мест в командах';
        } elseif ($totalRatio < 20) {
            $status = 'info';
            $statusMessage = 'Избыток свободных мест в командах';
        }
        
        return view('admin.dashboard', compact(
            'totalUsers',
            'totalTeams',
            'usersWithTeams',
            'activeUsers',
            'activeUsersWithTeams',
            'totalCapacity',
            'totalRatio',
            'activeCapacity',
            'activeRatio',
            'daysAgo',
            'usersData',
            'teamsData',
            'status',
            'statusMessage',
            'teamsWithLowPlayers',
            'teamsWithFewPlayers'
        ));
    }
}
