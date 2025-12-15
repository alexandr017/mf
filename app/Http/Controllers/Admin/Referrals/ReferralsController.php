<?php

namespace App\Http\Controllers\Admin\Referrals;

use App\Http\Controllers\Admin\AdminController;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

final class ReferralsController extends AdminController
{
    public function index(Request $request): View
    {
        $filters = [
            'referrer_id' => $request->get('referrer_id'),
            'referred_id' => $request->get('referred_id'),
            'date_from' => $request->get('date_from'),
            'date_to' => $request->get('date_to'),
        ];

        $query = User::with('referredBy');

        // Фильтр по рефереру
        if (!empty($filters['referrer_id'])) {
            $query->where('referred_by_id', $filters['referrer_id']);
        }

        // Фильтр по приглашенному
        if (!empty($filters['referred_id'])) {
            $query->where('id', $filters['referred_id']);
        }

        // Фильтр по дате регистрации
        if (!empty($filters['date_from'])) {
            $query->whereDate('created_at', '>=', $filters['date_from']);
        }

        if (!empty($filters['date_to'])) {
            $query->whereDate('created_at', '<=', $filters['date_to']);
        }

        $referrals = $query->whereNotNull('referred_by_id')->orderBy('created_at', 'desc')->get();

        // Статистика
        $totalReferrals = User::whereNotNull('referred_by_id')->count();
        $totalReferrers = User::whereHas('referrals')->distinct()->count();
        $topReferrers = User::withCount('referrals')
            ->whereHas('referrals')
            ->orderBy('referrals_count', 'desc')
            ->limit(10)
            ->get();

        $users = User::orderBy('name')->limit(1000)->get(['id', 'name', 'email']);

        $breadcrumbs = [['h1' => 'Статистика рефералов']];

        return view('admin.referrals.index', compact('referrals', 'users', 'filters', 'totalReferrals', 'totalReferrers', 'topReferrers', 'breadcrumbs'));
    }
}

