<?php

namespace App\Repositories\Admin\Users;

use App\Models\User;
use App\Repositories\Repository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class UserRepository extends Repository
{
    /**
     * Получить пользователей с пагинацией
     */
    public function getForShow(int $perPage = 50): LengthAwarePaginator
    {
        return User::orderBy('rating', 'desc')
            ->orderBy('goals', 'desc')
            ->orderBy('name')
            ->paginate($perPage);
    }

    /**
     * Получить всех пользователей (для случаев, когда нужны все записи)
     * Используйте с осторожностью на больших объемах данных
     */
    public function getAllForShow(): Collection
    {
        return User::orderBy('rating', 'desc')
            ->orderBy('goals', 'desc')
            ->orderBy('name')
            ->get();
    }

    /**
     * Получить пользователей для DataTables с серверной обработкой
     */
    public function getForDataTables(array $params): array
    {
        $query = User::query();

        // Поиск
        if (!empty($params['search']['value'])) {
            $search = $params['search']['value'];
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
                
                // Поиск по числовым полям (если поисковый запрос - число)
                if (is_numeric($search)) {
                    $q->orWhere('goals', '=', (int)$search)
                      ->orWhere('assists', '=', (int)$search)
                      ->orWhere('rating', '=', (float)$search)
                      ->orWhere('referrals_count', '=', (int)$search);
                }
            });
        }

        // Подсчет общего количества (до фильтрации)
        $totalRecords = User::count();
        $filteredRecords = $query->count();

        // Сортировка
        if (!empty($params['order'])) {
            $columnIndex = $params['order'][0]['column'];
            $columnName = $params['columns'][$columnIndex]['data'];
            $direction = $params['order'][0]['dir'];

            // Маппинг колонок
            $columnMap = [
                'id' => 'id',
                'name' => 'name',
                'email' => 'email',
                'goals' => 'goals',
                'assists' => 'assists',
                'rating' => 'rating',
                'referrals_count' => 'referrals_count',
            ];

            if (isset($columnMap[$columnName])) {
                $query->orderBy($columnMap[$columnName], $direction);
            } else {
                // Сортировка по умолчанию
                $query->orderBy('rating', 'desc')
                      ->orderBy('goals', 'desc')
                      ->orderBy('name', 'asc');
            }
        } else {
            // Сортировка по умолчанию
            $query->orderBy('rating', 'desc')
                  ->orderBy('goals', 'desc')
                  ->orderBy('name', 'asc');
        }

        // Пагинация
        $start = $params['start'] ?? 0;
        $length = $params['length'] ?? 10;
        $users = $query->skip($start)->take($length)->get();

        return [
            'data' => $users,
            'recordsTotal' => $totalRecords,
            'recordsFiltered' => $filteredRecords,
        ];
    }

    public function find($id): User|null
    {
        return User::find($id);
    }

    public function findOrFail(int $id): User
    {
        return User::findOrFail($id);
    }
}


