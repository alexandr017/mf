<?php

namespace App\Repositories\Admin\Tournaments;

use App\Models\Tournaments\Tournament;
use App\Repositories\Repository;
use Illuminate\Support\Collection;

class TournamentRepository extends Repository
{
    public function getForShow(): Collection
    {
        return Tournament::orderBy('id', 'desc')
            ->get();
    }

    public function find($id): Tournament|null
    {
        return Tournament::find($id);
    }

    public function findOrFail(int $id): Tournament
    {
        return Tournament::findOrFail($id);
    }

    public function getByAlias(string $alias): Tournament|null
    {
        return Tournament::where(['alias' => $alias])->first();
    }
}


