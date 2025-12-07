<?php

namespace App\Http\Controllers\Site\Players;


class PlayersController
{
    public function players()
    {
        return view('site.v1.templates.players.players');
    }

    public function player()
    {
        return view('site.v1.templates.account.referrals');
    }

}
