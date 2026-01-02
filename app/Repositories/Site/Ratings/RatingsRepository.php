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
            ->select(
                'teams.id',
                'teams.name',
                'teams.alias',
                'teams.logo',
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
            ->select(
                'teams.id',
                'teams.name',
                'teams.alias',
                'teams.logo',
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
                return $team;
            });
    }
}



