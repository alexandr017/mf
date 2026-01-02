<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Reports\UserReport;
use App\Models\Reports\ReportCategory;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class UserReportsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::take(20)->get();
        
        if ($users->count() < 2) {
            $this->command->warn('Недостаточно пользователей для создания жалоб. Создайте больше пользователей.');
            return;
        }

        $categories = array_keys(ReportCategory::getAll());
        $statuses = ['pending', 'reviewed', 'resolved', 'rejected'];

        // Создаем жалобы от зарегистрированных пользователей
        for ($i = 0; $i < 15; $i++) {
            $reportedUser = $users->random();
            $reporterUser = $users->where('id', '!=', $reportedUser->id)->random();
            
            UserReport::create([
                'reported_user_id' => $reportedUser->id,
                'reporter_user_id' => $reporterUser->id,
                'category_id' => $categories[array_rand($categories)],
                'description' => fake()->sentence(10),
                'status' => $statuses[array_rand($statuses)],
                'admin_notes' => rand(0, 1) ? fake()->sentence(5) : null,
                'reviewed_by' => rand(0, 1) ? 1 : null,
                'reviewed_at' => rand(0, 1) ? now()->subDays(rand(1, 30)) : null,
                'created_at' => now()->subDays(rand(1, 60)),
            ]);
        }

        // Создаем жалобы от незарегистрированных пользователей
        for ($i = 0; $i < 5; $i++) {
            $reportedUser = $users->random();
            
            UserReport::create([
                'reported_user_id' => $reportedUser->id,
                'reporter_user_id' => null,
                'reporter_email' => fake()->email(),
                'reporter_ip' => fake()->ipv4(),
                'category_id' => $categories[array_rand($categories)],
                'description' => fake()->sentence(10),
                'status' => 'pending',
                'created_at' => now()->subDays(rand(1, 30)),
            ]);
        }

        $this->command->info('Создано 20 жалоб (15 от зарегистрированных, 5 от незарегистрированных пользователей)');
    }
}


