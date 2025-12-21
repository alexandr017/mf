<?php

namespace App\Helpers;

use App\Models\User;
use App\Models\Subscriptions\SubscriptionPlan;
use App\Models\Subscriptions\UserSubscription;
use Carbon\Carbon;

class SubscriptionHelper
{
    /**
     * Создать подписку для пользователя
     *
     * @param User $user
     * @param SubscriptionPlan $plan
     * @param array $paymentData
     * @return UserSubscription
     */
    public static function createSubscription(User $user, SubscriptionPlan $plan, array $paymentData = []): UserSubscription
    {
        // Отменяем предыдущие активные подписки
        $user->subscriptions()
            ->where('status', 'active')
            ->where('ends_at', '>', now())
            ->update([
                'status' => 'cancelled',
                'cancelled_at' => now(),
            ]);

        // Создаем новую подписку
        $subscription = UserSubscription::create([
            'user_id' => $user->id,
            'subscription_plan_id' => $plan->id,
            'starts_at' => now(),
            'ends_at' => now()->addDays($plan->duration_days),
            'status' => 'active',
            'payment_method' => $paymentData['payment_method'] ?? null,
            'payment_transaction_id' => $paymentData['transaction_id'] ?? null,
            'auto_renew' => $paymentData['auto_renew'] ?? true,
        ]);

        return $subscription;
    }

    /**
     * Продлить подписку
     *
     * @param UserSubscription $subscription
     * @return UserSubscription
     */
    public static function renewSubscription(UserSubscription $subscription): UserSubscription
    {
        if (!$subscription->isActive()) {
            throw new \Exception('Подписка не активна');
        }

        $plan = $subscription->plan;
        $subscription->update([
            'ends_at' => $subscription->ends_at->addDays($plan->duration_days),
        ]);

        return $subscription->fresh();
    }

    /**
     * Отменить подписку
     *
     * @param UserSubscription $subscription
     * @return void
     */
    public static function cancelSubscription(UserSubscription $subscription): void
    {
        $subscription->cancel();
    }

    /**
     * Проверить и обновить статусы истекших подписок
     *
     * @return int Количество обновленных подписок
     */
    public static function updateExpiredSubscriptions(): int
    {
        return UserSubscription::where('status', 'active')
            ->where('ends_at', '<=', now())
            ->whereNull('cancelled_at')
            ->update([
                'status' => 'expired',
            ]);
    }

    /**
     * Получить множитель рейтинга для пользователя
     *
     * @param User $user
     * @return float
     */
    public static function getRatingMultiplier(User $user): float
    {
        return $user->getRatingMultiplier();
    }

    /**
     * Применить множитель к очкам рейтинга
     *
     * @param User $user
     * @param float $basePoints
     * @return float
     */
    public static function applyRatingMultiplier(User $user, float $basePoints): float
    {
        $multiplier = self::getRatingMultiplier($user);
        return $basePoints * $multiplier;
    }
}

