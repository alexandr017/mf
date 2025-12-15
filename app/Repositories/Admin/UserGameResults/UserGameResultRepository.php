<?php

namespace App\Repositories\Admin\UserGameResults;

use App\Models\UserGameResults\UserGameResult;
use App\Repositories\Repository;
use Illuminate\Support\Collection;

class UserGameResultRepository extends Repository
{
    public function getForShow(array $filters = []): Collection
    {
        $query = UserGameResult::with(['user', 'game']);

        if (!empty($filters['user_id'])) {
            $query->where('user_id', $filters['user_id']);
        }

        if (!empty($filters['game_id'])) {
            $query->where('game_id', $filters['game_id']);
        }

        if (!empty($filters['win'])) {
            $query->where('win', $filters['win'] == '1');
        }

        if (!empty($filters['date_from'])) {
            $query->whereDate('played_at', '>=', $filters['date_from']);
        }

        if (!empty($filters['date_to'])) {
            $query->whereDate('played_at', '<=', $filters['date_to']);
        }

        return $query->orderBy('played_at', 'desc')->get();
    }

    /**
     * Получить результаты игр для DataTables с серверной обработкой
     */
    public function getForDataTables(array $params): array
    {
        $query = UserGameResult::with(['user', 'game']);

        // Поиск
        if (!empty($params['search']['value'])) {
            $search = $params['search']['value'];
            $query->where(function($q) use ($search) {
                $q->where('score', 'like', "%{$search}%")
                  ->orWhere('rating_points_earned', 'like', "%{$search}%")
                  ->orWhereHas('user', function($q2) use ($search) {
                      $q2->where('name', 'like', "%{$search}%")
                         ->orWhere('email', 'like', "%{$search}%");
                  })
                  ->orWhereHas('game', function($q3) use ($search) {
                      $q3->where('name', 'like', "%{$search}%");
                  });
            });
        }

        // Фильтры из дополнительных параметров
        if (!empty($params['user_id'])) {
            $query->where('user_id', $params['user_id']);
        }

        if (!empty($params['game_id'])) {
            $query->where('game_id', $params['game_id']);
        }

        if (!empty($params['win'])) {
            $query->where('win', $params['win'] == '1');
        }

        if (!empty($params['date_from'])) {
            $query->whereDate('played_at', '>=', $params['date_from']);
        }

        if (!empty($params['date_to'])) {
            $query->whereDate('played_at', '<=', $params['date_to']);
        }

        // Подсчет общего количества (до фильтрации)
        $totalRecords = UserGameResult::count();
        $filteredRecords = $query->count();

        // Сортировка
        if (!empty($params['order'])) {
            $columnIndex = $params['order'][0]['column'];
            $columnName = $params['columns'][$columnIndex]['data'];
            $direction = $params['order'][0]['dir'];

            // Маппинг колонок
            $columnMap = [
                'id' => 'id',
                'user_name' => 'user_id',
                'game_name' => 'game_id',
                'score' => 'score',
                'rating_points_earned' => 'rating_points_earned',
                'win' => 'win',
                'played_at' => 'played_at',
            ];

            if (isset($columnMap[$columnName])) {
                if ($columnName === 'user_name') {
                    // Используем leftJoin для сортировки по имени пользователя
                    $query->leftJoin('users', 'user_game_results.user_id', '=', 'users.id')
                          ->orderBy('users.name', $direction)
                          ->select('user_game_results.*');
                } elseif ($columnName === 'game_name') {
                    // Используем leftJoin для сортировки по названию игры
                    $query->leftJoin('games', 'user_game_results.game_id', '=', 'games.id')
                          ->orderBy('games.name', $direction)
                          ->select('user_game_results.*');
                } else {
                    $query->orderBy($columnMap[$columnName], $direction);
                }
            } else {
                // Сортировка по умолчанию
                $query->orderBy('played_at', 'desc');
            }
        } else {
            // Сортировка по умолчанию
            $query->orderBy('played_at', 'desc');
        }

        // Пагинация
        $start = $params['start'] ?? 0;
        $length = $params['length'] ?? 10;
        $results = $query->skip($start)->take($length)->get();

        return [
            'data' => $results,
            'recordsTotal' => $totalRecords,
            'recordsFiltered' => $filteredRecords,
        ];
    }

    public function find($id): UserGameResult|null
    {
        return UserGameResult::with(['user', 'game'])->find($id);
    }

    public function findOrFail(int $id): UserGameResult
    {
        return UserGameResult::with(['user', 'game'])->findOrFail($id);
    }
}

