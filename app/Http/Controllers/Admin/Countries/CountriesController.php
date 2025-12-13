<?php

namespace App\Http\Controllers\Admin\Countries;

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

        return view('admin.countries.index', compact('countries'));
    }

    public function create(): View
    {
        return view('admin.countries.create');
    }

    public function store(CountryRequest $request): RedirectResponse
    {
        $data = $request->all();

        $data = empty_str_to_null($data);

        $item = new Country($data);

        $result = $item->save();

        if ($result) {
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

        return view('admin.countries.edit', compact('item'));
    }

    public function update(CountryRequest $request, string $id): RedirectResponse
    {
        $item = $this->countryRepository->findOrFail($id);

        $data = $request->all();

        $data = empty_str_to_null($data);

        $result = $item->update($data);

        if ($result) {
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
            return redirect()
                ->route('admin.countries.index')
                ->with('flash_success', 'Страна удалена!');
        }

        return redirect()
            ->route('admin.countries.index')
            ->with('flash_errors', 'Ошибка удаления!');
    }
}

