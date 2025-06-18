<?php

namespace App\Http\Controllers\Site;

class TeamsController
{
    public function teams()
    {
        dd('teams');
    }

    public function team(string $alias)
    {
        dd($alias);
    }
}
