<?php

namespace App\Repositories\Admin\Transactions;

use App\Models\Transactions\Transaction;
use App\Repositories\Repository;
use Illuminate\Support\Collection;

class TransactionRepository extends Repository
{
    public function getForShow(array $filters = []): Collection
    {
        $query = Transaction::with(['user', 'game', 'match']);

        if (!empty($filters['user_id'])) {
            $query->where('user_id', $filters['user_id']);
        }

        if (!empty($filters['type'])) {
            $query->where('type', $filters['type']);
        }

        if (!empty($filters['game_id'])) {
            $query->where('game_id', $filters['game_id']);
        }

        if (!empty($filters['match_id'])) {
            $query->where('match_id', $filters['match_id']);
        }

        if (!empty($filters['date_from'])) {
            $query->whereDate('created_at', '>=', $filters['date_from']);
        }

        if (!empty($filters['date_to'])) {
            $query->whereDate('created_at', '<=', $filters['date_to']);
        }

        return $query->orderBy('created_at', 'desc')->get();
    }

    public function find($id): Transaction|null
    {
        return Transaction::with(['user', 'game', 'match'])->find($id);
    }

    public function findOrFail(int $id): Transaction
    {
        return Transaction::with(['user', 'game', 'match'])->findOrFail($id);
    }
}




