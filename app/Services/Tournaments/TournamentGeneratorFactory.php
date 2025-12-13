<?php

namespace App\Services\Tournaments;

use App\Services\Tournaments\Contracts\TournamentGeneratorInterface;
use App\Services\Tournaments\Generators\LeagueGenerator;
use App\Services\Tournaments\Generators\CupGenerator;
use App\Services\Tournaments\Generators\SupercupGenerator;
use App\Services\Tournaments\Generators\MixedGenerator;
use App\Models\Tournaments\TournamentTemplate;

class TournamentGeneratorFactory
{
    /**
     * Создает генератор на основе типа турнира
     *
     * @param TournamentTemplate $template
     * @return TournamentGeneratorInterface
     * @throws \InvalidArgumentException
     */
    public static function create(TournamentTemplate $template): TournamentGeneratorInterface
    {
        return match ($template->type) {
            'league' => new LeagueGenerator(),
            'cup' => new CupGenerator(),
            'supercup' => new SupercupGenerator(),
            'mixed' => new MixedGenerator(),
            default => throw new \InvalidArgumentException("Неизвестный тип турнира: {$template->type}"),
        };
    }
}

