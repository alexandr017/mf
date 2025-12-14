<?php

namespace App\Http\Controllers\Admin\News;

use App\Http\Controllers\Admin\AdminController;
use App\Http\Requests\Admin\News\NewsRequest;
use App\Models\News\News;
use App\Repositories\Admin\News\NewsRepository;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

final class NewsController extends AdminController
{
    protected NewsRepository $newsRepository;

    public function __construct()
    {
        parent::__construct();
        $this->newsRepository = app(NewsRepository::class);
    }

    public function index(): View
    {
        $news = $this->newsRepository->getForShow();

        $breadcrumbs = [['h1' => 'Новости']];

        return view('admin.news.index', compact('news', 'breadcrumbs'));
    }

    public function create(): View
    {
        $breadcrumbs = [
            ['h1' => 'Новости', 'link' => route('admin.news.index')],
            ['h1' => 'Создание'],
        ];
        return view('admin.news.create', compact('breadcrumbs'));
    }

    public function store(NewsRequest $request): RedirectResponse
    {
        $data = $request->all();

        $data = empty_str_to_null($data);

        $item = new News($data);

        $result = $item->save();

        if ($result) {
            return redirect()
                ->route('admin.news.index')
                ->with('flash_success', 'Новость создана!');
        }

        return redirect()
            ->route('admin.news.index')
            ->with('flash_errors', 'Ошибка создания!');
    }

    public function edit(string $id): View
    {
        $item = $this->newsRepository->findOrFail($id);
        $breadcrumbs = [
            ['h1' => 'Новости', 'link' => route('admin.news.index')],
            ['h1' => 'Редактирование'],
        ];

        return view('admin.news.edit', compact('item', 'breadcrumbs'));
    }

    public function update(NewsRequest $request, string $id): RedirectResponse
    {
        $item = $this->newsRepository->findOrFail($id);

        $data = $request->all();

        $data = empty_str_to_null($data);

        $result = $item->update($data);

        if ($result) {
            return redirect()
                ->route('admin.news.index')
                ->with('flash_success', 'Новость обновлена!');
        }

        return redirect()
            ->route('admin.news.index')
            ->with('flash_errors', 'Ошибка обновления!');
    }

    public function destroy(string $id): RedirectResponse
    {
        $item = $this->newsRepository->findOrFail($id);

        $result = $item->delete();

        if ($result) {
            return redirect()
                ->route('admin.news.index')
                ->with('flash_success', 'Новость удалена!');
        }

        return redirect()
            ->route('admin.news.index')
            ->with('flash_errors', 'Ошибка удаления!');
    }
}


