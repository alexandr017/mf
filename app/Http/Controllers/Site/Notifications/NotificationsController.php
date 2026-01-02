<?php

namespace App\Http\Controllers\Site\Notifications;

use App\Models\Notifications\UserNotification;
use App\Services\NotificationService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationsController
{
    protected NotificationService $notificationService;

    public function __construct(NotificationService $notificationService)
    {
        $this->notificationService = $notificationService;
    }

    /**
     * Получить список уведомлений пользователя (AJAX)
     */
    public function index(Request $request): JsonResponse
    {
        $user = Auth::user();
        
        $notifications = $user->notifications()
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get()
            ->map(function ($notification) {
                return [
                    'id' => $notification->id,
                    'type' => $notification->type,
                    'title' => $notification->title,
                    'message' => $notification->message,
                    'is_read' => $notification->is_read,
                    'created_at' => $notification->created_at->format('d.m.Y H:i'),
                    'created_at_human' => $notification->created_at->diffForHumans(),
                ];
            });

        return response()->json([
            'notifications' => $notifications,
            'unread_count' => $this->notificationService->getUnreadCount($user),
        ]);
    }

    /**
     * Получить количество непрочитанных уведомлений (AJAX)
     */
    public function unreadCount(): JsonResponse
    {
        $user = Auth::user();
        $count = $this->notificationService->getUnreadCount($user);

        return response()->json(['count' => $count]);
    }

    /**
     * Отметить уведомление как прочитанное (AJAX)
     */
    public function markAsRead(string $id): JsonResponse
    {
        $user = Auth::user();
        
        $notification = UserNotification::where('id', $id)
            ->where('user_id', $user->id)
            ->firstOrFail();

        $this->notificationService->markAsRead($notification);

        return response()->json([
            'success' => true,
            'unread_count' => $this->notificationService->getUnreadCount($user),
        ]);
    }

    /**
     * Отметить все уведомления как прочитанные (AJAX)
     */
    public function markAllAsRead(): JsonResponse
    {
        $user = Auth::user();
        
        UserNotification::where('user_id', $user->id)
            ->where('is_read', false)
            ->update([
                'is_read' => true,
                'read_at' => now(),
            ]);

        return response()->json([
            'success' => true,
            'unread_count' => 0,
        ]);
    }
}

