<?php

namespace App\Repositories\Admin\TournamentTemplates;

use App\Models\Tournaments\TournamentTemplate;
use App\Repositories\Repository;
use Illuminate\Support\Collection;

class TournamentTemplateRepository extends Repository
{
    public function getForShow(): Collection
    {
        return TournamentTemplate::orderBy('type')
            ->orderBy('name')
            ->get();
    }

    public function find($id): TournamentTemplate|null
    {
        return TournamentTemplate::find($id);
    }

    public function findOrFail(int $id): TournamentTemplate
    {
        return TournamentTemplate::findOrFail($id);
    }
}

