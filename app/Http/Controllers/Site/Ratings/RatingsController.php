<?php

namespace App\Http\Controllers\Site\Ratings;

use App\Repositories\Site\Ratings\RatingsRepository;

class RatingsController
{
    public function index()
    {
        $teams = (new RatingsRepository)->getAllTeams();
        $highlightPositions = false; // Для глобального рейтинга не выделяем цветом
        return view('site.v1.templates.ratings.ratings', compact('teams', 'highlightPositions'));
    }
}
