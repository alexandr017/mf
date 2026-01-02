<?php

namespace App\Http\Controllers\Site\Players;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PlayersController
{
    public function players()
    {
        // Total Players
        $totalPlayers = User::count();
        
        // Регистрации в этом месяце
        $thisMonthRegistrations = User::whereYear('created_at', now()->year)
            ->whereMonth('created_at', now()->month)
            ->count();
        
        // Active Players (заходили за последний год)
        $oneYearAgo = now()->subYear()->timestamp;
        $activePlayers = DB::table('sessions')
            ->where('last_activity', '>=', $oneYearAgo)
            ->whereNotNull('user_id')
            ->distinct('user_id')
            ->count('user_id');
        
        // Top Scorer
        $topScorer = User::orderBy('goals', 'desc')->first();
        
        // Highest Rated
        $highestRated = User::orderBy('rating', 'desc')->first();
        
        return view('site.v1.templates.players.players', [
            'totalPlayers' => $totalPlayers,
            'thisMonthRegistrations' => $thisMonthRegistrations,
            'activePlayers' => $activePlayers,
            'topScorer' => $topScorer,
            'highestRated' => $highestRated,
        ]);
    }

    public function player($alias)
    {
        // Пытаемся найти по nickname или по id
        $player = User::where(function($query) use ($alias) {
                $query->where('nickname', $alias)
                      ->orWhere('id', $alias);
            })
            ->first();
        
        if (!$player) {
            abort(404);
        }

        // Получаем текущую команду через user_teams (последний сезон)
        $currentUserTeam = $player->userTeams()
            ->with('team.city')
            ->orderBy('season', 'desc')
            ->first();
        
        $currentTeam = $currentUserTeam ? $currentUserTeam->team : null;
        
        // Получаем все сезоны пользователя с командами
        $userSeasons = $player->userTeams()
            ->with('team')
            ->orderBy('season', 'desc')
            ->get();
        
        // Получаем достижения пользователя
        $achievements = $player->achievements()
            ->orderBy('user_achievements.earned_at', 'desc')
            ->get();
        
        // Подсчитываем матчи (пока заглушка)
        $matchesCount = 0;
        
        // Статистика по сезонам (пока заглушки)
        $seasonStats = [];
        foreach ($userSeasons as $userTeam) {
            $seasonStats[] = [
                'season' => $userTeam->season, // Теперь это просто год (integer)
                'team' => $userTeam->team,
                'goals' => 0, // TODO: получить из таблицы статистики матчей
                'assists' => 0, // TODO: получить из таблицы статистики матчей
                'matches' => 0, // TODO: получить из таблицы статистики матчей
                'is_current' => $currentUserTeam && $currentUserTeam->id === $userTeam->id,
            ];
        }
        
        // Статистика по годам из товарищеских матчей
        $yearlyStats = [];
        $friendlyMatches = \App\Models\FriendlyMatches\FriendlyMatch::where('status', 'played')
            ->get()
            ->filter(function($match) use ($player) {
                // Проверяем участие в матче через scorers, assists или squad
                $hasInScorers = false;
                $hasInAssists = false;
                $hasInSquad = false;
                
                if ($match->scorers) {
                    foreach ($match->scorers as $scorer) {
                        if (isset($scorer['user_id']) && $scorer['user_id'] == $player->id) {
                            $hasInScorers = true;
                            break;
                        }
                    }
                }
                
                if ($match->assists) {
                    foreach ($match->assists as $assist) {
                        if (isset($assist['user_id']) && $assist['user_id'] == $player->id) {
                            $hasInAssists = true;
                            break;
                        }
                    }
                }
                
                if ($match->squad) {
                    $team1Squad = $match->squad['team_1'] ?? [];
                    $team2Squad = $match->squad['team_2'] ?? [];
                    $allSquad = array_merge($team1Squad, $team2Squad);
                    foreach ($allSquad as $squadItem) {
                        if (isset($squadItem['user_id']) && $squadItem['user_id'] == $player->id) {
                            $hasInSquad = true;
                            break;
                        }
                    }
                }
                
                return $hasInScorers || $hasInAssists || $hasInSquad;
            });
        
        foreach ($friendlyMatches as $match) {
            $year = $match->date ? $match->date->format('Y') : date('Y');
            if (!isset($yearlyStats[$year])) {
                $yearlyStats[$year] = ['goals' => 0, 'assists' => 0, 'matches' => 0];
            }
            
            // Подсчитываем голы
            if ($match->scorers) {
                foreach ($match->scorers as $scorer) {
                    if (isset($scorer['user_id']) && $scorer['user_id'] == $player->id) {
                        $goals = is_array($scorer['goals']) ? count($scorer['goals']) : ($scorer['goals'] ?? 0);
                        $yearlyStats[$year]['goals'] += $goals;
                    }
                }
            }
            
            // Подсчитываем ассисты
            if ($match->assists) {
                foreach ($match->assists as $assist) {
                    if (isset($assist['user_id']) && $assist['user_id'] == $player->id) {
                        $assists = is_array($assist['assists']) ? count($assist['assists']) : ($assist['assists'] ?? 0);
                        $yearlyStats[$year]['assists'] += $assists;
                    }
                }
            }
            
            // Проверяем участие в матче (если есть в заявке)
            if ($match->squad) {
                $team1Squad = $match->squad['team_1'] ?? [];
                $team2Squad = $match->squad['team_2'] ?? [];
                $allSquad = array_merge($team1Squad, $team2Squad);
                foreach ($allSquad as $squadItem) {
                    if (isset($squadItem['user_id']) && $squadItem['user_id'] == $player->id) {
                        $yearlyStats[$year]['matches']++;
                        break;
                    }
                }
            }
        }
        
        // Титулы по годам (пока заглушки)
        $titlesByYear = [];
        
        // Проверяем, является ли это профилем текущего пользователя
        $isOwnProfile = auth()->check() && auth()->id() === $player->id;
        
        // Загружаем родной город
        $player->load('hometownCity');
        
        return view('site.v1.templates.players.player', [
            'player' => $player,
            'currentTeam' => $currentTeam,
            'currentUserTeam' => $currentUserTeam,
            'matchesCount' => $matchesCount,
            'userSeasons' => $userSeasons,
            'achievements' => $achievements,
            'seasonStats' => $seasonStats,
            'titlesByYear' => $titlesByYear,
            'yearlyStats' => $yearlyStats,
            'isOwnProfile' => $isOwnProfile,
        ]);
    }

