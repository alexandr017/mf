<?php

namespace App\Http\Controllers\Admin\StaticPages;

use App\Http\Controllers\Admin\AdminController;
use App\Http\Requests\Admin\StaticPages\StaticPageRequest;
use App\Models\StaticPages\StaticPage;
use App\Repositories\Admin\StaticPages\StaticPageRepository;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

final class StaticPagesController extends AdminController
{
    private const min_average_rating = 4.0;
    private const max_average_rating = 5.0;

    private const min_number_of_votes = 15;
    private const max_number_of_votes = 25;

    protected StaticPageRepository $staticPageRepository;


    public function __construct()
    {
        parent::__construct();
        $this->staticPageRepository = app(StaticPageRepository::class);
    }

    public function index() : View
    {
        $staticPages = $this->staticPageRepository->getForShow();

        $breadcrumbs = [['h1' => 'Статические страницы']];

        return view('admin.static-pages.index', compact('staticPages', 'breadcrumbs'));
    }

    public function create() :View
    {
        $breadcrumbs = [
            ['h1' => 'Статические страницы', 'link' => route('admin.static-pages.index')],
            ['h1' => 'Создание'],
        ];

        return view('admin.static-pages.create', compact('breadcrumbs'));
    }

    public function store(StaticPageRequest $request) : RedirectResponse
    {
        $data = $request->all();

        $data['average_rating'] = (self::min_average_rating + (self::max_average_rating - self::min_average_rating) * (mt_rand() / mt_getrandmax()));
        $data['number_of_votes'] = rand(self::min_number_of_votes, self::max_number_of_votes);

        $data = empty_str_to_null($data);

        $item = new StaticPage($data);

        $result = $item->save();

//        adminLog('Static page', $item->id, 'create');

        if ($result) {
            return redirect()
                ->route('admin.static-pages.index')
                ->with('flash_success', 'Листинг создан!');
        }

        return redirect()
            ->route('admin.static-pages.index')
            ->with('flash_errors', 'Ошибка создания!');
    }

    public function edit(string $id) : View
    {
        $item = $this->staticPageRepository->findOrFail($id);

        $breadcrumbs = [
            ['h1' => 'Статические страницы', 'link' => route('admin.static-pages.index')],
            ['h1' => 'Редактирование'],
        ];

        return view('admin.static-pages.edit', compact('item', 'breadcrumbs'));
    }

    public function update(StaticPageRequest $request, string $id) : RedirectResponse
    {
        $item = $this->staticPageRepository->findOrFail($id);

        $data = $request->all();

        $data = empty_str_to_null($data);

        $result = $item->update($data);

//        adminLog('Static page', $item->id, 'update');

        if ($result) {
            return redirect()
                ->route('admin.static-pages.index')
                ->with('flash_success', 'Листинг создан!');
        }

        return redirect()
            ->route('admin.static-pages.index')
            ->with('flash_errors', 'Ошибка создания!');
    }

    public function destroy(string $id) : RedirectResponse
    {
        $item = $this->staticPageRepository->findOrFail($id);

        $result = $item->delete();

//        adminLog('Static page', $id, 'delete');

        if ($result) {
            return redirect()
                ->route('admin.static-pages.index')
                ->with('flash_success', 'Листинг удален!');
        }

        return redirect()
            ->route('admin.static-pages.index')
            ->with('flash_errors', 'Ошибка удаления!');
    }
}
