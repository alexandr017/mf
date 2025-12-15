<?php

namespace App\Http\Controllers\Admin\Tournaments;

use App\Helpers\ActivityLogHelper;
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

        $breadcrumbs = [['h1' => 'Турниры']];

        return view('admin.tournaments.index', compact('tournaments', 'breadcrumbs'));
    }

    public function create(): View
    {
        $breadcrumbs = [
            ['h1' => 'Турниры', 'link' => route('admin.tournaments.index')],
            ['h1' => 'Создание'],
        ];
        return view('admin.tournaments.create', compact('breadcrumbs'));
    }

    public function store(TournamentRequest $request): RedirectResponse
    {
        $data = $request->all();

        $data = empty_str_to_null($data);

        $item = new Tournament($data);

        $result = $item->save();

        if ($result) {
            ActivityLogHelper::logCreate($item);
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
        $breadcrumbs = [
            ['h1' => 'Турниры', 'link' => route('admin.tournaments.index')],
            ['h1' => 'Редактирование'],
        ];

        return view('admin.tournaments.edit', compact('item', 'breadcrumbs'));
    }

    public function update(TournamentRequest $request, string $id): RedirectResponse
    {
        $item = $this->tournamentRepository->findOrFail($id);

        $data = $request->all();

        $data = empty_str_to_null($data);

        $oldData = $item->getOriginal();
        $result = $item->update($data);

        if ($result) {
            $changes = array_diff_assoc($item->getAttributes(), $oldData);
            ActivityLogHelper::logUpdate($item, $changes);
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
            ActivityLogHelper::logDelete($item);
            return redirect()
                ->route('admin.tournaments.index')
                ->with('flash_success', 'Турнир удален!');
        }

        return redirect()
            ->route('admin.tournaments.index')
            ->with('flash_errors', 'Ошибка удаления!');
    }
}


