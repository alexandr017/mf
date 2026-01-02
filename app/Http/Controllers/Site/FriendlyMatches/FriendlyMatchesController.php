<?php

namespace App\Http\Controllers\Site\FriendlyMatches;

use App\Models\FriendlyMatches\FriendlyMatch;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class FriendlyMatchesController
{
    public function index(Request $request): View
    {
        $now = \Carbon\Carbon::now();
        $yesterday = $now->copy()->subDay()->startOfDay();
        $today = $now->copy()->startOfDay();
        $tomorrow = $now->copy()->addDay()->startOfDay();
        $dayAfterTomorrow = $now->copy()->addDays(2)->startOfDay();

        $allMatches = FriendlyMatch::with(['homeTeam', 'awayTeam'])->get();

        // Вкладка 1: Старые матчи (позднее вчера) - от менее давних к более давним
        $oldMatches = $allMatches->filter(function ($match) use ($yesterday) {
            return $match->date && $match->date->lt($yesterday);
        })->sortBy('date'); // От менее давних к более давним

        // Вкладка 2: Вчера, сегодня, завтра
        $recentMatches = $allMatches->filter(function ($match) use ($yesterday, $dayAfterTomorrow) {
            return $match->date && 
                   $match->date->gte($yesterday) && 
                   $match->date->lt($dayAfterTomorrow);
        })->sortBy('date');

        // Вкладка 3: Будущие (после завтра) - чем позже игра, тем ниже
        $futureMatches = $allMatches->filter(function ($match) use ($dayAfterTomorrow) {
            return $match->date && $match->date->gte($dayAfterTomorrow);
        })->sortByDesc('date'); // Чем позже, тем ниже

        // Если есть фильтры, применяем их ко всем вкладкам
        $hasFilters = $request->has('status') && $request->status !== '' || 
                      ($request->has('date') && $request->date !== '');

        if ($hasFilters) {
            $filteredOld = $oldMatches->filter(function ($match) use ($request) {
                if ($request->has('status') && $request->status !== '' && $match->status !== $request->status) {
                    return false;
                }
                if ($request->has('date') && $request->date !== '' && $match->date && $match->date->format('Y-m-d') !== $request->date) {
                    return false;
                }
                return true;
            });

            $filteredRecent = $recentMatches->filter(function ($match) use ($request) {
                if ($request->has('status') && $request->status !== '' && $match->status !== $request->status) {
                    return false;
                }
                if ($request->has('date') && $request->date !== '' && $match->date && $match->date->format('Y-m-d') !== $request->date) {
                    return false;
                }
                return true;
            });

            $filteredFuture = $futureMatches->filter(function ($match) use ($request) {
                if ($request->has('status') && $request->status !== '' && $match->status !== $request->status) {
                    return false;
                }
                if ($request->has('date') && $request->date !== '' && $match->date && $match->date->format('Y-m-d') !== $request->date) {
                    return false;
                }
                return true;
            });

            $oldMatches = $filteredOld;
            $recentMatches = $filteredRecent;
            $futureMatches = $filteredFuture;
        }

        // Группируем по дням для каждой вкладки
        $oldMatchesByDate = $oldMatches->groupBy(function ($match) {
            return $match->date ? $match->date->format('Y-m-d') : 'no-date';
        });

        $recentMatchesByDate = $recentMatches->groupBy(function ($match) {
            return $match->date ? $match->date->format('Y-m-d') : 'no-date';
        });

        $futureMatchesByDate = $futureMatches->groupBy(function ($match) {
            return $match->date ? $match->date->format('Y-m-d') : 'no-date';
        });

        // Получаем уникальные даты для фильтра
        $availableDates = FriendlyMatch::selectRaw('DATE(date) as date')
            ->distinct()
            ->orderBy('date', 'desc')
            ->pluck('date')
            ->map(function ($date) {
                return \Carbon\Carbon::parse($date)->format('Y-m-d');
            });

        return view('site.v1.templates.friendly-matches.index', compact(
            'oldMatchesByDate', 
            'recentMatchesByDate', 
            'futureMatchesByDate',
            'availableDates',
            'hasFilters'
        ));
    }

    public function show(string $id): View
    {
        $match = FriendlyMatch::with(['homeTeam', 'awayTeam'])->findOrFail($id);

        if ($match->status !== 'played') {
            abort(404, 'Матч еще не сыгран');
        }

        // Загружаем данные о голах и ассистах
        $scorers = [];
        $assists = [];
        
        if ($match->scorers) {
            foreach ($match->scorers as $scorer) {
                $user = \App\Models\User::find($scorer['user_id'] ?? null);
                if ($user) {
                    $goals = [];
                    if (isset($scorer['goals']) && is_array($scorer['goals'])) {
                        foreach ($scorer['goals'] as $goal) {
                            if (is_array($goal) && isset($goal['minute'])) {
                                $goals[] = $goal['minute'];
                            } elseif (is_numeric($goal)) {
                                $goals[] = $goal;
                            }
                        }
                    }
                    $scorers[] = [
                        'user' => $user,
                        'goals' => $goals,
                    ];
                }
            }
        }
        
        if ($match->assists) {
            foreach ($match->assists as $assist) {
                $user = \App\Models\User::find($assist['user_id'] ?? null);
                if ($user) {
                    $assistsList = [];
                    if (isset($assist['assists']) && is_array($assist['assists'])) {
                        foreach ($assist['assists'] as $assistItem) {
                            if (is_array($assistItem) && isset($assistItem['minute'])) {
                                $assistsList[] = $assistItem['minute'];
                            } elseif (is_numeric($assistItem)) {
                                $assistsList[] = $assistItem;
                            }
                        }
                    }
                    $assists[] = [
                        'user' => $user,
                        'assists' => $assistsList,
                    ];
                }
            }
        }

        // Загружаем данные о заявках и заменах
        $squad = $match->squad ?? null;
        $team1Squad = [];
        $team2Squad = [];

        if ($squad) {
            $team1Squad = $squad['team_1'] ?? [];
            $team2Squad = $squad['team_2'] ?? [];
        }

        // Загружаем информацию об игроках
        $team1Players = [];
        $team2Players = [];

        foreach ($team1Squad as $squadItem) {
            $user = \App\Models\User::find($squadItem['user_id'] ?? null);
            if ($user) {
                $team1Players[] = [
                    'user' => $user,
                    'start_minute' => $squadItem['start_minute'] ?? 0,
                    'end_minute' => $squadItem['end_minute'] ?? 90,
                ];
            }
        }

        foreach ($team2Squad as $squadItem) {
            $user = \App\Models\User::find($squadItem['user_id'] ?? null);
            if ($user) {
                $team2Players[] = [
                    'user' => $user,
                    'start_minute' => $squadItem['start_minute'] ?? 0,
                    'end_minute' => $squadItem['end_minute'] ?? 90,
                ];
            }
        }

        return view('site.v1.templates.friendly-matches.show', compact('match', 'scorers', 'assists', 'team1Players', 'team2Players'));
    }
}

