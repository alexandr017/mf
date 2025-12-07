<?php

namespace App\Http\Controllers\Site\Tournaments;

class TournamentsController
{
    public function index()
    {
        return view('site.v1.templates.tournaments.tournaments');
    }

    public function tournament(string $alias)
    {
        dd($alias);
    }
}
