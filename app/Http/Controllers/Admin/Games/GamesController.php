<?php

namespace App\Http\Controllers\Admin\Games;

use App\Http\Controllers\Admin\AdminController;
use App\Http\Requests\Admin\Games\GameRequest;
use App\Models\GameCategories\GameCategory;
use App\Models\Games\Game;
use App\Repositories\Admin\Games\GameRepository;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

final class GamesController extends AdminController
{
    protected GameRepository $gameRepository;

    public function __construct()
    {
        parent::__construct();
        $this->gameRepository = app(GameRepository::class);
    }

    public function index(): View
    {
        $games = $this->gameRepository->getForShow();

        $breadcrumbs = [['h1' => 'Игры']];

        return view('admin.games.index', compact('games', 'breadcrumbs'));
    }

    public function create(): View
    {
        $categories = GameCategory::where('status', 1)->orderBy('order')->orderBy('name')->get();
        $breadcrumbs = [
            ['h1' => 'Игры', 'link' => route('admin.games.index')],
            ['h1' => 'Создание'],
        ];
        return view('admin.games.create', compact('categories', 'breadcrumbs'));
    }

    public function store(GameRequest $request): RedirectResponse
    {
        $data = $request->all();

        $data = empty_str_to_null($data);

        $item = new Game($data);

        $result = $item->save();

        if ($result) {
            return redirect()
                ->route('admin.games.index')
                ->with('flash_success', 'Игра создана!');
        }

        return redirect()
            ->route('admin.games.index')
            ->with('flash_errors', 'Ошибка создания!');
    }

    public function edit(string $id): View
    {
        $item = $this->gameRepository->findOrFail($id);
        $categories = GameCategory::where('status', 1)->orderBy('order')->orderBy('name')->get();
        $breadcrumbs = [
            ['h1' => 'Игры', 'link' => route('admin.games.index')],
            ['h1' => 'Редактирование'],
        ];

        return view('admin.games.edit', compact('item', 'categories', 'breadcrumbs'));
    }

    public function update(GameRequest $request, string $id): RedirectResponse
    {
        $item = $this->gameRepository->findOrFail($id);

        $data = $request->all();

        $data = empty_str_to_null($data);

        $result = $item->update($data);

        if ($result) {
            return redirect()
                ->route('admin.games.index')
                ->with('flash_success', 'Игра обновлена!');
        }

        return redirect()
            ->route('admin.games.index')
            ->with('flash_errors', 'Ошибка обновления!');
    }

    public function destroy(string $id): RedirectResponse
    {
        $item = $this->gameRepository->findOrFail($id);

        $result = $item->delete();

        if ($result) {
            return redirect()
                ->route('admin.games.index')
                ->with('flash_success', 'Игра удалена!');
        }

        return redirect()
            ->route('admin.games.index')
            ->with('flash_errors', 'Ошибка удаления!');
    }
}

