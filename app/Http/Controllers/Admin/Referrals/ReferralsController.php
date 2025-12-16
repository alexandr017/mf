<?php

namespace App\Http\Controllers\Admin\Referrals;

use App\Http\Controllers\Admin\AdminController;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

final class ReferralsController extends AdminController
{
    public function index(Request $request): View
    {
        // Оптимизированная статистика - используем простые COUNT запросы
        $totalReferrals = DB::table('users')->whereNotNull('referred_by_id')->count();
        
        // Количество уникальных рефереров (пользователей, которые пригласили хотя бы одного)
        $totalReferrers = DB::table('users')
            ->whereNotNull('referred_by_id')
            ->select('referred_by_id')
            ->distinct()
            ->count();

        // Топ-10 рефереров - используем простой запрос с группировкой
        $topReferrersData = DB::table('users')
            ->select('referred_by_id', DB::raw('COUNT(*) as referrals_count'))
            ->whereNotNull('referred_by_id')
            ->groupBy('referred_by_id')
            ->orderBy('referrals_count', 'desc')
            ->limit(10)
            ->get();

        // Получаем данные пользователей для топа
        $topReferrerIds = $topReferrersData->pluck('referred_by_id')->toArray();
        $topReferrers = collect();
        
        if (!empty($topReferrerIds)) {
            $referrers = User::whereIn('id', $topReferrerIds)
                ->get(['id', 'name', 'email', 'referral_code'])
                ->keyBy('id');
            
            // Формируем коллекцию с подсчетами
            foreach ($topReferrersData as $data) {
                if (isset($referrers[$data->referred_by_id])) {
                    $referrer = $referrers[$data->referred_by_id];
                    $referrer->referrals_count = $data->referrals_count;
                    $topReferrers->push($referrer);
                }
            }
        }

        $breadcrumbs = [['h1' => 'Статистика рефералов']];

        return view('admin.referrals.index', compact('totalReferrals', 'totalReferrers', 'topReferrers', 'breadcrumbs'));
    }

    /**
     * Получить данные для DataTables (AJAX)
     */
    public function dataTables(Request $request): \Illuminate\Http\JsonResponse
    {
        $params = $request->all();
        
        // Базовый запрос
        $query = DB::table('users as referred')
            ->leftJoin('users as referrer', 'referred.referred_by_id', '=', 'referrer.id')
            ->whereNotNull('referred.referred_by_id')
            ->select(
                'referred.id',
                'referred.name as referred_name',
                'referred.email as referred_email',
                'referred.created_at',
                'referrer.id as referrer_id',
                'referrer.name as referrer_name',
                'referrer.email as referrer_email',
                'referrer.referral_code as referrer_code'
            );

        // Фильтр по рефереру
        if (!empty($params['referrer_id'])) {
            $query->where('referred.referred_by_id', $params['referrer_id']);
        }

        // Фильтр по приглашенному
        if (!empty($params['referred_id'])) {
            $query->where('referred.id', $params['referred_id']);
        }

        // Фильтр по дате регистрации
        if (!empty($params['date_from'])) {
            $query->whereDate('referred.created_at', '>=', $params['date_from']);
        }

        if (!empty($params['date_to'])) {
            $query->whereDate('referred.created_at', '<=', $params['date_to']);
        }

        // Подсчет общего количества записей
        $recordsTotal = DB::table('users')->whereNotNull('referred_by_id')->count();
        
        // Поиск
        if (!empty($params['search']['value'])) {
            $search = $params['search']['value'];
            $query->where(function($q) use ($search) {
                $q->where('referred.name', 'like', "%{$search}%")
                  ->orWhere('referred.email', 'like', "%{$search}%")
                  ->orWhere('referrer.name', 'like', "%{$search}%")
                  ->orWhere('referrer.email', 'like', "%{$search}%");
            });
        }
        
        // Подсчет отфильтрованных записей
        $recordsFiltered = $query->count();

        // Сортировка
        $orderColumn = $params['columns'][$params['order'][0]['column']]['data'] ?? 'created_at';
        $orderDir = $params['order'][0]['dir'] ?? 'desc';
        
        if ($orderColumn === 'created_at') {
            $query->orderBy('referred.created_at', $orderDir);
        } elseif ($orderColumn === 'referred_name') {
            $query->orderBy('referred.name', $orderDir);
        } elseif ($orderColumn === 'referrer_name') {
            $query->orderBy('referrer.name', $orderDir);
        } else {
            $query->orderBy('referred.created_at', 'desc');
        }

        // Пагинация
        $start = $params['start'] ?? 0;
        $length = $params['length'] ?? 50;
        $query->skip($start)->take($length);

        $results = $query->get();

        $data = [];
        foreach ($results as $row) {
            $data[] = [
                'id' => $row->id,
                'referred_name' => $row->referred_name . ' (' . $row->referred_email . ')',
                'referrer_name' => $row->referrer_name ? $row->referrer_name . ' (' . $row->referrer_email . ')' : '-',
                'referrer_code' => $row->referrer_code ?? '-',
                'created_at' => date('d.m.Y H:i', strtotime($row->created_at)),
            ];
        }

        return response()->json([
            'draw' => intval($params['draw'] ?? 1),
            'recordsTotal' => $recordsTotal,
            'recordsFiltered' => $recordsFiltered,
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

