<?php

namespace App\Http\Controllers\Auth;


class AuthController
{
    public function login()
    {
        return view('site.v1.templates.auth.login');
    }
}
