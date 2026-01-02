<?php

namespace App\Services;

use App\Models\Notifications\Notification;
use App\Models\Notifications\UserNotification;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class NotificationService
{
    // Типы уведомлений
    const TYPE_MASS = 'mass';
    const TYPE_RATING_INCREASED = 'rating_increased';
    const TYPE_REFERRAL_SUCCESS = 'referral_success';
    const TYPE_GAME_REMINDER_24H = 'game_reminder_24h';
    const TYPE_GAME_REMINDER_1H = 'game_reminder_1h';
    const TYPE_GAME_COMPLETED = 'game_completed';
    const TYPE_MATCH_STARTING_SOON = 'match_starting_soon';
    const TYPE_TEAM_JOINED = 'team_joined';
    const TYPE_TEAM_LEFT = 'team_left';
    const TYPE_ACHIEVEMENT_EARNED = 'achievement_earned';

    /**
     * Отправить уведомление пользователю
     */
    public function sendNotification(
        User $user,
        string $type,
        string $title,
        string $message,
        array $data = [],
        ?Notification $notification = null
    ): UserNotification {
        $userNotification = UserNotification::create([
            'user_id' => $user->id,
            'notification_id' => $notification?->id,
            'type' => $type,
            'title' => $title,
            'message' => $message,
            'data' => $data,
            'is_read' => false,
        ]);

        // Отправка в Telegram (будет реализовано позже)
        if ($user->telegram_chat_id && $user->telegram_notifications_enabled) {
            $this->sendToTelegram($userNotification);
        }

        return $userNotification;
    }

    /**
     * Отправить массовое уведомление
     */
    public function sendMassNotification(
        string $title,
        string $message,
        array $data = [],
        ?User $createdBy = null,
        ?\DateTimeInterface $scheduledAt = null
    ): Notification {
        $notification = Notification::create([
            'type' => self::TYPE_MASS,
            'title' => $title,
            'message' => $message,
            'data' => $data,
            'created_by_user_id' => $createdBy?->id ?? auth()->id(),
            'is_mass' => true,
            'scheduled_at' => $scheduledAt,
        ]);

        // Если не запланировано, отправляем сразу
        if (!$scheduledAt || $scheduledAt <= now()) {
            $this->processMassNotification($notification);
        }

        return $notification;
    }

    /**
     * Обработать массовое уведомление (отправить всем пользователям)
     */
    public function processMassNotification(Notification $notification): void
    {
        // Проверяем, не было ли уже отправлено
        if ($notification->userNotifications()->exists()) {
            return;
        }

        $users = User::whereNotNull('email')->get();
        
        DB::transaction(function () use ($notification, $users) {
            $chunkSize = 100;
            $users->chunk($chunkSize, function ($userChunk) use ($notification) {
                foreach ($userChunk as $user) {
                    $this->sendNotification(
                        $user,
                        $notification->type,
                        $notification->title,
                        $notification->message,
                        $notification->data ?? [],
                        $notification
                    );
                }
            });
        });
    }

    /**
     * Уведомление о повышении рейтинга
     */
    public function notifyRatingIncreased(User $user, float $oldRating, float $newRating, string $reason = ''): void
    {
        $increase = $newRating - $oldRating;
        $title = 'Повышение рейтинга';
        $message = "Ваш рейтинг увеличился на {$increase}. Новый рейтинг: {$newRating}";
        if ($reason) {
            $message .= ". Причина: {$reason}";
        }

        $this->sendNotification(
            $user,
            self::TYPE_RATING_INCREASED,
            $title,
            $message,
            [
                'old_rating' => $oldRating,
                'new_rating' => $newRating,
                'increase' => $increase,
                'reason' => $reason,
            ]
        );
    }

    /**
     * Уведомление об успешном привлечении реферала
     */
    public function notifyReferralSuccess(User $user, User $referral): void
    {
        $title = 'Новый реферал';
        $message = "Пользователь {$referral->name} зарегистрировался по вашей реферальной ссылке!";

        $this->sendNotification(
            $user,
            self::TYPE_REFERRAL_SUCCESS,
            $title,
            $message,
            [
                'referral_id' => $referral->id,
                'referral_name' => $referral->name,
            ]
        );
    }

    /**
     * Уведомление о напоминании матча (за 24 часа)
     */
    public function notifyGameReminder24h(User $user, $match, string $matchType = 'friendly'): void
    {
        $team1 = $match->homeTeam->name ?? 'Команда 1';
        $team2 = $match->awayTeam->name ?? 'Команда 2';
        $matchDate = $match->date->format('d.m.Y H:i');
        
        $title = 'Напоминание о матче';
        $message = "Через 24 часа матч: {$team1} vs {$team2}. Дата: {$matchDate}";

        $this->sendNotification(
            $user,
            self::TYPE_GAME_REMINDER_24H,
            $title,
            $message,
            [
                'match_id' => $match->id,
                'match_type' => $matchType,
                'match_date' => $match->date->toIso8601String(),
                'team1' => $team1,
                'team2' => $team2,
            ]
        );
    }

    /**
     * Уведомление о напоминании матча (за 1 час)
     */
    public function notifyGameReminder1h(User $user, $match, string $matchType = 'friendly'): void
    {
        $team1 = $match->homeTeam->name ?? 'Команда 1';
        $team2 = $match->awayTeam->name ?? 'Команда 2';
        $matchDate = $match->date->format('d.m.Y H:i');
        
        $title = 'Матч скоро начнется';
        $message = "Через 1 час матч: {$team1} vs {$team2}. Дата: {$matchDate}";

        $this->sendNotification(
            $user,
            self::TYPE_GAME_REMINDER_1H,
            $title,
            $message,
            [
                'match_id' => $match->id,
                'match_type' => $matchType,
                'match_date' => $match->date->toIso8601String(),
                'team1' => $team1,
                'team2' => $team2,
            ]
        );
    }

    /**
     * Уведомление о завершении матча
     */
    public function notifyGameCompleted(User $user, $match, string $matchType = 'friendly'): void
    {
        $team1 = $match->homeTeam->name ?? 'Команда 1';
        $team2 = $match->awayTeam->name ?? 'Команда 2';
        $score1 = $match->score_1 ?? 0;
        $score2 = $match->score_2 ?? 0;
        
        $title = 'Матч завершен';
        $message = "Матч завершен: {$team1} {$score1} - {$score2} {$team2}";

        $this->sendNotification(
            $user,
            self::TYPE_GAME_COMPLETED,
            $title,
            $message,
            [
                'match_id' => $match->id,
                'match_type' => $matchType,
                'team1' => $team1,
                'team2' => $team2,
                'score1' => $score1,
                'score2' => $score2,
            ]
        );
    }

    /**
     * Отправка уведомления в Telegram (заглушка для будущей реализации)
     */
    protected function sendToTelegram(UserNotification $userNotification): void
    {
        // TODO: Реализовать отправку в Telegram
        // Пока просто помечаем как отправленное
        $userNotification->update([
            'sent_to_telegram' => true,
            'telegram_sent_at' => now(),
        ]);
        
        Log::info('Telegram notification sent', [
            'user_notification_id' => $userNotification->id,
            'user_id' => $userNotification->user_id,
            'type' => $userNotification->type,
        ]);
    }

    /**
     * Пометить уведомление как прочитанное
     */
    public function markAsRead(UserNotification $userNotification): void
    {
        $userNotification->markAsRead();
    }

    /**
     * Получить количество непрочитанных уведомлений пользователя
     */
    public function getUnreadCount(User $user): int
    {
        return $user->unreadNotifications()->count();
    }
}

