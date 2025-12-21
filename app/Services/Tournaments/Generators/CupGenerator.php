<?php

namespace App\Services\Tournaments\Generators;

use App\Models\Tournaments\TournamentSeason;
use App\Models\Tournaments\TournamentTemplate;
use App\Models\Tournaments\TournamentStage;
use App\Models\Tournaments\TournamentMatch;
use App\Services\Tournaments\Contracts\TournamentGeneratorInterface;
use Carbon\Carbon;

class CupGenerator implements TournamentGeneratorInterface
{
    public function generate(TournamentSeason $season, TournamentTemplate $template, array $teams, \DateTime $startDate): void
    {
        $config = $template->config_json;
        $structure = $template->structure_json;
        $stages = $structure['stages'] ?? [];

        if (empty($stages)) {
            throw new \InvalidArgumentException('Шаблон кубка должен содержать стадии');
        }

        $currentDate = Carbon::instance($startDate);
        $daysBetweenRounds = $config['days_between_rounds'] ?? 7;
        $teamsCount = count($teams);

        // Создаем стадии
        $createdStages = [];
        foreach ($stages as $index => $stageConfig) {
            $stage = TournamentStage::create([
                'tournaments_season_id' => $season->id,
                'name' => $stageConfig['name'],
                'type' => $stageConfig['type'] ?? 'cup_round',
                'stage_order' => $stageConfig['order'] ?? ($index + 1),
            ]);
            $createdStages[] = $stage;
        }

        // Для кубка создаем матчи только для первого раунда
        // Остальные матчи будут создаваться по мере прохождения турнира
        $firstStage = $createdStages[0];
        $this->generateCupRoundMatches($firstStage, $teams, $currentDate, $config);

        // Создаем пустые матчи для последующих раундов (без команд)
        for ($i = 1; $i < count($createdStages); $i++) {
            $stage = $createdStages[$i];
            $expectedMatches = $this->getExpectedMatchesCount($teamsCount, $i);
            $currentDate->addDays($daysBetweenRounds);

            for ($j = 0; $j < $expectedMatches; $j++) {
                TournamentMatch::create([
                    'stage_id' => $stage->id,
                    'group_id' => null,
                    'team_1' => null, // Будет заполнено после предыдущего раунда
                    'team_2' => null,
                    'date' => $currentDate->copy()->addDays($j),
                    'status' => 'scheduled',
                ]);
            }
        }
    }

    /**
     * Генерирует матчи раунда кубка
     */
    private function generateCupRoundMatches(TournamentStage $stage, array $teams, Carbon $startDate, array $config): void
    {
        $daysBetweenMatches = $config['days_between_matches'] ?? 1;
        $currentDate = $startDate->copy();

        // Перемешиваем команды для жеребьевки
        shuffle($teams);

        $matchesCount = count($teams) / 2;
        for ($i = 0; $i < $matchesCount; $i++) {
            TournamentMatch::create([
                'stage_id' => $stage->id,
                'group_id' => null,
                'team_1' => $teams[$i * 2],
                'team_2' => $teams[$i * 2 + 1],
                'date' => $currentDate->copy()->addDays($i * $daysBetweenMatches),
                'status' => 'scheduled',
            ]);
        }
    }

    /**
     * Вычисляет ожидаемое количество матчей в раунде
     */
    private function getExpectedMatchesCount(int $initialTeams, int $roundIndex): int
    {
        return (int)($initialTeams / pow(2, $roundIndex + 1));
    }
}




