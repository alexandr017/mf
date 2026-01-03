<?php

namespace App\Http\Controllers\Site\StaticPages;

use App\Models\StaticPages\StaticPage;
use Illuminate\Http\Request;

class StaticPagesController
{

    public function page()
    {
        $alias = \Request::path();
        $page = StaticPage::where('alias', $alias)->first();
        
        // Для страницы rules используем специальный шаблон
        if ($alias === 'rules' || $alias === 'game-rules') {
            return view('site.v1.templates.static-pages.game-rules', compact('page'));
        }
        
        if (!$page) {
            abort(404);
        }

        return view('site.v1.templates.static-pages.simple', compact('page'));
    }
}
