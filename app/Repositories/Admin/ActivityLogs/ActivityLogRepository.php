<?php

namespace App\Repositories\Admin\ActivityLogs;

use App\Models\ActivityLogs\ActivityLog;
use App\Repositories\Repository;
use Illuminate\Support\Collection;

class ActivityLogRepository extends Repository
{
    public function getForShow(array $filters = []): Collection
    {
        $query = ActivityLog::with('user');

        if (!empty($filters['user_id'])) {
            $query->where('user_id', $filters['user_id']);
        }

        if (!empty($filters['action'])) {
            $query->where('action', $filters['action']);
        }

        if (!empty($filters['model_type'])) {
            $query->where('model_type', $filters['model_type']);
        }

        if (!empty($filters['date_from'])) {
            $query->whereDate('created_at', '>=', $filters['date_from']);
        }

        if (!empty($filters['date_to'])) {
            $query->whereDate('created_at', '<=', $filters['date_to']);
        }

        return $query->orderBy('created_at', 'desc')->get();
    }

    /**
     * Получить логи для DataTables с серверной обработкой
     */
    public function getForDataTables(array $params): array
    {
        $query = ActivityLog::with('user');

        // Поиск
        if (!empty($params['search']['value'])) {
            $search = $params['search']['value'];
            $query->where(function($q) use ($search) {
                $q->where('action', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%")
                  ->orWhere('ip_address', 'like', "%{$search}%")
                  ->orWhere('model_type', 'like', "%{$search}%")
                  ->orWhereHas('user', function($q2) use ($search) {
                      $q2->where('name', 'like', "%{$search}%")
                         ->orWhere('email', 'like', "%{$search}%");
                  });
            });
        }

        // Фильтры из дополнительных параметров
        if (!empty($params['user_id'])) {
            $query->where('user_id', $params['user_id']);
        }

        if (!empty($params['action'])) {
            $query->where('action', $params['action']);
        }

        if (!empty($params['model_type'])) {
            $query->where('model_type', $params['model_type']);
        }

        if (!empty($params['date_from'])) {
            $query->whereDate('created_at', '>=', $params['date_from']);
        }

        if (!empty($params['date_to'])) {
            $query->whereDate('created_at', '<=', $params['date_to']);
        }

        // Подсчет общего количества (до фильтрации)
        $totalRecords = ActivityLog::count();
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
                'action' => 'action',
                'model_type' => 'model_type',
                'description' => 'description',
                'ip_address' => 'ip_address',
                'created_at' => 'created_at',
            ];

            if (isset($columnMap[$columnName])) {
                if ($columnName === 'user_name') {
                    // Используем leftJoin для сортировки по имени пользователя
                    $query->leftJoin('users', 'activity_logs.user_id', '=', 'users.id')
                          ->orderBy('users.name', $direction)
                          ->select('activity_logs.*');
                } else {
                    $query->orderBy($columnMap[$columnName], $direction);
                }
            } else {
                // Сортировка по умолчанию
                $query->orderBy('created_at', 'desc');
            }
        } else {
            // Сортировка по умолчанию
            $query->orderBy('created_at', 'desc');
        }

        // Пагинация
        $start = $params['start'] ?? 0;
        $length = $params['length'] ?? 10;
        $logs = $query->skip($start)->take($length)->get();

        return [
            'data' => $logs,
            'recordsTotal' => $totalRecords,
            'recordsFiltered' => $filteredRecords,
        ];
    }

    public function find($id): ActivityLog|null
    {
        return ActivityLog::with('user')->find($id);
    }

    public function findOrFail(int $id): ActivityLog
    {
        return ActivityLog::with('user')->findOrFail($id);
    }
}

