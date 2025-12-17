<?php

namespace App\Services\Tournaments\Contracts;

use App\Models\Tournaments\TournamentSeason;
use App\Models\Tournaments\TournamentTemplate;
use Illuminate\Support\Collection;

interface TournamentGeneratorInterface
{
    /**
     * Генерирует структуру сезона (стадии, группы, матчи) на основе шаблона
     *
     * @param TournamentSeason $season
     * @param TournamentTemplate $template
     * @param array $teams Массив ID команд
     * @param \DateTime $startDate Дата начала турнира
     * @return void
     */
    public function generate(TournamentSeason $season, TournamentTemplate $template, array $teams, \DateTime $startDate): void;
}



