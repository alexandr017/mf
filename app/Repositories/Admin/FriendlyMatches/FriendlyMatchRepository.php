<?php

namespace App\Repositories\Admin\FriendlyMatches;

use App\Models\FriendlyMatches\FriendlyMatch;
use App\Repositories\Repository;
use Illuminate\Support\Collection;

class FriendlyMatchRepository extends Repository
{
    public function getForShow(): Collection
    {
        return FriendlyMatch::with(['homeTeam', 'awayTeam'])
            ->orderBy('date', 'desc')
            ->orderBy('id', 'desc')
            ->get();
    }

    public function find($id): FriendlyMatch|null
    {
        return FriendlyMatch::find($id);
    }

    public function findOrFail(int $id): FriendlyMatch
    {
        return FriendlyMatch::with(['homeTeam', 'awayTeam'])->findOrFail($id);
    }
}

