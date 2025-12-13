<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Teams\Team;
use App\Models\Tournaments\TournamentStage;
use App\Models\Tournaments\TournamentMatch;

class MatchesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $teams = Team::all()->pluck('id')->toArray();
        $leagueStages = TournamentStage::where('type','league_round')->get();

        foreach($leagueStages as $stage){
            for($i=0;$i<count($teams);$i++){
                for($j=$i+1;$j<count($teams);$j++){
                    TournamentMatch::create([
                        'stage_id'=>$stage->id,
                        'team_1'=>$teams[$i],
                        'team_2'=>$teams[$j],
                        'date'=>now()->addDays($i+$j),
                        'score_1'=>rand(0,4),
                        'score_2'=>rand(0,4),
                        'status'=>'played'
                    ]);
                }
            }
        }
    }
}
