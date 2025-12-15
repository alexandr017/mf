<?php

namespace App\Http\Controllers\Admin\UserGameResults;

use App\Http\Controllers\Admin\AdminController;
use App\Models\Games\Game;
use App\Models\User;
use App\Models\UserGameResults\UserGameResult;
use App\Repositories\Admin\UserGameResults\UserGameResultRepository;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

final class UserGameResultsController extends AdminController
{
    protected UserGameResultRepository $resultRepository;

    public function __construct()
    {
        parent::__construct();
        $this->resultRepository = app(UserGameResultRepository::class);
    }

    public function index(Request $request): View
    {
        // Получаем уникальные игры для фильтров
        $games = Game::where('status', 1)->orderBy('name')->get(['id', 'name']);

        $breadcrumbs = [['h1' => 'Результаты игр']];

        return view('admin.user-game-results.index', compact('games', 'breadcrumbs'));
    }

    /**
     * Получить данные для DataTables (AJAX)
     */
    public function dataTables(Request $request): \Illuminate\Http\JsonResponse
    {
        $params = $request->all();
        
        // Добавляем фильтры из параметров
        $params['user_id'] = $request->get('user_id') ?: null;
        $params['game_id'] = $request->get('game_id') ?: null;
        $params['win'] = $request->get('win') ?: null;
        $params['date_from'] = $request->get('date_from') ?: null;
        $params['date_to'] = $request->get('date_to') ?: null;
        
        $result = $this->resultRepository->getForDataTables($params);

        $data = [];
        foreach ($result['data'] as $resultItem) {
            $data[] = [
                'id' => $resultItem->id,
                'user_name' => $resultItem->user ? $resultItem->user->name . ' (' . $resultItem->user->email . ')' : '-',
                'game_name' => $resultItem->game ? $resultItem->game->name : '-',
                'score' => $resultItem->score,
                'rating_points_earned' => $resultItem->rating_points_earned,
                'win' => $resultItem->win,
                'played_at' => $resultItem->played_at->format('d.m.Y H:i'),
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

