<?php

namespace App\Http\Controllers\Site\UpcomingGames;

use App\Models\FriendlyMatches\FriendlyMatch;
use App\Models\Tournaments\TournamentMatch;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class UpcomingGamesController
{
    public function index(Request $request): View
    {
        $now = \Carbon\Carbon::now();
        $yesterday = $now->copy()->subDay()->startOfDay();
        $today = $now->copy()->startOfDay();
        $tomorrow = $now->copy()->addDay()->startOfDay();
        $dayAfterTomorrow = $now->copy()->addDays(2)->startOfDay();

        // Загружаем товарищеские матчи
        $friendlyMatches = FriendlyMatch::with(['homeTeam', 'awayTeam'])->get();
        
        // Загружаем турнирные матчи с связями
        $tournamentMatches = TournamentMatch::with([
            'homeTeam',
            'awayTeam',
            'stage.season.tournament'
        ])->get();

        // Преобразуем матчи в единый формат
        $allMatches = new Collection();
        
        // Добавляем товарищеские матчи
        foreach ($friendlyMatches as $match) {
            $allMatches->push((object) [
                'id' => $match->id,
                'type' => 'friendly',
                'date' => $match->date,
                'status' => $match->status,
                'score_1' => $match->score_1,
                'score_2' => $match->score_2,
                'homeTeam' => $match->homeTeam,
                'awayTeam' => $match->awayTeam,
                'team_1' => $match->team_1,
                'team_2' => $match->team_2,
                'tournament_name' => null, // Для товарищеских матчей не указываем название турнира
            ]);
        }
        
        // Добавляем турнирные матчи
        foreach ($tournamentMatches as $match) {
            $tournamentName = 'Турнир';
            if ($match->stage && $match->stage->season && $match->stage->season->tournament) {
                $tournamentName = $match->stage->season->tournament->name;
            }
            
            $allMatches->push((object) [
                'id' => $match->id,
                'type' => 'tournament',
                'date' => $match->date,
                'status' => $match->status,
                'score_1' => $match->score_1,
                'score_2' => $match->score_2,
                'homeTeam' => $match->homeTeam,
                'awayTeam' => $match->awayTeam,
                'team_1' => $match->team_1,
                'team_2' => $match->team_2,
                'stage_id' => $match->stage_id,
                'group_id' => $match->group_id,
                'tournament_name' => $tournamentName,
            ]);
        }

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
                      ($request->has('date') && $request->date !== '') ||
                      ($request->has('match_type') && $request->match_type !== '');

        if ($hasFilters) {
            $filteredOld = $oldMatches->filter(function ($match) use ($request) {
                if ($request->has('status') && $request->status !== '' && $match->status !== $request->status) {
                    return false;
                }
                if ($request->has('date') && $request->date !== '' && $match->date && $match->date->format('Y-m-d') !== $request->date) {
                    return false;
                }
                if ($request->has('match_type') && $request->match_type !== '') {
                    if ($request->match_type === 'friendly' && $match->type !== 'friendly') {
                        return false;
                    }
                    if ($request->match_type === 'tournament' && $match->type !== 'tournament') {
                        return false;
                    }
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
                if ($request->has('match_type') && $request->match_type !== '') {
                    if ($request->match_type === 'friendly' && $match->type !== 'friendly') {
                        return false;
                    }
                    if ($request->match_type === 'tournament' && $match->type !== 'tournament') {
                        return false;
                    }
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
                if ($request->has('match_type') && $request->match_type !== '') {
                    if ($request->match_type === 'friendly' && $match->type !== 'friendly') {
                        return false;
                    }
                    if ($request->match_type === 'tournament' && $match->type !== 'tournament') {
                        return false;
                    }
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

        // Получаем уникальные даты для фильтра из всех матчей
        $friendlyDates = FriendlyMatch::selectRaw('DATE(date) as date')
            ->whereNotNull('date')
            ->distinct()
            ->orderBy('date', 'desc')
            ->pluck('date')
            ->map(function ($date) {
                return \Carbon\Carbon::parse($date)->format('Y-m-d');
            });

        $tournamentDates = TournamentMatch::selectRaw('DATE(date) as date')
            ->whereNotNull('date')
            ->distinct()
            ->orderBy('date', 'desc')
            ->pluck('date')
            ->map(function ($date) {
                return \Carbon\Carbon::parse($date)->format('Y-m-d');
            });

        $availableDates = $friendlyDates->merge($tournamentDates)->unique()->sortDesc()->values();

        return view('site.v1.templates.upcoming-games.index', compact(
            'oldMatchesByDate', 
            'recentMatchesByDate', 
            'futureMatchesByDate',
            'availableDates',
            'hasFilters'
        ));
    }
}
