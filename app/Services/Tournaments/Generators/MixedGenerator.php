<?php

namespace App\Services\Tournaments\Generators;

use App\Models\Tournaments\TournamentSeason;
use App\Models\Tournaments\TournamentTemplate;
use App\Models\Tournaments\TournamentStage;
use App\Models\Tournaments\TournamentGroup;
use App\Models\Tournaments\TournamentMatch;
use App\Services\Tournaments\Contracts\TournamentGeneratorInterface;
use Carbon\Carbon;

class MixedGenerator implements TournamentGeneratorInterface
{
    public function generate(TournamentSeason $season, TournamentTemplate $template, array $teams, \DateTime $startDate): void
    {
        $config = $template->config_json;
        $structure = $template->structure_json;
        $stages = $structure['stages'] ?? [];

        if (empty($stages)) {
            throw new \InvalidArgumentException('Шаблон смешанного турнира должен содержать стадии');
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
                'type' => $stageConfig['type'],
                'stage_order' => $stageConfig['order'] ?? ($index + 1),
            ]);
            $createdStages[] = $stage;

            // Если это групповая стадия, создаем группы
            if ($stageConfig['type'] === 'group_stage') {
                $groupsCount = $config['groups'] ?? 4;
                $this->generateGroups($stage, $groupsCount);
                $this->generateGroupStageMatches($stage, $teams, $currentDate, $config);
            } elseif (in_array($stageConfig['type'], ['playoff', 'cup_round'])) {
                // Для плей-офф создаем пустые матчи
                $expectedMatches = $this->getExpectedMatchesCount($teamsCount, $index);
                $this->generatePlayoffMatches($stage, $expectedMatches, $currentDate, $config);
            } elseif ($stageConfig['type'] === 'final') {
                // Финал - один матч
                TournamentMatch::create([
                    'stage_id' => $stage->id,
                    'group_id' => null,
                    'team_1' => null,
                    'team_2' => null,
                    'date' => $currentDate->copy(),
                    'status' => 'scheduled',
                ]);
            }

            $currentDate->addDays($daysBetweenRounds);
        }
    }

    /**
     * Создает группы для групповой стадии
     */
    private function generateGroups(TournamentStage $stage, int $groupsCount): void
    {
        $letters = range('A', 'Z');
        for ($i = 0; $i < $groupsCount; $i++) {
            TournamentGroup::create([
                'stage_id' => $stage->id,
                'name' => "Group {$letters[$i]}",
            ]);
        }
    }

    /**
     * Генерирует матчи групповой стадии
     */
    private function generateGroupStageMatches(TournamentStage $stage, array $teams, Carbon $startDate, array $config): void
    {
        $groups = $stage->groups;
        $groupsCount = $groups->count();
        if ($groupsCount == 0) {
            return;
        }

        $teamsPerGroup = (int)(count($teams) / $groupsCount);
        $daysBetweenMatches = $config['days_between_matches'] ?? 1;
        $rounds = $config['group_rounds'] ?? 2; // Двухкруговой турнир в группах

        // Распределяем команды по группам
        shuffle($teams);
        $groupTeams = array_chunk($teams, $teamsPerGroup);

        $currentDate = $startDate->copy();
        foreach ($groups as $groupIndex => $group) {
            $groupTeamList = $groupTeams[$groupIndex] ?? [];
            if (count($groupTeamList) < 2) continue;

            // Генерируем матчи для группы (round-robin)
            for ($round = 0; $round < $rounds; $round++) {
                $n = count($groupTeamList);
                $roundsCount = $n - 1;
                $matchesPerRound = (int)($n / 2);
                $roundTeamsList = $groupTeamList;

                for ($r = 0; $r < $roundsCount; $r++) {
                    for ($i = 0; $i < $matchesPerRound; $i++) {
                        $home = $roundTeamsList[$i];
                        $away = $roundTeamsList[$n - 1 - $i];

                        TournamentMatch::create([
                            'stage_id' => $stage->id,
                            'group_id' => $group->id,
                            'team_1' => $home,
                            'team_2' => $away,
                            'date' => $currentDate->copy(),
                            'status' => 'scheduled',
                        ]);

                        $currentDate->addDays($daysBetweenMatches);
                    }

                    // Ротация для следующего тура
                    $last = array_pop($roundTeamsList);
                    array_splice($roundTeamsList, 1, 0, $last);
                }
            }
        }
    }

    /**
     * Генерирует матчи плей-офф (без команд)
     */
    private function generatePlayoffMatches(TournamentStage $stage, int $matchesCount, Carbon $startDate, array $config): void
    {
        $daysBetweenMatches = $config['days_between_matches'] ?? 1;
        $currentDate = $startDate->copy();

        for ($i = 0; $i < $matchesCount; $i++) {
            TournamentMatch::create([
                'stage_id' => $stage->id,
                'group_id' => null,
                'team_1' => null,
                'team_2' => null,
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
        // Для плей-офф после групповой стадии обычно выходит 8 команд
        $playoffTeams = 8;
        return (int)($playoffTeams / pow(2, $roundIndex));
    }
}

