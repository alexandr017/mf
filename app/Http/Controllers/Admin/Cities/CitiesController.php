<?php

namespace App\Http\Controllers\Admin\Cities;

use App\Http\Controllers\Admin\AdminController;
use App\Http\Requests\Admin\Cities\CityRequest;
use App\Models\Cities\City;
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

        return view('admin.cities.index', compact('cities'));
    }

    public function create(): View
    {
        return view('admin.cities.create');
    }

    public function store(CityRequest $request): RedirectResponse
    {
        $data = $request->all();

        $data = empty_str_to_null($data);

        $item = new City($data);

        $result = $item->save();

        if ($result) {
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

        return view('admin.cities.edit', compact('item'));
    }

    public function update(CityRequest $request, string $id): RedirectResponse
    {
        $item = $this->cityRepository->findOrFail($id);

        $data = $request->all();

        $data = empty_str_to_null($data);

        $result = $item->update($data);

        if ($result) {
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
            return redirect()
                ->route('admin.cities.index')
                ->with('flash_success', 'Город удален!');
        }

        return redirect()
            ->route('admin.cities.index')
            ->with('flash_errors', 'Ошибка удаления!');
    }
}

