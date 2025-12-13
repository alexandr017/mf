<?php

namespace App\Http\Controllers\Site\Tournaments;

use App\Models\Tournaments\TournamentMatch;

class MatchController
{
    // 4) Просмотр конкретного матча
    public function show(TournamentMatch $match)
    {
        $match->load(['homeTeam', 'awayTeam', 'stage', 'group']);

        return view('matches.show', compact('match'));
    }
}
