<?php

namespace App\Services\Tournaments\Generators;

use App\Models\Tournaments\TournamentSeason;
use App\Models\Tournaments\TournamentTemplate;
use App\Models\Tournaments\TournamentStage;
use App\Models\Tournaments\TournamentMatch;
use App\Services\Tournaments\Contracts\TournamentGeneratorInterface;
use Carbon\Carbon;

class LeagueGenerator implements TournamentGeneratorInterface
{
    public function generate(TournamentSeason $season, TournamentTemplate $template, array $teams, \DateTime $startDate): void
    {
        $config = $template->config_json;
        $structure = $template->structure_json;
        $rounds = $config['rounds'] ?? 2;
        $teamsCount = count($teams);

        if ($teamsCount < 2) {
            throw new \InvalidArgumentException('Недостаточно команд для создания лиги');
        }

        $currentDate = Carbon::instance($startDate);
        $daysBetweenRounds = $config['days_between_rounds'] ?? 7;

        // Создаем стадии
        for ($round = 1; $round <= $rounds; $round++) {
            $stageName = $structure['stages'][$round - 1]['name'] ?? "Круг {$round}";
            $stage = TournamentStage::create([
                'tournaments_season_id' => $season->id,
                'name' => $stageName,
                'type' => 'league_round',
                'stage_order' => $round,
            ]);

            // Генерируем матчи для круга
            $this->generateRoundMatches($stage, $teams, $currentDate, $config);

            // Переходим к следующему кругу
            $currentDate->addDays($daysBetweenRounds);
        }
    }

    /**
     * Генерирует матчи одного круга (round-robin)
     */
    private function generateRoundMatches(TournamentStage $stage, array $teams, Carbon $startDate, array $config): void
    {
        $daysBetweenMatches = $config['days_between_matches'] ?? 1;
        $currentDate = $startDate->copy();

        // Round-robin алгоритм
        $n = count($teams);
        if ($n < 2) {
            return;
        }

        $rounds = $n - 1;
        $matchesPerRound = (int)($n / 2);
        $roundTeams = $teams;

        for ($round = 0; $round < $rounds; $round++) {
            for ($i = 0; $i < $matchesPerRound; $i++) {
                $home = $roundTeams[$i];
                $away = $roundTeams[$n - 1 - $i];

                TournamentMatch::create([
                    'stage_id' => $stage->id,
                    'group_id' => null,
                    'team_1' => $home,
                    'team_2' => $away,
                    'date' => $currentDate->copy(),
                    'status' => 'scheduled',
                ]);

                $currentDate->addDays($daysBetweenMatches);
            }

            // Ротация команд (кроме первой)
            $last = array_pop($roundTeams);
            array_splice($roundTeams, 1, 0, $last);
        }
    }
}

