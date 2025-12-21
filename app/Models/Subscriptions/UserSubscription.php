<?php

namespace App\Models\Subscriptions;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserSubscription extends Model
{
    use HasFactory;

    protected $table = 'user_subscriptions';

    protected $fillable = [
        'user_id',
        'subscription_plan_id',
        'starts_at',
        'ends_at',
        'cancelled_at',
        'status',
        'payment_method',
        'payment_transaction_id',
        'auto_renew',
    ];

    protected $casts = [
        'starts_at' => 'datetime',
        'ends_at' => 'datetime',
        'cancelled_at' => 'datetime',
        'auto_renew' => 'boolean',
    ];

    /**
     * Пользователь
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * План подписки
     */
    public function plan()
    {
        return $this->belongsTo(SubscriptionPlan::class, 'subscription_plan_id');
    }

    /**
     * Проверка, активна ли подписка
     */
    public function isActive(): bool
    {
        return $this->status === 'active' 
            && $this->ends_at > now() 
            && $this->cancelled_at === null;
    }

    /**
     * Проверка, истекла ли подписка
     */
    public function isExpired(): bool
    {
        return $this->ends_at <= now() || $this->status === 'expired';
    }

    /**
     * Отмена подписки
     */
    public function cancel(): void
    {
        $this->update([
            'status' => 'cancelled',
            'cancelled_at' => now(),
            'auto_renew' => false,
        ]);
    }
}

