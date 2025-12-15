<?php

namespace App\Http\Controllers\Site\Index;

use App\Models\StaticPages\StaticPage;
use App\Repositories\Site\Blog\BlogRepository;

class IndexController
{
    public function index()
    {
        $page = StaticPage::where('alias', 'index')->first();
        $posts = (new BlogRepository)->list(3);

        if ($page == null) {
            abort(404);
        }

        return view('site.v1.templates.static-pages.index', compact('page', 'posts'));
    }
}
