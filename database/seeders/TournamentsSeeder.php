<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Tournaments\Tournament;
use App\Models\Tournaments\TournamentSeason;
use App\Models\Tournaments\TournamentStage;
use App\Models\Tournaments\TournamentGroup;
use Illuminate\Support\Facades\DB;

class TournamentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
//        $this->command->info('Очистка таблицы tournaments...');
//        DB::table('tournaments')->truncate();

        // Цвета для каждой страны (null для СНГ)
        $countryColors = [
            null => '#7FFF00', // СНГ - primary (зеленый)
            1 => '#FF355E', // Россия - secondary (красный)
            2 => '#4169E1', // Беларусь - синий
            3 => '#FFD700', // Казахстан - золотой
            4 => '#FF6347', // Армения - оранжево-красный
        ];

        $tournaments = [
            // СНГ (country_id = null)
            ['name' => 'Кубок СНГ', 'type' => 'cup', 'country_id' => null, 'color' => $countryColors[null], 'participants_count' => 16],

            // Россия (country_id = 1)
            ['name' => 'Чемпионат России', 'type' => 'league', 'country_id' => 1, 'color' => $countryColors[1], 'participants_count' => 20],
            ['name' => 'Кубок России', 'type' => 'cup', 'country_id' => 1, 'color' => $countryColors[1], 'participants_count' => 32],
            ['name' => 'Суперкубок России', 'type' => 'supercup', 'country_id' => 1, 'color' => $countryColors[1], 'participants_count' => 2],
            ['name' => 'Второй дивизион России', 'type' => 'league', 'country_id' => 1, 'color' => $countryColors[1], 'participants_count' => 18],

            // Беларусь (country_id = 2)
            ['name' => 'Чемпионат Беларуси', 'type' => 'league', 'country_id' => 2, 'color' => $countryColors[2], 'participants_count' => 16],
            ['name' => 'Кубок Беларуси', 'type' => 'cup', 'country_id' => 2, 'color' => $countryColors[2], 'participants_count' => 32],
            ['name' => 'Суперкубок Беларуси', 'type' => 'supercup', 'country_id' => 2, 'color' => $countryColors[2], 'participants_count' => 2],

            // Казахстан (country_id = 3)
            ['name' => 'Чемпионат Казахстана', 'type' => 'league', 'country_id' => 3, 'color' => $countryColors[3], 'participants_count' => 14],
            ['name' => 'Кубок Казахстана', 'type' => 'cup', 'country_id' => 3, 'color' => $countryColors[3], 'participants_count' => 28],
            ['name' => 'Суперкубок Казахстана', 'type' => 'supercup', 'country_id' => 3, 'color' => $countryColors[3], 'participants_count' => 2],

            // Армения (country_id = 4)
            ['name' => 'Чемпионат Армении', 'type' => 'league', 'country_id' => 4, 'color' => $countryColors[4], 'participants_count' => 10],
            ['name' => 'Кубок Армении', 'type' => 'cup', 'country_id' => 4, 'color' => $countryColors[4], 'participants_count' => 16],
            ['name' => 'Суперкубок Армении', 'type' => 'supercup', 'country_id' => 4, 'color' => $countryColors[4], 'participants_count' => 2],
        ];

        foreach($tournaments as $t){
            Tournament::create($t);
        }

        $this->command->info('Турниры созданы успешно! Создано: ' . count($tournaments));

        $seasons = [
            ['tournament_id'=>1,'year_start'=>2022,'year_finish'=>2023,'rules_json'=>json_encode(['teams'=>20,'rounds'=>2])],
            ['tournament_id'=>1,'year_start'=>2023,'year_finish'=>2024,'rules_json'=>json_encode(['teams'=>20,'rounds'=>2])],
            ['tournament_id'=>2,'year_start'=>2022,'year_finish'=>2023,'rules_json'=>json_encode(['teams'=>16,'single_leg'=>true])],
            ['tournament_id'=>2,'year_start'=>2023,'year_finish'=>2024,'rules_json'=>json_encode(['teams'=>16,'single_leg'=>true])],
            ['tournament_id'=>3,'year_start'=>2022,'year_finish'=>2022,'rules_json'=>json_encode(['single_match'=>true])],
            ['tournament_id'=>3,'year_start'=>2023,'year_finish'=>2023,'rules_json'=>json_encode(['single_match'=>true])],
            ['tournament_id'=>4,'year_start'=>2022,'year_finish'=>2023,'rules_json'=>json_encode(['groups'=>4,'group_size'=>4,'group_rounds'=>2])],
            ['tournament_id'=>4,'year_start'=>2023,'year_finish'=>2024,'rules_json'=>json_encode(['groups'=>4,'group_size'=>4,'group_rounds'=>2])]
        ];

        foreach($seasons as $s){
            $season = TournamentSeason::create($s);
            // создаём стадии
            if($season->tournament_id==1){
                TournamentStage::insert([
                    ['tournaments_season_id'=>$season->id,'name'=>'Круг 1','type'=>'league_round','stage_order'=>1],
                    ['tournaments_season_id'=>$season->id,'name'=>'Круг 2','type'=>'league_round','stage_order'=>2]
                ]);
            }
            elseif($season->tournament_id==2){
                TournamentStage::insert([
                    ['tournaments_season_id'=>$season->id,'name'=>'1/8','type'=>'cup_round','stage_order'=>1],
                    ['tournaments_season_id'=>$season->id,'name'=>'1/4','type'=>'cup_round','stage_order'=>2],
                    ['tournaments_season_id'=>$season->id,'name'=>'1/2','type'=>'cup_round','stage_order'=>3],
                    ['tournaments_season_id'=>$season->id,'name'=>'Финал','type'=>'final','stage_order'=>4],
                ]);
            }
            elseif($season->tournament_id==3){
                TournamentStage::insert([
                    ['tournaments_season_id'=>$season->id,'name'=>'Финал','type'=>'final','stage_order'=>1]
                ]);
            }
            elseif($season->tournament_id==4){
                TournamentStage::insert([
                    ['tournaments_season_id'=>$season->id,'name'=>'Групповая стадия','type'=>'group_stage','stage_order'=>1],
                    ['tournaments_season_id'=>$season->id,'name'=>'1/4','type'=>'playoff','stage_order'=>2],
                    ['tournaments_season_id'=>$season->id,'name'=>'1/2','type'=>'playoff','stage_order'=>3],
                    ['tournaments_season_id'=>$season->id,'name'=>'Финал','type'=>'final','stage_order'=>4],
                ]);
                $stageId = TournamentStage::where('tournaments_season_id',$season->id)->where('type','group_stage')->first()->id;
                foreach(['A','B','C','D'] as $g){
                    TournamentGroup::create(['stage_id'=>$stageId,'name'=>"Group $g"]);
                }
            }
        }
    }
}
