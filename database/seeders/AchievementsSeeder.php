<?php

namespace Database\Seeders;

use App\Models\Achievements\Achievement;
use Illuminate\Database\Seeder;

class AchievementsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $achievements = [
            [
                'name' => 'Первая победа',
                'description' => 'Одержал первую победу в матче',
                'image' => null,
            ],
            [
                'name' => 'Стрелок',
                'description' => 'Забил 10 голов',
                'image' => null,
            ],
            [
                'name' => 'Бомбардир',
                'description' => 'Забил 50 голов',
                'image' => null,
            ],
            [
                'name' => 'Легенда',
                'description' => 'Забил 100 голов',
                'image' => null,
            ],
            [
                'name' => 'Ассистент',
                'description' => 'Отдал 10 голевых передач',
                'image' => null,
            ],
            [
                'name' => 'Плеймейкер',
                'description' => 'Отдал 50 голевых передач',
                'image' => null,
            ],
            [
                'name' => 'Мастер ассистов',
                'description' => 'Отдал 100 голевых передач',
                'image' => null,
            ],
            [
                'name' => 'Новичок',
                'description' => 'Рейтинг выше 50',
                'image' => null,
            ],
            [
                'name' => 'Профи',
                'description' => 'Рейтинг выше 70',
                'image' => null,
            ],
            [
                'name' => 'Элита',
                'description' => 'Рейтинг выше 85',
                'image' => null,
            ],
            [
                'name' => 'Реферал',
                'description' => 'Пригласил 5 друзей',
                'image' => null,
            ],
            [
                'name' => 'Амбассадор',
                'description' => 'Пригласил 20 друзей',
                'image' => null,
            ],
            [
                'name' => 'Хет-трик',
                'description' => 'Забил 3 гола в одном матче',
                'image' => null,
            ],
            [
                'name' => 'Покер',
                'description' => 'Забил 4 гола в одном матче',
                'image' => null,
            ],
            [
                'name' => 'Ветеран',
                'description' => 'Играет более года',
                'image' => null,
            ],
        ];

        foreach ($achievements as $achievement) {
            Achievement::create($achievement);
        }
    }
}
