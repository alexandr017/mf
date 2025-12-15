<?php

namespace App\Http\Controllers\Admin\FAQ;

use App\Helpers\ActivityLogHelper;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Requests\Admin\FAQ\FAQRequest;
use App\Models\FAQ\FAQ;
use App\Repositories\Admin\FAQ\FAQRepository;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

final class FAQController extends AdminController
{
    protected FAQRepository $faqRepository;

    public function __construct()
    {
        parent::__construct();
        $this->faqRepository = app(FAQRepository::class);
    }

    public function index(): View
    {
        $faqs = $this->faqRepository->getForShow();

        $breadcrumbs = [['h1' => 'Вопросы-Ответы']];

        return view('admin.faq.index', compact('faqs', 'breadcrumbs'));
    }

    public function create(): View
    {
        $breadcrumbs = [
            ['h1' => 'Вопросы-Ответы', 'link' => route('admin.faq.index')],
            ['h1' => 'Создание'],
        ];
        return view('admin.faq.create', compact('breadcrumbs'));
    }

    public function store(FAQRequest $request): RedirectResponse
    {
        $data = $request->all();

        $data = empty_str_to_null($data);

        $item = new FAQ($data);

        $result = $item->save();

        if ($result) {
            ActivityLogHelper::logCreate($item);
            return redirect()
                ->route('admin.faq.index')
                ->with('flash_success', 'Вопрос-ответ создан!');
        }

        return redirect()
            ->route('admin.faq.index')
            ->with('flash_errors', 'Ошибка создания!');
    }

    public function edit(string $id): View
    {
        $item = $this->faqRepository->findOrFail($id);
        $breadcrumbs = [
            ['h1' => 'Вопросы-Ответы', 'link' => route('admin.faq.index')],
            ['h1' => 'Редактирование'],
        ];

        return view('admin.faq.edit', compact('item', 'breadcrumbs'));
    }

    public function update(FAQRequest $request, string $id): RedirectResponse
    {
        $item = $this->faqRepository->findOrFail($id);

        $data = $request->all();

        $data = empty_str_to_null($data);

        $oldData = $item->getOriginal();
        $result = $item->update($data);

        if ($result) {
            $changes = array_diff_assoc($item->getAttributes(), $oldData);
            ActivityLogHelper::logUpdate($item, $changes);
            return redirect()
                ->route('admin.faq.index')
                ->with('flash_success', 'Вопрос-ответ обновлен!');
        }

        return redirect()
            ->route('admin.faq.index')
            ->with('flash_errors', 'Ошибка обновления!');
    }

    public function destroy(string $id): RedirectResponse
    {
        $item = $this->faqRepository->findOrFail($id);

        $result = $item->delete();

        if ($result) {
            ActivityLogHelper::logDelete($item);
            return redirect()
                ->route('admin.faq.index')
                ->with('flash_success', 'Вопрос-ответ удален!');
        }

        return redirect()
            ->route('admin.faq.index')
            ->with('flash_errors', 'Ошибка удаления!');
    }
}


