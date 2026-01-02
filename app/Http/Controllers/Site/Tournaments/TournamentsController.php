<?php

namespace App\Http\Controllers\Site\Tournaments;

use App\Models\Tournaments\Tournament;
use App\Models\FriendlyMatches\FriendlyMatch;
use DB;

class TournamentsController
{
//    public function index()
//    {
//        return view('site.v1.templates.tournaments.tournaments');
//    }
//
//    public function tournament(string $alias)
//    {
//        dd($alias);
//    }

// 1) Список турниров
    public function index()
    {
        $tournaments = DB::table('tournaments')
            ->leftJoin('countries', 'tournaments.country_id', '=', 'countries.id')
            ->select(
                'tournaments.id',
                'tournaments.name',
                'tournaments.type',
                'tournaments.image',
                'tournaments.color',
                'tournaments.participants_count',
                DB::raw('COALESCE(countries.id, NULL) as country_id'),
                DB::raw('COALESCE(countries.name, \'СНГ\') as country_name')
            )
            ->where('tournaments.status', 1)
            ->orderByRaw('CASE WHEN countries.id IS NULL THEN 0 ELSE countries.id END')
            ->orderBy('tournaments.type')
            ->orderBy('tournaments.name')
            ->get()
            ->groupBy(function($item) {
                // Группируем по country_id, но для NULL используем 'null' как ключ
                return $item->country_id ?? 'null';
            });

        // Получаем последние товарищеские матчи (5 штук)
        $friendlyMatches = FriendlyMatch::with(['homeTeam', 'awayTeam'])
            ->where('status', 'played')
            ->orderBy('date', 'desc')
            ->limit(5)
            ->get();

        return view('site.v1.templates.tournaments.tournaments', compact('tournaments', 'friendlyMatches'));
    }

    // 2) Список сезонов выбранного турнира
    public function tournament($tournamentID)
    {
        $tournament = DB::table('tournaments')
            ->leftJoin('countries', 'tournaments.country_id', '=', 'countries.id')
            ->select(
                'tournaments.*',
                'countries.name as country_name'
            )
            ->where('tournaments.id', $tournamentID)
            ->first();

        if (!$tournament) {
            abort(404);
        }

        $seasons = DB::table('tournaments_seasons')
            ->where(['tournament_id' => $tournamentID, 'status' => 1])
            ->orderBy('year_start', 'desc')
            ->get();

        return view('site.v1.templates.tournaments.tournament', compact('tournament', 'seasons'));
    }

    // 3) Конкретный сезон, включая стадии, группы и матчи
    public function season($tournamentID, $seasonID)
    {
        $tournament = Tournament::find($tournamentID);
        if (!$tournament) {
            abort(404);
        }

        $season = DB::table('tournaments_seasons')
            ->where(['tournament_id' => $tournamentID, 'id' => $seasonID])
            ->first();
        if (!$season) {
            abort(404);
        }

//        $tournamentsStages = DB::table('tournaments_stages')
//            ->where(['tournaments_season_id' => $seasonID])
//            ->get()
//            ->pluck('id');

//        $matches = DB::table('tournaments_matches')
//            ->whereIn('stage_id', $tournamentsStages)
//            ->get();

        $season = (object) $season;

        // СТАДИИ
        $season->stages = DB::table('tournaments_stages')
            ->where('tournaments_season_id', $seasonID)
            ->get()
            ->map(function ($stage) use ($seasonID) {

                // ГРУППЫ
                $stage->groups = DB::table('tournaments_groups')
                    ->where('stage_id', $stage->id)
                    ->get();

                // МАТЧИ
                $matches = DB::table('tournaments_matches')
                    ->where('stage_id', $stage->id)
                    ->get();

                // Подгружаем команды (home, away)
                $teamIDs = $matches->pluck('home_team_id')
                    ->merge($matches->pluck('away_team_id'))
                    ->unique()
                    ->toArray();

                $teams = DB::table('teams')
                    ->whereIn('id', $teamIDs)
                    ->pluck('name', 'id');

                // Добавляем к каждому матчу homeTeam / awayTeam
                $stage->matches = $matches->map(function ($m) use ($teams) {

                    $m->homeTeam = (object)[
                        'id' => $m->team_1,
                        'name' => $teams[$m->team_1] ?? 'Unknown'
                    ];

                    $m->awayTeam = (object)[
                        'id' => $m->team_2,
                        'name' => $teams[$m->team_2] ?? 'Unknown'
                    ];

                    return $m;
                });

                return $stage;
            });

        return view('site.v1.templates.tournaments.season', compact('tournament', 'season'));
    }
}
