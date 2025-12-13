<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Tournaments\Tournament;
use App\Models\Tournaments\TournamentSeason;
use App\Models\Tournaments\TournamentStage;
use App\Models\Tournaments\TournamentGroup;

class TournamentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tournaments = [
            ['name'=>'Национальный Чемпионат','type'=>'league'],
            ['name'=>'Национальный Кубок','type'=>'cup'],
            ['name'=>'Суперкубок','type'=>'supercup'],
            ['name'=>'Лига Чемпионов','type'=>'mixed'],
        ];

        foreach($tournaments as $t){
            Tournament::create($t);
        }

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
