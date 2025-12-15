<?php

namespace App\Http\Controllers\Admin\ActivityLogs;

use App\Http\Controllers\Admin\AdminController;
use App\Models\ActivityLogs\ActivityLog;
use App\Models\User;
use App\Repositories\Admin\ActivityLogs\ActivityLogRepository;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

final class ActivityLogsController extends AdminController
{
    protected ActivityLogRepository $activityLogRepository;

    public function __construct()
    {
        parent::__construct();
        $this->activityLogRepository = app(ActivityLogRepository::class);
    }

    public function index(Request $request): View
    {
        // Получаем уникальные действия и типы моделей для фильтров
        $actions = ActivityLog::distinct()->pluck('action')->sort()->values();
        $modelTypes = ActivityLog::distinct()->pluck('model_type')->filter()->sort()->values();

        $breadcrumbs = [['h1' => 'Логи действий']];

        return view('admin.activity-logs.index', compact('actions', 'modelTypes', 'breadcrumbs'));
    }

    /**
     * Получить данные для DataTables (AJAX)
     */
    public function dataTables(Request $request): \Illuminate\Http\JsonResponse
    {
        $params = $request->all();
        
        // Добавляем фильтры из параметров
        $params['user_id'] = $request->get('user_id') ?: null;
        $params['action'] = $request->get('action') ?: null;
        $params['model_type'] = $request->get('model_type') ?: null;
        $params['date_from'] = $request->get('date_from') ?: null;
        $params['date_to'] = $request->get('date_to') ?: null;
        
        $result = $this->activityLogRepository->getForDataTables($params);

        $data = [];
        foreach ($result['data'] as $log) {
            $data[] = [
                'id' => $log->id,
                'user_name' => $log->user ? $log->user->name . ' (' . $log->user->email . ')' : 'Система',
                'action' => $log->action,
                'model_type' => $log->model_type 
                    ? class_basename($log->model_type) . ' #' . $log->model_id 
                    : '-',
                'description' => Str::limit($log->description ?? '-', 100),
                'ip_address' => $log->ip_address ?? '-',
                'created_at' => $log->created_at->format('d.m.Y H:i:s'),
            ];
        }

        return response()->json([
            'draw' => intval($params['draw'] ?? 1),
            'recordsTotal' => $result['recordsTotal'],
            'recordsFiltered' => $result['recordsFiltered'],
            'data' => $data,
        ]);
    }

    /**
     * Поиск пользователей через AJAX
     */
    public function searchUsers(Request $request): \Illuminate\Http\JsonResponse
    {
        $search = $request->get('q', '');
        
        $users = User::where('name', 'like', "%{$search}%")
            ->orWhere('email', 'like', "%{$search}%")
            ->limit(20)
            ->get(['id', 'name', 'email']);

        $results = [];
        foreach ($users as $user) {
            $results[] = [
                'id' => $user->id,
                'text' => $user->name . ' (' . $user->email . ')',
            ];
        }

        return response()->json(['results' => $results]);
    }
}

