<?php

namespace App\Repositories\Admin\Teams;

use App\Models\Teams\Team;
use App\Repositories\Repository;
use Illuminate\Support\Collection;

class TeamRepository extends Repository
{
    public function getForShow(): Collection
    {
        return Team::orderBy('name')
            ->get();
    }

    public function find($id): Team|null
    {
        return Team::find($id);
    }

    public function findOrFail(int $id): Team
    {
        return Team::findOrFail($id);
    }

    public function getByAlias(string $alias): Team|null
    {
        return Team::where(['alias' => $alias])->first();
    }
}




