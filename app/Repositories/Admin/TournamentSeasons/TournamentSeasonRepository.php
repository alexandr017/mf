<?php

namespace App\Repositories\Admin\TournamentSeasons;

use App\Models\Tournaments\TournamentSeason;
use App\Repositories\Repository;
use Illuminate\Support\Collection;

class TournamentSeasonRepository extends Repository
{
    public function getForShow(?int $tournamentId = null): Collection
    {
        $query = TournamentSeason::with(['tournament', 'stages.matches'])
            ->orderBy('year_start', 'desc')
            ->orderBy('year_finish', 'desc');

        if ($tournamentId) {
            $query->where('tournament_id', $tournamentId);
        }

        return $query->get();
    }

    public function find($id): TournamentSeason|null
    {
        return TournamentSeason::find($id);
    }

    public function findOrFail(int $id): TournamentSeason
    {
        return TournamentSeason::findOrFail($id);
    }
}

