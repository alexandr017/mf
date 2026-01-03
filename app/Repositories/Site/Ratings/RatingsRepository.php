<?php

namespace App\Repositories\Site\Ratings;

use Illuminate\Support\Facades\DB;

class RatingsRepository
{
    /**
     * Получить топ N команд по очкам
     *
     * @param int $limit
     * @return \Illuminate\Support\Collection
     */
    public function getTopTeams(int $limit = 10)
    {
        return DB::table('ratings')
            ->join('teams', 'ratings.team_id', '=', 'teams.id')
            ->leftJoin('cities', 'teams.city_id', '=', 'cities.id')
            ->leftJoin('countries', 'teams.country_id', '=', 'countries.id')
            ->select(
                'teams.id',
                'teams.name',
                'teams.alias',
                'teams.logo',
                'teams.country_id',
                'countries.name as country_name',
                'cities.name as city_name',
                'ratings.games',
                'ratings.wins',
                'ratings.draws',
                'ratings.losses',
                'ratings.goal_difference',
                'ratings.points'
            )
            ->orderBy('ratings.points', 'desc')
            ->orderBy('ratings.goal_difference', 'desc')
            ->orderBy('ratings.wins', 'desc')
            ->limit($limit)
            ->get()
            ->map(function ($team, $index) {
                $team->position = $index + 1;
                // Получаем цвет страны из первого турнира этой страны
                $team->country_color = $this->getCountryColor($team->country_id);
                return $team;
            });
    }

    /**
     * Получить все команды с рейтингом
     *
     * @return \Illuminate\Support\Collection
     */
    public function getAllTeams()
    {
        return DB::table('ratings')
            ->join('teams', 'ratings.team_id', '=', 'teams.id')
            ->leftJoin('cities', 'teams.city_id', '=', 'cities.id')
            ->leftJoin('countries', 'teams.country_id', '=', 'countries.id')
            ->select(
                'teams.id',
                'teams.name',
                'teams.alias',
                'teams.logo',
                'teams.country_id',
                'countries.name as country_name',
                'cities.name as city_name',
                'ratings.games',
                'ratings.wins',
                'ratings.draws',
                'ratings.losses',
                'ratings.goal_difference',
                'ratings.points'
            )
            ->orderBy('ratings.points', 'desc')
            ->orderBy('ratings.goal_difference', 'desc')
            ->orderBy('ratings.wins', 'desc')
            ->get()
            ->map(function ($team, $index) {
                $team->position = $index + 1;
                // Получаем цвет страны из первого турнира этой страны
                $team->country_color = $this->getCountryColor($team->country_id);
                return $team;
            });
    }

    /**
     * Получить цвет для страны (используется тот же подход, что и на странице турниров)
     */
    protected function getCountryColor($countryId): string
    {
        if ($countryId === null || $countryId === 'null') {
            return '#7FFF00'; // СНГ
        }

        // Получаем цвет из первого турнира этой страны
        $tournament = DB::table('tournaments')
            ->where('country_id', $countryId)
            ->whereNotNull('color')
            ->orderBy('id')
            ->first();

        if ($tournament && $tournament->color) {
            return $tournament->color;
        }

        // Если нет цвета в турнире, используем дефолтные цвета по ID страны (как на странице турниров)
        $defaultColors = [
            1 => '#7FFF00', // Россия (синий-белый-красный градиент, но используем цвет турнира)
            2 => '#7FFF00',
            3 => '#7FFF00',
            4 => '#7FFF00',
        ];

        return $defaultColors[$countryId] ?? '#7FFF00';
    }
}



