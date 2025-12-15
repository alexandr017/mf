<?php

namespace App\Repositories\Admin\Tickets;

use App\Models\Tickets\Ticket;
use App\Repositories\Repository;
use Illuminate\Support\Collection;

class TicketRepository extends Repository
{
    public function getForShow(array $filters = []): Collection
    {
        $query = Ticket::with(['createdBy', 'assignedTo', 'latestMessage']);

        if (!empty($filters['status'])) {
            $query->where('status', $filters['status']);
        }

        if (!empty($filters['priority'])) {
            $query->where('priority', $filters['priority']);
        }

        if (!empty($filters['created_by_user_id'])) {
            $query->where('created_by_user_id', $filters['created_by_user_id']);
        }

        if (!empty($filters['assigned_to_user_id'])) {
            $query->where('assigned_to_user_id', $filters['assigned_to_user_id']);
        }

        return $query->orderBy('created_at', 'desc')->get();
    }

    /**
     * Получить тикеты для DataTables с серверной обработкой
     */
    public function getForDataTables(array $params): array
    {
        $query = Ticket::with(['createdBy', 'assignedTo'])
            ->withCount('messages');

        // Поиск
        if (!empty($params['search']['value'])) {
            $search = $params['search']['value'];
            $query->where(function($q) use ($search) {
                $q->where('subject', 'like', "%{$search}%")
                  ->orWhereHas('createdBy', function($q2) use ($search) {
                      $q2->where('name', 'like', "%{$search}%")
                         ->orWhere('email', 'like', "%{$search}%");
                  })
                  ->orWhereHas('assignedTo', function($q3) use ($search) {
                      $q3->where('name', 'like', "%{$search}%")
                         ->orWhere('email', 'like', "%{$search}%");
                  });
            });
        }

        // Фильтры из дополнительных параметров
        if (!empty($params['status'])) {
            $query->where('status', $params['status']);
        }

        if (!empty($params['priority'])) {
            $query->where('priority', $params['priority']);
        }

        if (!empty($params['created_by_user_id'])) {
            $query->where('created_by_user_id', $params['created_by_user_id']);
        }

        if (!empty($params['assigned_to_user_id'])) {
            $query->where('assigned_to_user_id', $params['assigned_to_user_id']);
        }

        // Подсчет общего количества (до фильтрации)
        $totalRecords = Ticket::count();
        $filteredRecords = $query->count();

        // Сортировка
        if (!empty($params['order'])) {
            $columnIndex = $params['order'][0]['column'];
            $columnName = $params['columns'][$columnIndex]['data'];
            $direction = $params['order'][0]['dir'];

            // Маппинг колонок
            $columnMap = [
                'id' => 'id',
                'subject' => 'subject',
                'created_by_name' => 'created_by_user_id',
                'assigned_to_name' => 'assigned_to_user_id',
                'status' => 'status',
                'priority' => 'priority',
                'messages_count' => 'messages_count',
                'created_at' => 'created_at',
            ];

            if (isset($columnMap[$columnName])) {
                if ($columnName === 'created_by_name') {
                    // Используем leftJoin для сортировки по имени создателя
                    $query->leftJoin('users as created_by', 'tickets.created_by_user_id', '=', 'created_by.id')
                          ->orderBy('created_by.name', $direction)
                          ->select('tickets.*');
                } elseif ($columnName === 'assigned_to_name') {
                    // Используем leftJoin для сортировки по имени назначенного пользователя
                    $query->leftJoin('users as assigned_to', 'tickets.assigned_to_user_id', '=', 'assigned_to.id')
                          ->orderBy('assigned_to.name', $direction)
                          ->select('tickets.*');
                } elseif ($columnName === 'messages_count') {
                    // Сортировка по количеству сообщений
                    $query->orderBy('messages_count', $direction);
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
        $tickets = $query->skip($start)->take($length)->get();

        return [
            'data' => $tickets,
            'recordsTotal' => $totalRecords,
            'recordsFiltered' => $filteredRecords,
        ];
    }

    public function find($id): Ticket|null
    {
        return Ticket::with(['createdBy', 'assignedTo', 'messages.user'])->find($id);
    }

    public function findOrFail(string|int $id): Ticket
    {
        return Ticket::with(['createdBy', 'assignedTo', 'messages.user'])->findOrFail($id);
    }
}

