<?php

namespace App\Console\Commands;

use App\Models\Notifications\Notification;
use App\Services\NotificationService;
use Illuminate\Console\Command;

class ProcessScheduledNotifications extends Command
{
    protected $signature = 'notifications:process-scheduled';
    protected $description = 'Process scheduled mass notifications';

    protected NotificationService $notificationService;

    public function __construct(NotificationService $notificationService)
    {
        parent::__construct();
        $this->notificationService = $notificationService;
    }

    public function handle(): int
    {
        $this->info('Проверка запланированных уведомлений...');

        // Находим массовые уведомления, которые нужно отправить
        // Получаем все запланированные уведомления
        $allScheduled = Notification::where('is_mass', true)
            ->whereNotNull('scheduled_at')
            ->where('scheduled_at', '<=', now())
            ->get();
        
        // Фильтруем те, которые еще не отправлены (нет user_notifications)
        $notifications = $allScheduled->filter(function($notification) {
            return !$notification->userNotifications()->exists();
        });

        if ($notifications->isEmpty()) {
            $this->info('Нет запланированных уведомлений для обработки.');
            return Command::SUCCESS;
        }

        $this->info("Найдено уведомлений для обработки: {$notifications->count()}");

        foreach ($notifications as $notification) {
            $this->info("Обработка уведомления #{$notification->id}: {$notification->title}");
            $this->notificationService->processMassNotification($notification);
            $this->info("Уведомление #{$notification->id} обработано.");
        }

        $this->info('Обработка завершена.');

        return Command::SUCCESS;
    }
}

