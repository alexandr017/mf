<?php

namespace App\Http\Controllers\Admin\FAQ;

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

        return view('admin.faq.index', compact('faqs'));
    }

    public function create(): View
    {
        return view('admin.faq.create');
    }

    public function store(FAQRequest $request): RedirectResponse
    {
        $data = $request->all();

        $data = empty_str_to_null($data);

        $item = new FAQ($data);

        $result = $item->save();

        if ($result) {
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

        return view('admin.faq.edit', compact('item'));
    }

    public function update(FAQRequest $request, string $id): RedirectResponse
    {
        $item = $this->faqRepository->findOrFail($id);

        $data = $request->all();

        $data = empty_str_to_null($data);

        $result = $item->update($data);

        if ($result) {
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
            return redirect()
                ->route('admin.faq.index')
                ->with('flash_success', 'Вопрос-ответ удален!');
        }

        return redirect()
            ->route('admin.faq.index')
            ->with('flash_errors', 'Ошибка удаления!');
    }
}

