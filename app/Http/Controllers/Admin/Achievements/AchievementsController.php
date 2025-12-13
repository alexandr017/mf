<?php

namespace App\Http\Controllers\Admin\Achievements;

use App\Http\Controllers\Admin\AdminController;
use App\Http\Requests\Admin\Achievements\AchievementRequest;
use App\Models\Achievements\Achievement;
use App\Models\User;
use App\Repositories\Admin\Achievements\AchievementRepository;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

final class AchievementsController extends AdminController
{
    protected AchievementRepository $achievementRepository;

    public function __construct()
    {
        parent::__construct();
        $this->achievementRepository = app(AchievementRepository::class);
    }

    public function index(): View
    {
        $achievements = $this->achievementRepository->getForShow();

        return view('admin.achievements.index', compact('achievements'));
    }

    public function create(): View
    {
        return view('admin.achievements.create');
    }

    public function store(AchievementRequest $request): RedirectResponse
    {
        $data = $request->all();

        $data = empty_str_to_null($data);

        $item = new Achievement($data);

        $result = $item->save();

        if ($result) {
            return redirect()
                ->route('admin.achievements.index')
                ->with('flash_success', 'Достижение создано!');
        }

        return redirect()
            ->route('admin.achievements.index')
            ->with('flash_errors', 'Ошибка создания!');
    }

    public function edit(string $id): View
    {
        $item = $this->achievementRepository->findOrFail($id);

        return view('admin.achievements.edit', compact('item'));
    }

    public function update(AchievementRequest $request, string $id): RedirectResponse
    {
        $item = $this->achievementRepository->findOrFail($id);

        $data = $request->all();

        $data = empty_str_to_null($data);

        $result = $item->update($data);

        if ($result) {
            return redirect()
                ->route('admin.achievements.index')
                ->with('flash_success', 'Достижение обновлено!');
        }

        return redirect()
            ->route('admin.achievements.index')
            ->with('flash_errors', 'Ошибка обновления!');
    }

    public function destroy(string $id): RedirectResponse
    {
        $item = $this->achievementRepository->findOrFail($id);

        $result = $item->delete();

        if ($result) {
            return redirect()
                ->route('admin.achievements.index')
                ->with('flash_success', 'Достижение удалено!');
        }

        return redirect()
            ->route('admin.achievements.index')
            ->with('flash_errors', 'Ошибка удаления!');
    }

    public function assignUsers(string $id): View
    {
        $achievement = $this->achievementRepository->findOrFail($id);
        $users = User::orderBy('name')->get();
        $assignedUserIds = $achievement->users->pluck('id')->toArray();

        return view('admin.achievements.assign-users', compact('achievement', 'users', 'assignedUserIds'));
    }

    public function updateAssignedUsers(Request $request, string $id): RedirectResponse
    {
        $achievement = $this->achievementRepository->findOrFail($id);
        $userIds = $request->get('user_ids', []);

        // Синхронизируем достижения пользователей
        $syncData = [];
        foreach ($userIds as $userId) {
            $syncData[$userId] = ['earned_at' => now()];
        }

        $achievement->users()->sync($syncData);

        return redirect()
            ->route('admin.achievements.index')
            ->with('flash_success', 'Достижения назначены пользователям!');
    }
}

