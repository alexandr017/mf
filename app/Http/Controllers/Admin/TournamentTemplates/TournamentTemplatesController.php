<?php

namespace App\Http\Controllers\Admin\TournamentTemplates;

use App\Http\Controllers\Admin\AdminController;
use App\Http\Requests\Admin\TournamentTemplates\TournamentTemplateRequest;
use App\Models\Tournaments\TournamentTemplate;
use App\Repositories\Admin\TournamentTemplates\TournamentTemplateRepository;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

final class TournamentTemplatesController extends AdminController
{
    protected TournamentTemplateRepository $templateRepository;

    public function __construct()
    {
        parent::__construct();
        $this->templateRepository = app(TournamentTemplateRepository::class);
    }

    public function index(): View
    {
        $templates = $this->templateRepository->getForShow();

        return view('admin.tournament-templates.index', compact('templates'));
    }

    public function create(): View
    {
        return view('admin.tournament-templates.create');
    }

    public function store(TournamentTemplateRequest $request): RedirectResponse
    {
        $data = $request->all();

        $data = empty_str_to_null($data);

        // Преобразуем JSON строки в массивы
        if (isset($data['structure_json'])) {
            if (is_string($data['structure_json'])) {
                $decoded = json_decode($data['structure_json'], true);
                if (json_last_error() === JSON_ERROR_NONE) {
                    $data['structure_json'] = $decoded;
                }
            }
        }
        if (isset($data['config_json'])) {
            if (is_string($data['config_json'])) {
                $decoded = json_decode($data['config_json'], true);
                if (json_last_error() === JSON_ERROR_NONE) {
                    $data['config_json'] = $decoded;
                }
            }
        }

        $item = new TournamentTemplate($data);

        $result = $item->save();

        if ($result) {
            return redirect()
                ->route('admin.tournament-templates.index')
                ->with('flash_success', 'Шаблон создан!');
        }

        return redirect()
            ->route('admin.tournament-templates.index')
            ->with('flash_errors', 'Ошибка создания!');
    }

    public function edit(string $id): View
    {
        $item = $this->templateRepository->findOrFail($id);

        return view('admin.tournament-templates.edit', compact('item'));
    }

    public function update(TournamentTemplateRequest $request, string $id): RedirectResponse
    {
        $item = $this->templateRepository->findOrFail($id);

        $data = $request->all();

        $data = empty_str_to_null($data);

        // Преобразуем JSON строки в массивы
        if (isset($data['structure_json'])) {
            if (is_string($data['structure_json'])) {
                $data['structure_json'] = json_decode($data['structure_json'], true);
            }
            // Если уже массив, оставляем как есть
        }
        if (isset($data['config_json'])) {
            if (is_string($data['config_json'])) {
                $data['config_json'] = json_decode($data['config_json'], true);
            }
            // Если уже массив, оставляем как есть
        }

        $result = $item->update($data);

        if ($result) {
            return redirect()
                ->route('admin.tournament-templates.index')
                ->with('flash_success', 'Шаблон обновлен!');
        }

        return redirect()
            ->route('admin.tournament-templates.index')
            ->with('flash_errors', 'Ошибка обновления!');
    }

    public function destroy(string $id): RedirectResponse
    {
        $item = $this->templateRepository->findOrFail($id);

        $result = $item->delete();

        if ($result) {
            return redirect()
                ->route('admin.tournament-templates.index')
                ->with('flash_success', 'Шаблон удален!');
        }

        return redirect()
            ->route('admin.tournament-templates.index')
            ->with('flash_errors', 'Ошибка удаления!');
    }
}

