<?php

namespace App\Http\Controllers\Admin\Tournaments;

use App\Http\Controllers\Admin\AdminController;
use App\Http\Requests\Admin\Tournaments\TournamentRequest;
use App\Models\Tournaments\Tournament;
use App\Repositories\Admin\Tournaments\TournamentRepository;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

final class TournamentsController extends AdminController
{
    protected TournamentRepository $tournamentRepository;

    public function __construct()
    {
        parent::__construct();
        $this->tournamentRepository = app(TournamentRepository::class);
    }

    public function index(): View
    {
        $tournaments = $this->tournamentRepository->getForShow();

        return view('admin.tournaments.index', compact('tournaments'));
    }

    public function create(): View
    {
        return view('admin.tournaments.create');
    }

    public function store(TournamentRequest $request): RedirectResponse
    {
        $data = $request->all();

        $data = empty_str_to_null($data);

        $item = new Tournament($data);

        $result = $item->save();

        if ($result) {
            return redirect()
                ->route('admin.tournaments.index')
                ->with('flash_success', 'Турнир создан!');
        }

        return redirect()
            ->route('admin.tournaments.index')
            ->with('flash_errors', 'Ошибка создания!');
    }

    public function edit(string $id): View
    {
        $item = $this->tournamentRepository->findOrFail($id);

        return view('admin.tournaments.edit', compact('item'));
    }

    public function update(TournamentRequest $request, string $id): RedirectResponse
    {
        $item = $this->tournamentRepository->findOrFail($id);

        $data = $request->all();

        $data = empty_str_to_null($data);

        $result = $item->update($data);

        if ($result) {
            return redirect()
                ->route('admin.tournaments.index')
                ->with('flash_success', 'Турнир обновлен!');
        }

        return redirect()
            ->route('admin.tournaments.index')
            ->with('flash_errors', 'Ошибка обновления!');
    }

    public function destroy(string $id): RedirectResponse
    {
        $item = $this->tournamentRepository->findOrFail($id);

        $result = $item->delete();

        if ($result) {
            return redirect()
                ->route('admin.tournaments.index')
                ->with('flash_success', 'Турнир удален!');
        }

        return redirect()
            ->route('admin.tournaments.index')
            ->with('flash_errors', 'Ошибка удаления!');
    }
}

