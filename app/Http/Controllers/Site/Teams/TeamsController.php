<?php

namespace App\Http\Controllers\Site\Teams;

class TeamsController
{
    public function teams()
    {
        $teams = \DB::table('teams')
            ->leftJoin('cities', 'teams.city_id', 'cities.id')
            ->select('teams.*', 'cities.name as city_name')
            ->get();
        return view('site.v1.templates.teams.teams', compact('teams'));
    }

    public function team(string $alias)
    {
        $team = \DB::table('teams')->where('alias', $alias)->first();
        if (!$team) {
            abort(404);
        }

        // Команда (страна, лого, название, город, титулы, последние матчи, ближайшие матчи, владельцы, место в турнирах)
        return view('site.v1.templates.teams.team', compact('team'));
    }
}
