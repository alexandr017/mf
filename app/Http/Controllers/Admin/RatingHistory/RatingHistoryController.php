<?php

namespace App\Http\Controllers\Admin\RatingHistory;

use App\Http\Controllers\Admin\AdminController;
use App\Models\Games\Game;
use App\Models\User;
use App\Repositories\Admin\RatingHistory\RatingHistoryRepository;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

final class RatingHistoryController extends AdminController
{
    protected RatingHistoryRepository $ratingHistoryRepository;

    public function __construct()
    {
        parent::__construct();
        $this->ratingHistoryRepository = app(RatingHistoryRepository::class);
    }

    public function index(Request $request): View
    {
        $filters = [
            'user_id' => $request->get('user_id'),
            'type' => $request->get('type'),
            'game_id' => $request->get('game_id'),
            'date_from' => $request->get('date_from'),
            'date_to' => $request->get('date_to'),
        ];

        $ratingHistory = $this->ratingHistoryRepository->getForShow($filters);
        $games = Game::where('status', 1)->orderBy('name')->get(['id', 'name']);

        $breadcrumbs = [['h1' => 'История рейтинга']];

        return view('admin.rating-history.index', compact('ratingHistory', 'games', 'filters', 'breadcrumbs'));
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

