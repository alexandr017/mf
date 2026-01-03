<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class IncreaseFakeUsersRating extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fake-users:increase-rating';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Увеличивает рейтинг фейковых пользователей (имитация игры)';

    /**
     * Минимальное увеличение рейтинга за один запуск
     */
    const MIN_RATING_INCREASE = 0.01;

    /**
     * Максимальное увеличение рейтинга за один запуск
     */
    const MAX_RATING_INCREASE = 0.02;

    /**
     * Максимальный рейтинг для фейковых пользователей
     */
    const MAX_FAKE_RATING = 15.0;

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $this->info('Начинаем увеличение рейтинга фейковых пользователей...');

        // Получаем всех фейковых пользователей
        $fakeUsers = User::where('is_fake', true)->get();

        if ($fakeUsers->isEmpty()) {
            $this->info('Нет фейковых пользователей для обновления.');
            return Command::SUCCESS;
        }

        $updated = 0;
        $skipped = 0;

        foreach ($fakeUsers as $user) {
            // Генерируем случайное увеличение рейтинга
            $increase = fake()->randomFloat(2, self::MIN_RATING_INCREASE, self::MAX_RATING_INCREASE);
            
            $newRating = $user->rating + $increase;
            
            // Ограничиваем максимальный рейтинг
            if ($newRating > self::MAX_FAKE_RATING) {
                $skipped++;
                continue;
            }

            // Обновляем рейтинг
            $user->update(['rating' => $newRating]);
            $updated++;
        }

        $this->info("Обновлено рейтингов: {$updated}");
        if ($skipped > 0) {
            $this->info("Пропущено (достигнут максимум): {$skipped}");
        }

        $this->info('Готово!');
        return Command::SUCCESS;
    }
}

