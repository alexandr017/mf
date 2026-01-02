<?php

namespace App\Http\Controllers\Admin\FriendlyMatches;

use App\Helpers\ActivityLogHelper;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Requests\Admin\FriendlyMatches\FriendlyMatchRequest;
use App\Models\FriendlyMatches\FriendlyMatch;
use App\Repositories\Admin\FriendlyMatches\FriendlyMatchRepository;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

final class FriendlyMatchesController extends AdminController
{
    protected FriendlyMatchRepository $friendlyMatchRepository;

    public function __construct()
    {
        parent::__construct();
        $this->friendlyMatchRepository = app(FriendlyMatchRepository::class);
    }

    public function index(): View
    {
        $matches = $this->friendlyMatchRepository->getForShow();

        $breadcrumbs = [['h1' => 'Товарищеские матчи']];

        return view('admin.friendly-matches.index', compact('matches', 'breadcrumbs'));
    }

    public function create(): View
    {
        $breadcrumbs = [
            ['h1' => 'Товарищеские матчи', 'link' => route('admin.friendly-matches.index')],
            ['h1' => 'Создание'],
        ];
        return view('admin.friendly-matches.create', compact('breadcrumbs'));
    }

    public function store(FriendlyMatchRequest $request): RedirectResponse
    {
        $data = $request->all();

        $data = empty_str_to_null($data);

        $item = new FriendlyMatch($data);

        $result = $item->save();

        if ($result) {
            ActivityLogHelper::logCreate($item);
            return redirect()
                ->route('admin.friendly-matches.index')
                ->with('flash_success', 'Товарищеский матч создан!');
        }

        return redirect()
            ->route('admin.friendly-matches.index')
            ->with('flash_errors', 'Ошибка создания!');
    }

    public function show(string $id): View
    {
        $item = $this->friendlyMatchRepository->findOrFail($id);
        $breadcrumbs = [
            ['h1' => 'Товарищеские матчи', 'link' => route('admin.friendly-matches.index')],
            ['h1' => 'Просмотр матча'],
        ];

        // Загружаем данные о голах и ассистах
        $scorers = [];
        $assists = [];
        
        if ($item->scorers) {
            foreach ($item->scorers as $scorer) {
                $user = \App\Models\User::find($scorer['user_id'] ?? null);
                if ($user) {
                    $scorers[] = [
                        'user' => $user,
                        'goals' => $scorer['goals'] ?? [],
                    ];
                }
            }
        }
        
        if ($item->assists) {
            foreach ($item->assists as $assist) {
                $user = \App\Models\User::find($assist['user_id'] ?? null);
                if ($user) {
                    $assists[] = [
                        'user' => $user,
                        'assists' => $assist['assists'] ?? [],
                    ];
                }
            }
        }

        return view('admin.friendly-matches.show', compact('item', 'breadcrumbs', 'scorers', 'assists'));
    }

    public function edit(string $id): View
    {
        $item = $this->friendlyMatchRepository->findOrFail($id);
        $breadcrumbs = [
            ['h1' => 'Товарищеские матчи', 'link' => route('admin.friendly-matches.index')],
            ['h1' => 'Редактирование'],
        ];

        return view('admin.friendly-matches.edit', compact('item', 'breadcrumbs'));
    }

    public function update(FriendlyMatchRequest $request, string $id): RedirectResponse
    {
        $item = $this->friendlyMatchRepository->findOrFail($id);

        $data = $request->all();

        $data = empty_str_to_null($data);

        $oldData = $item->getOriginal();
        $result = $item->update($data);

        if ($result) {
            $changes = array_diff_assoc($item->getAttributes(), $oldData);
            ActivityLogHelper::logUpdate($item, $changes);
            return redirect()
                ->route('admin.friendly-matches.index')
                ->with('flash_success', 'Товарищеский матч обновлен!');
        }

        return redirect()
            ->route('admin.friendly-matches.index')
            ->with('flash_errors', 'Ошибка обновления!');
    }

    public function destroy(string $id): RedirectResponse
    {
        $item = $this->friendlyMatchRepository->findOrFail($id);

        $result = $item->delete();

        if ($result) {
            ActivityLogHelper::logDelete($item);
            return redirect()
                ->route('admin.friendly-matches.index')
                ->with('flash_success', 'Товарищеский матч удален!');
        }

        return redirect()
            ->route('admin.friendly-matches.index')
            ->with('flash_errors', 'Ошибка удаления!');
    }
}

