<?php

namespace App\Repositories\Admin\Games;

use App\Models\Games\MatchPrediction;
use App\Repositories\Repository;
use Illuminate\Support\Collection;

class MatchPredictionRepository extends Repository
{
    public function getForShow(): Collection
    {
        return MatchPrediction::orderBy('match_date', 'desc')->get();
    }

    public function find($id): MatchPrediction|null
    {
        return MatchPrediction::find($id);
    }

    public function findOrFail(int $id): MatchPrediction
    {
        return MatchPrediction::findOrFail($id);
    }
}

