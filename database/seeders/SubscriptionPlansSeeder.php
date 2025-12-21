<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Subscriptions\SubscriptionPlan;

class SubscriptionPlansSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $plans = [
            [
                'name' => 'Базовый',
                'slug' => 'basic',
                'description' => 'Прокачка рейтинга в мини-играх в 1.5 раза быстрее',
                'price' => 2.50,
                'currency' => 'USD',
                'rating_multiplier' => 1.5,
                'duration_days' => 30,
                'is_active' => true,
                'sort_order' => 1,
            ],
            [
                'name' => 'Продвинутый',
                'slug' => 'advanced',
                'description' => 'Прокачка рейтинга в мини-играх в 2 раза быстрее',
                'price' => 4.00,
                'currency' => 'USD',
                'rating_multiplier' => 2.0,
                'duration_days' => 30,
                'is_active' => true,
                'sort_order' => 2,
            ],
        ];

        foreach ($plans as $plan) {
            SubscriptionPlan::updateOrCreate(
                ['slug' => $plan['slug']],
                $plan
            );
        }

        $this->command->info('Планы подписки созданы успешно!');
    }
}

