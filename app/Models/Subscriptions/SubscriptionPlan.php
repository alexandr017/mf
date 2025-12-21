<?php

namespace App\Models\Subscriptions;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SubscriptionPlan extends Model
{
    use HasFactory;

    protected $table = 'subscription_plans';

    protected $fillable = [
        'name',
        'slug',
        'description',
        'price',
        'currency',
        'rating_multiplier',
        'duration_days',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'rating_multiplier' => 'decimal:2',
        'is_active' => 'boolean',
    ];

    /**
     * Подписки пользователей на этот план
     */
    public function userSubscriptions()
    {
        return $this->hasMany(UserSubscription::class);
    }

    /**
     * Активные подписки пользователей на этот план
     */
    public function activeSubscriptions()
    {
        return $this->hasMany(UserSubscription::class)
            ->where('status', 'active')
            ->where('ends_at', '>', now());
    }
}

