<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Tournaments\TournamentTemplate;

class TournamentTemplatesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Шаблон для национального чемпионата (лиги)
        TournamentTemplate::create([
            'name' => 'Национальный Чемпионат',
            'type' => 'league',
            'description' => 'Двухкруговой турнир по круговой системе. Все команды играют друг с другом дома и в гостях.',
            'structure_json' => [
                'stages' => [
                    [
                        'name' => 'Круг 1',
                        'type' => 'league_round',
                        'order' => 1
                    ],
                    [
                        'name' => 'Круг 2',
                        'type' => 'league_round',
                        'order' => 2
                    ]
                ]
            ],
            'config_json' => [
                'teams' => 20,
                'rounds' => 2,
                'days_between_rounds' => 7,
                'days_between_matches' => 1
            ],
            'is_default' => true
        ]);

        // Шаблон для национального кубка
        TournamentTemplate::create([
            'name' => 'Национальный Кубок',
            'type' => 'cup',
            'description' => 'Турнир на выбывание. Одно матчевые раунды до финала.',
            'structure_json' => [
                'stages' => [
                    [
                        'name' => '1/16 финала',
                        'type' => 'cup_round',
                        'order' => 1
                    ],
                    [
                        'name' => '1/8 финала',
                        'type' => 'cup_round',
                        'order' => 2
                    ],
                    [
                        'name' => '1/4 финала',
                        'type' => 'cup_round',
                        'order' => 3
                    ],
                    [
                        'name' => '1/2 финала',
                        'type' => 'cup_round',
                        'order' => 4
                    ],
                    [
                        'name' => 'Финал',
                        'type' => 'final',
                        'order' => 5
                    ]
                ]
            ],
            'config_json' => [
                'teams' => 16,
                'days_between_rounds' => 7,
                'days_between_matches' => 1
            ],
            'is_default' => true
        ]);

        // Шаблон для суперкубка
        TournamentTemplate::create([
            'name' => 'Суперкубок',
            'type' => 'supercup',
            'description' => 'Одиночный матч между чемпионом и обладателем кубка.',
            'structure_json' => [
                'stages' => [
                    [
                        'name' => 'Финал',
                        'type' => 'final',
                        'order' => 1
                    ]
                ]
            ],
            'config_json' => [
                'teams' => 2
            ],
            'is_default' => true
        ]);

        // Шаблон для Лиги Чемпионов (смешанный формат)
        TournamentTemplate::create([
            'name' => 'Лига Чемпионов',
            'type' => 'mixed',
            'description' => 'Групповая стадия + плей-офф. Группы по 4 команды, затем стадии плей-офф до финала.',
            'structure_json' => [
                'stages' => [
                    [
                        'name' => 'Групповая стадия',
                        'type' => 'group_stage',
                        'order' => 1
                    ],
                    [
                        'name' => '1/8 финала',
                        'type' => 'playoff',
                        'order' => 2
                    ],
                    [
                        'name' => '1/4 финала',
                        'type' => 'playoff',
                        'order' => 3
                    ],
                    [
                        'name' => '1/2 финала',
                        'type' => 'playoff',
                        'order' => 4
                    ],
                    [
                        'name' => 'Финал',
                        'type' => 'final',
                        'order' => 5
                    ]
                ]
            ],
            'config_json' => [
                'teams' => 32,
                'groups' => 8,
                'group_size' => 4,
                'group_rounds' => 2,
                'days_between_rounds' => 7,
                'days_between_matches' => 1
            ],
            'is_default' => true
        ]);
    }
}


