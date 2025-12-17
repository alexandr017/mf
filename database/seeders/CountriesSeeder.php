<?php

namespace Database\Seeders;

use App\Models\Countries\Country;
use Illuminate\Database\Seeder;

class CountriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $countries = [
            ['id' => 1, 'name' => 'Россия', 'code' => 'RU'],
            ['id' => 2, 'name' => 'Беларусь', 'code' => 'BY'],
            ['id' => 3, 'name' => 'Казахстан', 'code' => 'KZ'],
            ['id' => 4, 'name' => 'Армения', 'code' => 'AM'],
        ];

        foreach ($countries as $country) {
            // Используем updateOrCreate для избежания дубликатов
            Country::updateOrCreate(
                ['id' => $country['id']],
                [
                    'name' => $country['name'],
                    'code' => $country['code'],
                ]
            );
        }

        $this->command->info('Страны созданы успешно!');
    }
}

