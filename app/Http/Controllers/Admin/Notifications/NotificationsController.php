<?php

namespace App\Http\Controllers\Admin\Notifications;

use App\Helpers\ActivityLogHelper;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Requests\Admin\Notifications\NotificationRequest;
use App\Models\Notifications\Notification;
use App\Services\NotificationService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

final class NotificationsController extends AdminController
{
    protected NotificationService $notificationService;

    public function __construct(NotificationService $notificationService)
    {
        parent::__construct();
        $this->notificationService = $notificationService;
    }

    public function index(): View
    {
        $notifications = Notification::where('is_mass', true)
            ->with('createdBy')
            ->orderBy('created_at', 'desc')
            ->get();

        $breadcrumbs = [['h1' => 'Массовые уведомления']];

        return view('admin.notifications.index', compact('notifications', 'breadcrumbs'));
    }

    public function create(): View
    {
        $breadcrumbs = [
            ['h1' => 'Массовые уведомления', 'link' => route('admin.notifications.index')],
            ['h1' => 'Создание'],
        ];
        return view('admin.notifications.create', compact('breadcrumbs'));
    }

    public function store(NotificationRequest $request): RedirectResponse
    {
        $data = $request->all();
        $data = empty_str_to_null($data);

        $scheduledAt = null;
        if ($request->filled('scheduled_at')) {
            $scheduledAt = \Carbon\Carbon::parse($request->input('scheduled_at'));
        }

        $notification = $this->notificationService->sendMassNotification(
            $request->input('title'),
            $request->input('message'),
            [],
            auth()->user(),
            $scheduledAt
        );

        if ($notification) {
            ActivityLogHelper::logCreate($notification);
            return redirect()
                ->route('admin.notifications.index')
                ->with('flash_success', 'Массовое уведомление создано!');
        }

        return redirect()
            ->route('admin.notifications.index')
            ->with('flash_errors', 'Ошибка создания!');
    }

    public function show(string $id): View
    {
        $notification = Notification::findOrFail($id);
        $breadcrumbs = [
            ['h1' => 'Массовые уведомления', 'link' => route('admin.notifications.index')],
            ['h1' => 'Просмотр'],
        ];

        $sentCount = $notification->userNotifications()->count();

        return view('admin.notifications.show', compact('notification', 'breadcrumbs', 'sentCount'));
    }

    public function edit(string $id): View
    {
        $notification = Notification::findOrFail($id);
        $breadcrumbs = [
            ['h1' => 'Массовые уведомления', 'link' => route('admin.notifications.index')],
            ['h1' => 'Редактирование'],
        ];

        return view('admin.notifications.edit', compact('notification', 'breadcrumbs'));
    }

    public function update(NotificationRequest $request, string $id): RedirectResponse
    {
        $notification = Notification::findOrFail($id);
        $data = $request->all();
        $data = empty_str_to_null($data);

        // Нельзя редактировать уже отправленные уведомления
        if ($notification->userNotifications()->exists()) {
            return redirect()
                ->route('admin.notifications.index')
                ->with('flash_errors', 'Нельзя редактировать уже отправленное уведомление!');
        }

        if ($request->filled('scheduled_at')) {
            $data['scheduled_at'] = \Carbon\Carbon::parse($request->input('scheduled_at'));
        } else {
            $data['scheduled_at'] = null;
        }

        $oldData = $notification->getOriginal();
        $result = $notification->update($data);

        if ($result) {
            $changes = array_diff_assoc($notification->getAttributes(), $oldData);
            ActivityLogHelper::logUpdate($notification, $changes);

            // Если изменили scheduled_at и оно наступило, обрабатываем сразу
            if (isset($data['scheduled_at']) && $data['scheduled_at'] <= now() && !$notification->userNotifications()->exists()) {
                $this->notificationService->processMassNotification($notification);
            }

            return redirect()
                ->route('admin.notifications.index')
                ->with('flash_success', 'Уведомление обновлено!');
        }

        return redirect()
            ->route('admin.notifications.index')
            ->with('flash_errors', 'Ошибка обновления!');
    }

    public function destroy(string $id): RedirectResponse
    {
        $notification = Notification::findOrFail($id);

        // Нельзя удалять уже отправленные уведомления
        if ($notification->userNotifications()->exists()) {
            return redirect()
                ->route('admin.notifications.index')
                ->with('flash_errors', 'Нельзя удалить уже отправленное уведомление!');
        }

        $result = $notification->delete();

        if ($result) {
            ActivityLogHelper::logDelete($notification);
            return redirect()
                ->route('admin.notifications.index')
                ->with('flash_success', 'Уведомление удалено!');
        }

        return redirect()
            ->route('admin.notifications.index')
            ->with('flash_errors', 'Ошибка удаления!');
    }
}

