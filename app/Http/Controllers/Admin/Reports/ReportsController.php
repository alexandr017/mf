<?php

namespace App\Http\Controllers\Admin\Reports;

use App\Helpers\ActivityLogHelper;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Requests\Admin\Reports\ReportRequest;
use App\Models\Reports\ReportCategory;
use App\Models\Reports\UserReport;
use App\Repositories\Admin\Reports\ReportRepository;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

final class ReportsController extends AdminController
{
    protected ReportRepository $reportRepository;

    public function __construct()
    {
        parent::__construct();
        $this->reportRepository = app(ReportRepository::class);
    }

    public function index(): View
    {
        $reports = $this->reportRepository->getForShow(50);
        $breadcrumbs = [['h1' => 'Жалобы на пользователей']];
        return view('admin.reports.index', compact('reports', 'breadcrumbs'));
    }

    public function create(): View
    {
        $breadcrumbs = [
            ['h1' => 'Жалобы на пользователей', 'link' => route('admin.reports.index')],
            ['h1' => 'Создание'],
        ];
        $categories = ReportCategory::getAll();
        return view('admin.reports.create', compact('categories', 'breadcrumbs'));
    }

    public function store(ReportRequest $request): RedirectResponse
    {
        $data = $request->all();
        $data = empty_str_to_null($data);

        $item = new UserReport($data);
        $result = $item->save();

        if ($result) {
            ActivityLogHelper::logCreate($item);
            return redirect()
                ->route('admin.reports.index')
                ->with('flash_success', 'Жалоба создана!');
        }

        return redirect()
            ->route('admin.reports.index')
            ->with('flash_errors', 'Ошибка создания!');
    }

    public function edit(string $id): View
    {
        $item = $this->reportRepository->findOrFail($id);
        $breadcrumbs = [
            ['h1' => 'Жалобы на пользователей', 'link' => route('admin.reports.index')],
            ['h1' => 'Редактирование'],
        ];
        $categories = ReportCategory::getAll();
        return view('admin.reports.edit', compact('item', 'categories', 'breadcrumbs'));
    }

    public function update(ReportRequest $request, string $id): RedirectResponse
    {
        $item = $this->reportRepository->findOrFail($id);

        $data = $request->all();
        $data = empty_str_to_null($data);

        // Если статус меняется с pending на другой, и еще не рассмотрено
        if (isset($data['status']) && $data['status'] !== 'pending' && !$item->reviewed_at) {
            $data['reviewed_by'] = auth()->id();
            $data['reviewed_at'] = now();
        }

        $oldData = $item->getOriginal();
        $result = $item->update($data);

        if ($result) {
            $changes = array_diff_assoc($item->getAttributes(), $oldData);
            ActivityLogHelper::logUpdate($item, $changes);
            return redirect()
                ->route('admin.reports.index')
                ->with('flash_success', 'Жалоба обновлена!');
        }

        return redirect()
            ->route('admin.reports.index')
            ->with('flash_errors', 'Ошибка обновления!');
    }

    public function destroy(string $id): RedirectResponse
    {
        $item = $this->reportRepository->findOrFail($id);

        $result = $item->delete();

        if ($result) {
            ActivityLogHelper::logDelete($item);
            return redirect()
                ->route('admin.reports.index')
                ->with('flash_success', 'Жалоба удалена!');
        }

        return redirect()
            ->route('admin.reports.index')
            ->with('flash_errors', 'Ошибка удаления!');
    }
}

