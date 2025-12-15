<?php

namespace App\Http\Controllers\Admin\Cities;

use App\Helpers\ActivityLogHelper;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Requests\Admin\Cities\CityRequest;
use App\Models\Cities\City;
use App\Models\Countries\Country;
use App\Repositories\Admin\Cities\CityRepository;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

final class CitiesController extends AdminController
{
    protected CityRepository $cityRepository;

    public function __construct()
    {
        parent::__construct();
        $this->cityRepository = app(CityRepository::class);
    }

    public function index(): View
    {
        $cities = $this->cityRepository->getForShow();

        $breadcrumbs = [['h1' => 'Города']];

        return view('admin.cities.index', compact('cities', 'breadcrumbs'));
    }

    public function create(): View
    {
        $countries = Country::orderBy('name')->get();
        $breadcrumbs = [
            ['h1' => 'Города', 'link' => route('admin.cities.index')],
            ['h1' => 'Создание'],
        ];
        return view('admin.cities.create', compact('countries', 'breadcrumbs'));
    }

    public function store(CityRequest $request): RedirectResponse
    {
        $data = $request->all();

        $data = empty_str_to_null($data);

        $item = new City($data);

        $result = $item->save();

        if ($result) {
            ActivityLogHelper::logCreate($item);
            return redirect()
                ->route('admin.cities.index')
                ->with('flash_success', 'Город создан!');
        }

        return redirect()
            ->route('admin.cities.index')
            ->with('flash_errors', 'Ошибка создания!');
    }

    public function edit(string $id): View
    {
        $item = $this->cityRepository->findOrFail($id);
        $countries = Country::orderBy('name')->get();
        $breadcrumbs = [
            ['h1' => 'Города', 'link' => route('admin.cities.index')],
            ['h1' => 'Редактирование'],
        ];

        return view('admin.cities.edit', compact('item', 'countries', 'breadcrumbs'));
    }

    public function update(CityRequest $request, string $id): RedirectResponse
    {
        $item = $this->cityRepository->findOrFail($id);

        $data = $request->all();

        $data = empty_str_to_null($data);

        $oldData = $item->getOriginal();
        $result = $item->update($data);

        if ($result) {
            $changes = array_diff_assoc($item->getAttributes(), $oldData);
            ActivityLogHelper::logUpdate($item, $changes);
            return redirect()
                ->route('admin.cities.index')
                ->with('flash_success', 'Город обновлен!');
        }

        return redirect()
            ->route('admin.cities.index')
            ->with('flash_errors', 'Ошибка обновления!');
    }

    public function destroy(string $id): RedirectResponse
    {
        $item = $this->cityRepository->findOrFail($id);

        $result = $item->delete();

        if ($result) {
            ActivityLogHelper::logDelete($item);
            return redirect()
                ->route('admin.cities.index')
                ->with('flash_success', 'Город удален!');
        }

        return redirect()
            ->route('admin.cities.index')
            ->with('flash_errors', 'Ошибка удаления!');
    }
}


