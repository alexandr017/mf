<?php

namespace App\Http\Controllers\Site\Teams;

use App\Models\Teams\Team;
use App\Services\TeamTransferService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeamsController
{
    protected TeamTransferService $transferService;

    public function __construct(TeamTransferService $transferService)
    {
        $this->transferService = $transferService;
    }

    public function teams()
    {
        $teams = Team::with('city')
            ->get()
            ->map(function($team) {
                $team->city_name = $team->city ? $team->city->name : null;
                $team->players_count = $this->transferService->getActivePlayersCount($team);
                return $team;
            });
        
        return view('site.v1.templates.teams.teams', compact('teams'));
    }

    public function team(string $alias)
    {
        $team = Team::where('alias', $alias)->with('city')->first();
        if (!$team) {
            abort(404);
        }

        $user = Auth::user();
        $canJoin = null;
        $canLeave = null;
        $transferRules = $this->transferService->getTransferRules();
        $currentSeason = $this->transferService->getCurrentSeason();
        $activePlayersCount = $this->transferService->getActivePlayersCount($team);
        $currentUserTeam = null;

        if ($user) {
            $canJoin = $this->transferService->canJoinTeam($user, $team);
            
            // Проверяем, состоит ли пользователь в этой команде
            $currentUserTeam = \App\Models\UserTeams\UserTeam::where('user_id', $user->id)
                ->where('team_id', $team->id)
                ->where('season', $currentSeason)
                ->first();
            
            if ($currentUserTeam) {
                $canLeave = $this->transferService->canLeaveTeam($user, $team);
            }
        }

        return view('site.v1.templates.teams.team', compact(
            'team',
            'canJoin',
            'canLeave',
            'currentUserTeam',
            'transferRules',
            'activePlayersCount'
        ));
    }

    public function joinTeam(Request $request, string $alias)
    {
        if (!Auth::check()) {
            return response()->json([
                'success' => false,
                'message' => 'Необходимо войти в систему',
            ], 401);
        }

        $team = Team::where('alias', $alias)->first();
        if (!$team) {
            return response()->json([
                'success' => false,
                'message' => 'Команда не найдена',
            ], 404);
        }

        $user = Auth::user();
        $result = $this->transferService->joinTeam($user, $team);

        if ($result['success']) {
            return response()->json($result);
        } else {
            return response()->json($result, 400);
        }
    }

    public function leaveTeam(Request $request, string $alias)
    {
        if (!Auth::check()) {
            return response()->json([
                'success' => false,
                'message' => 'Необходимо войти в систему',
            ], 401);
        }

        $team = Team::where('alias', $alias)->first();
        if (!$team) {
            return response()->json([
                'success' => false,
                'message' => 'Команда не найдена',
            ], 404);
        }

        $user = Auth::user();
        $result = $this->transferService->leaveTeam($user, $team);

        if ($result['success']) {
            return response()->json($result);
        } else {
            return response()->json($result, 400);
        }
    }
}
