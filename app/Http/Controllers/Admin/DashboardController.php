<?php

namespace App\Http\Controllers\Admin;

final class DashboardController extends AdminController
{
    public function index()
    {
        return view('admin.dashboard');
    }
}
