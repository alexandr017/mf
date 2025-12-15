<?php

namespace App\Repositories\Admin\Games;

use App\Models\Games\Game;
use App\Repositories\Repository;
use Illuminate\Support\Collection;

class GameRepository extends Repository
{
    public function getForShow(): Collection
    {
        return Game::orderBy('order')
            ->orderBy('name')
            ->get();
    }

    public function find($id): Game|null
    {
        return Game::find($id);
    }

    public function findOrFail(int $id): Game
    {
        return Game::findOrFail($id);
    }
}

