<?php

namespace App\Http\Controllers\Admin\Teams;

use App\Http\Controllers\Admin\AdminController;
use App\Http\Requests\Admin\Teams\TeamRequest;
use App\Models\Cities\City;
use App\Models\Countries\Country;
use App\Models\Teams\Team;
use App\Repositories\Admin\Teams\TeamRepository;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

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

        $breadcrumbs = [['h1' => 'Команды']];

        return view('admin.teams.index', compact('teams', 'breadcrumbs'));
    }

    public function create(): View
    {
        $countries = Country::orderBy('name')->get();
        $cities = collect(); // Пустая коллекция для создания
        $breadcrumbs = [
            ['h1' => 'Команды', 'link' => route('admin.teams.index')],
            ['h1' => 'Создание'],
        ];
        return view('admin.teams.create', compact('countries', 'cities', 'breadcrumbs'));
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
        $countries = Country::orderBy('name')->get();
        $cities = $item->country_id ? City::where('country_id', $item->country_id)->orderBy('name')->get() : collect();
        $breadcrumbs = [
            ['h1' => 'Команды', 'link' => route('admin.teams.index')],
            ['h1' => 'Редактирование'],
        ];

        return view('admin.teams.edit', compact('item', 'countries', 'cities', 'breadcrumbs'));
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

    /**
     * Получить города по стране (AJAX)
     */
    public function getCitiesByCountry(Request $request): JsonResponse
    {
        $countryId = $request->get('country_id');
        
        if (!$countryId) {
            return response()->json([]);
        }

        $cities = City::where('country_id', $countryId)
            ->orderBy('name')
            ->get(['id', 'name']);

        return response()->json($cities);
    }
}


