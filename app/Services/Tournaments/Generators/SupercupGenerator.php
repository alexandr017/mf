<?php

namespace App\Services\Tournaments\Generators;

use App\Models\Tournaments\TournamentSeason;
use App\Models\Tournaments\TournamentTemplate;
use App\Models\Tournaments\TournamentStage;
use App\Models\Tournaments\TournamentMatch;
use App\Services\Tournaments\Contracts\TournamentGeneratorInterface;
use Carbon\Carbon;

class SupercupGenerator implements TournamentGeneratorInterface
{
    public function generate(TournamentSeason $season, TournamentTemplate $template, array $teams, \DateTime $startDate): void
    {
        if (count($teams) !== 2) {
            throw new \InvalidArgumentException('Суперкубок требует ровно 2 команды');
        }

        $structure = $template->structure_json;
        $stageConfig = $structure['stages'][0] ?? ['name' => 'Финал', 'type' => 'final'];

        // Создаем одну стадию - финал
        $stage = TournamentStage::create([
            'tournaments_season_id' => $season->id,
            'name' => $stageConfig['name'],
            'type' => 'final',
            'stage_order' => 1,
        ]);

        // Создаем один матч
        TournamentMatch::create([
            'stage_id' => $stage->id,
            'group_id' => null,
            'team_1' => $teams[0],
            'team_2' => $teams[1],
            'date' => Carbon::instance($startDate),
            'status' => 'scheduled',
        ]);
    }
}