    public function api(Request $request)
    {
        $perPage = 50;
        $page = $request->get('page', 1);
        $search = $request->get('search', '');
        $sortBy = $request->get('sort_by', 'rating');
        $sortOrder = $request->get('sort_order', 'desc');

        $query = User::with(['teams' => function($q) {
            $q->latest('team_players.created_at')->take(1);
        }]);

        // Поиск
        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('nickname', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        // Сортировка
        $validSortFields = ['rating', 'goals', 'assists', 'matches'];
        if (!in_array($sortBy, $validSortFields)) {
            $sortBy = 'rating';
        }

        if ($sortBy === 'matches') {
            // Сортировка по количеству матчей (через gameResults)
            $query->withCount('gameResults as matches_count')
                  ->orderBy('matches_count', $sortOrder);
        } else {
            $query->orderBy($sortBy, $sortOrder);
        }

        $players = $query->paginate($perPage, ['*'], 'page', $page);

        // Получаем ID всех игроков для оптимизации запросов
        $userIds = $players->pluck('id')->toArray();
        
        // Получаем количество матчей для всех игроков одним запросом
        $matchesCounts = DB::table('user_game_results')
            ->select('user_id', DB::raw('COUNT(*) as matches_count'))
            ->whereIn('user_id', $userIds)
            ->groupBy('user_id')
            ->pluck('matches_count', 'user_id')
            ->toArray();
        
        // Получаем последние команды для всех игроков через user_teams одним запросом
        $latestUserTeams = collect();
        if (!empty($userIds)) {
            $latestUserTeams = DB::table('user_teams as ut1')
                ->select('ut1.user_id', 'ut1.team_id')
                ->whereIn('ut1.user_id', $userIds)
                ->whereRaw('ut1.created_at = (
                    SELECT MAX(ut2.created_at) 
                    FROM user_teams ut2 
                    WHERE ut2.user_id = ut1.user_id
                )')
                ->get()
                ->keyBy('user_id');
        }
        
        $teamIds = $latestUserTeams->pluck('team_id')->filter()->unique()->toArray();
        $teams = \App\Models\Teams\Team::whereIn('id', $teamIds)->get()->keyBy('id');
        
        // Добавляем данные к каждому игроку
        $players->getCollection()->transform(function($player) use ($matchesCounts, $latestUserTeams, $teams) {
            $player->matches_count = $matchesCounts[$player->id] ?? 0;
            
            // Используем nickname как alias, если нет - используем id
            $player->alias = $player->nickname ?: $player->id;
            
            $latestUserTeam = $latestUserTeams->get($player->id);
            if ($latestUserTeam && isset($teams[$latestUserTeam->team_id])) {
                $player->current_team = $teams[$latestUserTeam->team_id];
            } else {
                $player->current_team = null;
            }
            
            return $player;
        });

        return response()->json([
            'data' => $players->items(),
            'current_page' => $players->currentPage(),
            'last_page' => $players->lastPage(),
            'per_page' => $players->perPage(),
            'total' => $players->total(),
            'from' => $players->firstItem(),
            'to' => $players->lastItem(),
        ]);
    }
}
