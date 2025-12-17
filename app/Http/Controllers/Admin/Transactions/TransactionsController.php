<?php

namespace App\Http\Controllers\Admin\Transactions;

use App\Http\Controllers\Admin\AdminController;
use App\Models\Games\Game;
use App\Models\Tournaments\TournamentMatch;
use App\Models\User;
use App\Repositories\Admin\Transactions\TransactionRepository;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

final class TransactionsController extends AdminController
{
    protected TransactionRepository $transactionRepository;

    public function __construct()
    {
        parent::__construct();
        $this->transactionRepository = app(TransactionRepository::class);
    }

    public function index(Request $request): View
    {
        $filters = [
            'user_id' => $request->get('user_id'),
            'type' => $request->get('type'),
            'game_id' => $request->get('game_id'),
            'match_id' => $request->get('match_id'),
            'date_from' => $request->get('date_from'),
            'date_to' => $request->get('date_to'),
        ];

        $transactions = $this->transactionRepository->getForShow($filters);
        $users = User::orderBy('name')->limit(1000)->get(['id', 'name']);
        $games = Game::where('status', 1)->orderBy('name')->get(['id', 'name']);

        $breadcrumbs = [['h1' => 'Транзакции']];

        return view('admin.transactions.index', compact('transactions', 'users', 'games', 'filters', 'breadcrumbs'));
    }
}


