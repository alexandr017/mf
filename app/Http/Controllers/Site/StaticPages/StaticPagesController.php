<?php

namespace App\Http\Controllers\Site\StaticPages;

use App\Models\StaticPages\StaticPage;
use Illuminate\Http\Request;

class StaticPagesController
{

    public function page()
    {
        $page = StaticPage::where('alias', \Request::path())->first();
        if (!$page) {
            abort(404);
        }

        return view('site.v1.templates.static-pages.simple', compact('page'));
    }
}
