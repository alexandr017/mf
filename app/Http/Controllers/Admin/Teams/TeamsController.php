<?php

namespace App\Http\Controllers\Admin\Teams;

use App\Http\Controllers\Admin\AdminController;
use App\Http\Requests\Admin\Teams\TeamRequest;
use App\Models\Teams\Team;
use App\Repositories\Admin\Teams\TeamRepository;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

final class TeamsController extends AdminController
{
    protected TeamRepository $teamRepository;

    public function __construct()
    {
        parent::__construct();
        $this->teamRepository = app(TeamRepository::class);
    }

    public function index(): View
    {
        $teams = $this->teamRepository->getForShow();

        return view('admin.teams.index', compact('teams'));
    }

    public function create(): View
    {
        return view('admin.teams.create');
    }

    public function store(TeamRequest $request): RedirectResponse
    {
        $data = $request->all();

        $data = empty_str_to_null($data);

        $item = new Team($data);

        $result = $item->save();

        if ($result) {
            return redirect()
                ->route('admin.teams.index')
                ->with('flash_success', 'Команда создана!');
        }

        return redirect()
            ->route('admin.teams.index')
            ->with('flash_errors', 'Ошибка создания!');
    }

    public function edit(string $id): View
    {
        $item = $this->teamRepository->findOrFail($id);

        return view('admin.teams.edit', compact('item'));
    }

    public function update(TeamRequest $request, string $id): RedirectResponse
    {
        $item = $this->teamRepository->findOrFail($id);

        $data = $request->all();

        $data = empty_str_to_null($data);

        $result = $item->update($data);

        if ($result) {
            return redirect()
                ->route('admin.teams.index')
                ->with('flash_success', 'Команда обновлена!');
        }

        return redirect()
            ->route('admin.teams.index')
            ->with('flash_errors', 'Ошибка обновления!');
    }

    public function destroy(string $id): RedirectResponse
    {
        $item = $this->teamRepository->findOrFail($id);

        $result = $item->delete();

        if ($result) {
            return redirect()
                ->route('admin.teams.index')
                ->with('flash_success', 'Команда удалена!');
        }

        return redirect()
            ->route('admin.teams.index')
            ->with('flash_errors', 'Ошибка удаления!');
    }
}

