<?php

namespace App\Http\Controllers\Admin\Countries;

use App\Helpers\ActivityLogHelper;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Requests\Admin\Countries\CountryRequest;
use App\Models\Countries\Country;
use App\Repositories\Admin\Countries\CountryRepository;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

final class CountriesController extends AdminController
{
    protected CountryRepository $countryRepository;

    public function __construct()
    {
        parent::__construct();
        $this->countryRepository = app(CountryRepository::class);
    }

    public function index(): View
    {
        $countries = $this->countryRepository->getForShow();

        $breadcrumbs = [['h1' => 'Страны']];

        return view('admin.countries.index', compact('countries', 'breadcrumbs'));
    }

    public function create(): View
    {
        $breadcrumbs = [
            ['h1' => 'Страны', 'link' => route('admin.countries.index')],
            ['h1' => 'Создание'],
        ];
        return view('admin.countries.create', compact('breadcrumbs'));
    }

    public function store(CountryRequest $request): RedirectResponse
    {
        $data = $request->all();

        $data = empty_str_to_null($data);

        $item = new Country($data);

        $result = $item->save();

        if ($result) {
            ActivityLogHelper::logCreate($item);
            return redirect()
                ->route('admin.countries.index')
                ->with('flash_success', 'Страна создана!');
        }

        return redirect()
            ->route('admin.countries.index')
            ->with('flash_errors', 'Ошибка создания!');
    }

    public function edit(string $id): View
    {
        $item = $this->countryRepository->findOrFail($id);
        $breadcrumbs = [
            ['h1' => 'Страны', 'link' => route('admin.countries.index')],
            ['h1' => 'Редактирование'],
        ];

        return view('admin.countries.edit', compact('item', 'breadcrumbs'));
    }

    public function update(CountryRequest $request, string $id): RedirectResponse
    {
        $item = $this->countryRepository->findOrFail($id);

        $data = $request->all();

        $data = empty_str_to_null($data);

        $oldData = $item->getOriginal();
        $result = $item->update($data);

        if ($result) {
            $changes = array_diff_assoc($item->getAttributes(), $oldData);
            ActivityLogHelper::logUpdate($item, $changes);
            return redirect()
                ->route('admin.countries.index')
                ->with('flash_success', 'Страна обновлена!');
        }

        return redirect()
            ->route('admin.countries.index')
            ->with('flash_errors', 'Ошибка обновления!');
    }

    public function destroy(string $id): RedirectResponse
    {
        $item = $this->countryRepository->findOrFail($id);

        $result = $item->delete();

        if ($result) {
            ActivityLogHelper::logDelete($item);
            return redirect()
                ->route('admin.countries.index')
                ->with('flash_success', 'Страна удалена!');
        }

        return redirect()
            ->route('admin.countries.index')
            ->with('flash_errors', 'Ошибка удаления!');
    }
}


