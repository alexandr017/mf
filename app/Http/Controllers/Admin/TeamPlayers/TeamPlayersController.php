<?php

namespace App\Http\Controllers\Admin\TeamPlayers;

use App\Http\Controllers\Admin\AdminController;
use App\Http\Requests\Admin\TeamPlayers\TeamPlayerRequest;
use App\Models\Teams\Team;
use App\Models\TeamPlayers\TeamPlayer;
use App\Models\Tournaments\TournamentSeason;
use App\Models\User;
use App\Repositories\Admin\TeamPlayers\TeamPlayerRepository;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

final class TeamPlayersController extends AdminController
{
    protected TeamPlayerRepository $teamPlayerRepository;

    public function __construct()
    {
        parent::__construct();
        $this->teamPlayerRepository = app(TeamPlayerRepository::class);
    }

    public function index(Request $request): View
    {
        $filters = [
            'team_id' => $request->get('team_id'),
            'user_id' => $request->get('user_id'),
            'season_id' => $request->get('season_id'),
        ];

        $teamPlayers = $this->teamPlayerRepository->getForShow($filters);
        $teams = Team::where('status', 1)->orderBy('name')->get(['id', 'name']);
        $users = User::orderBy('name')->limit(1000)->get(['id', 'name']);
        $seasons = TournamentSeason::orderBy('year_start', 'desc')->get(['id', 'year_start', 'year_finish']);

        $breadcrumbs = [['h1' => 'Составы команд']];

        return view('admin.team-players.index', compact('teamPlayers', 'teams', 'users', 'seasons', 'filters', 'breadcrumbs'));
    }

    public function create(): View
    {
        $teams = Team::where('status', 1)->orderBy('name')->get(['id', 'name']);
        $users = User::orderBy('name')->limit(1000)->get(['id', 'name']);
        $seasons = TournamentSeason::orderBy('year_start', 'desc')->get(['id', 'year_start', 'year_finish']);

        $breadcrumbs = [
            ['h1' => 'Составы команд', 'link' => route('admin.team-players.index')],
            ['h1' => 'Создание'],
        ];

        return view('admin.team-players.create', compact('teams', 'users', 'seasons', 'breadcrumbs'));
    }

    public function store(TeamPlayerRequest $request): RedirectResponse
    {
        $data = $request->all();
        $data = empty_str_to_null($data);

        // Проверяем, не существует ли уже такой записи
        $exists = TeamPlayer::where('team_id', $data['team_id'])
            ->where('user_id', $data['user_id'])
            ->where('season_id', $data['season_id'])
            ->exists();

        if ($exists) {
            return redirect()
                ->route('admin.team-players.create')
                ->with('flash_errors', 'Этот игрок уже состоит в этой команде в данном сезоне!')
                ->withInput();
        }

        $item = new TeamPlayer($data);
        $result = $item->save();

        if ($result) {
            return redirect()
                ->route('admin.team-players.index')
                ->with('flash_success', 'Игрок добавлен в команду!');
        }

        return redirect()
            ->route('admin.team-players.index')
            ->with('flash_errors', 'Ошибка создания!');
    }

    public function edit(string $id): View
    {
        $item = $this->teamPlayerRepository->findOrFail($id);
        $teams = Team::where('status', 1)->orderBy('name')->get(['id', 'name']);
        $users = User::orderBy('name')->limit(1000)->get(['id', 'name']);
        $seasons = TournamentSeason::orderBy('year_start', 'desc')->get(['id', 'year_start', 'year_finish']);

        $breadcrumbs = [
            ['h1' => 'Составы команд', 'link' => route('admin.team-players.index')],
            ['h1' => 'Редактирование'],
        ];

        return view('admin.team-players.edit', compact('item', 'teams', 'users', 'seasons', 'breadcrumbs'));
    }

    public function update(TeamPlayerRequest $request, string $id): RedirectResponse
    {
        $item = $this->teamPlayerRepository->findOrFail($id);
        $data = $request->all();
        $data = empty_str_to_null($data);

        // Проверяем, не существует ли уже такой записи (кроме текущей)
        $exists = TeamPlayer::where('team_id', $data['team_id'])
            ->where('user_id', $data['user_id'])
            ->where('season_id', $data['season_id'])
            ->where('id', '!=', $id)
            ->exists();

        if ($exists) {
            return redirect()
                ->route('admin.team-players.edit', $id)
                ->with('flash_errors', 'Этот игрок уже состоит в этой команде в данном сезоне!')
                ->withInput();
        }

        $result = $item->update($data);

        if ($result) {
            return redirect()
                ->route('admin.team-players.index')
                ->with('flash_success', 'Состав обновлен!');
        }

        return redirect()
            ->route('admin.team-players.index')
            ->with('flash_errors', 'Ошибка обновления!');
    }

    public function destroy(string $id): RedirectResponse
    {
        $item = $this->teamPlayerRepository->findOrFail($id);
        $result = $item->delete();

        if ($result) {
            return redirect()
                ->route('admin.team-players.index')
                ->with('flash_success', 'Игрок удален из команды!');
        }

        return redirect()
            ->route('admin.team-players.index')
            ->with('flash_errors', 'Ошибка удаления!');
    }
}




