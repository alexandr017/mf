<?php

namespace App\Repositories\Admin\TeamPlayers;

use App\Models\TeamPlayers\TeamPlayer;
use App\Repositories\Repository;
use Illuminate\Support\Collection;

class TeamPlayerRepository extends Repository
{
    public function getForShow(array $filters = []): Collection
    {
        $query = TeamPlayer::with(['team', 'user', 'season']);

        if (!empty($filters['team_id'])) {
            $query->where('team_id', $filters['team_id']);
        }

        if (!empty($filters['user_id'])) {
            $query->where('user_id', $filters['user_id']);
        }

        if (!empty($filters['season_id'])) {
            $query->where('season_id', $filters['season_id']);
        }

        return $query->orderBy('created_at', 'desc')->get();
    }

    public function find($id): TeamPlayer|null
    {
        return TeamPlayer::with(['team', 'user', 'season'])->find($id);
    }

    public function findOrFail(int $id): TeamPlayer
    {
        return TeamPlayer::with(['team', 'user', 'season'])->findOrFail($id);
    }
}

