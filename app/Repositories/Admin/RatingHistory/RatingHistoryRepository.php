<?php

namespace App\Repositories\Admin\RatingHistory;

use App\Models\RatingHistory\RatingHistory;
use App\Repositories\Repository;
use Illuminate\Support\Collection;

class RatingHistoryRepository extends Repository
{
    public function getForShow(array $filters = []): Collection
    {
        $query = RatingHistory::with(['user', 'game']);

        if (!empty($filters['user_id'])) {
            $query->where('user_id', $filters['user_id']);
        }

        if (!empty($filters['type'])) {
            $query->where('type', $filters['type']);
        }

        if (!empty($filters['game_id'])) {
            $query->where('game_id', $filters['game_id']);
        }

        if (!empty($filters['date_from'])) {
            $query->whereDate('created_at', '>=', $filters['date_from']);
        }

        if (!empty($filters['date_to'])) {
            $query->whereDate('created_at', '<=', $filters['date_to']);
        }

        return $query->orderBy('created_at', 'desc')->get();
    }

    public function find($id): RatingHistory|null
    {
        return RatingHistory::with(['user', 'game'])->find($id);
    }

    public function findOrFail(int $id): RatingHistory
    {
        return RatingHistory::with(['user', 'game'])->findOrFail($id);
    }
}

