<?php

namespace App\Http\Controllers\Site\Ratings;

use App\Models\Teams\Team;

class RatingsController
{
    public function index()
    {
        $teams = Team::all();
        return view('site.v1.templates.ratings.ratings', compact('teams'));
    }
}
