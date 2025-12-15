<?php

namespace App\Repositories\Admin\Matches;

use App\Models\Tournaments\TournamentMatch;
use App\Repositories\Repository;
use Illuminate\Support\Collection;

class MatchRepository extends Repository
{
    public function getForShow($seasonId = null, $stageId = null): Collection
    {
        $query = TournamentMatch::with(['stage.season.tournament', 'group', 'homeTeam', 'awayTeam']);

        if ($seasonId) {
            $query->whereHas('stage', function($q) use ($seasonId) {
                $q->where('tournaments_season_id', $seasonId);
            });
        }

        if ($stageId) {
            $query->where('stage_id', $stageId);
        }

        return $query->orderBy('date', 'desc')
            ->orderBy('id', 'desc')
            ->get();
    }

    public function find($id): TournamentMatch|null
    {
        return TournamentMatch::with(['stage.season.tournament', 'group', 'homeTeam', 'awayTeam'])->find($id);
    }

    public function findOrFail(int $id): TournamentMatch
    {
        return TournamentMatch::with(['stage.season.tournament', 'group', 'homeTeam', 'awayTeam'])->findOrFail($id);
    }
}

