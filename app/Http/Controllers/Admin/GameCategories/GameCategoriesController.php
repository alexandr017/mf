<?php

namespace App\Http\Controllers\Admin\GameCategories;

use App\Http\Controllers\Admin\AdminController;
use App\Http\Requests\Admin\GameCategories\GameCategoryRequest;
use App\Models\GameCategories\GameCategory;
use App\Repositories\Admin\GameCategories\GameCategoryRepository;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

final class GameCategoriesController extends AdminController
{
    protected GameCategoryRepository $categoryRepository;

    public function __construct()
    {
        parent::__construct();
        $this->categoryRepository = app(GameCategoryRepository::class);
    }

    public function index(): View
    {
        $categories = $this->categoryRepository->getForShow();
        $breadcrumbs = [['h1' => 'Категории игр']];
        return view('admin.game-categories.index', compact('categories', 'breadcrumbs'));
    }

    public function create(): View
    {
        $breadcrumbs = [
            ['h1' => 'Категории игр', 'link' => route('admin.game-categories.index')],
            ['h1' => 'Создание'],
        ];
        return view('admin.game-categories.create', compact('breadcrumbs'));
    }

    public function store(GameCategoryRequest $request): RedirectResponse
    {
        $data = $request->all();
        $data = empty_str_to_null($data);

        $item = new GameCategory($data);
        $result = $item->save();

        if ($result) {
            return redirect()
                ->route('admin.game-categories.index')
                ->with('flash_success', 'Категория создана!');
        }

        return redirect()
            ->route('admin.game-categories.index')
            ->with('flash_errors', 'Ошибка создания!');
    }

    public function edit(string $id): View
    {
        $item = $this->categoryRepository->findOrFail($id);
        $breadcrumbs = [
            ['h1' => 'Категории игр', 'link' => route('admin.game-categories.index')],
            ['h1' => 'Редактирование'],
        ];
        return view('admin.game-categories.edit', compact('item', 'breadcrumbs'));
    }

    public function update(GameCategoryRequest $request, string $id): RedirectResponse
    {
        $item = $this->categoryRepository->findOrFail($id);
        $data = $request->all();
        $data = empty_str_to_null($data);

        $result = $item->update($data);

        if ($result) {
            return redirect()
                ->route('admin.game-categories.index')
                ->with('flash_success', 'Категория обновлена!');
        }

        return redirect()
            ->route('admin.game-categories.index')
            ->with('flash_errors', 'Ошибка обновления!');
    }

    public function destroy(string $id): RedirectResponse
    {
        $item = $this->categoryRepository->findOrFail($id);
        $result = $item->delete();

        if ($result) {
            return redirect()
                ->route('admin.game-categories.index')
                ->with('flash_success', 'Категория удалена!');
        }

        return redirect()
            ->route('admin.game-categories.index')
            ->with('flash_errors', 'Ошибка удаления!');
    }
}



