<?php

namespace App\Http\Controllers\Site\Account;


class AccountController
{
    public function index()
    {
        return view('site.v1.templates.account.index');
    }

    public function referrals()
    {
        return view('site.v1.templates.account.referrals');
    }
    public function games()
    {
        return view('site.v1.templates.account.games');
    }
    public function game($alias)
    {
        return view('site.v1.templates.account.game',compact('alias'));
    }
    public function options()
    {
        return view('site.v1.templates.account.options');
    }
    public function saveOptions()
    {
        $data = request()->all();

        return redirect('/account');
    }
}
