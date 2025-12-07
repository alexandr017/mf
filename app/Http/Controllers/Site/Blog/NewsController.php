<?php

namespace App\Http\Controllers\Site\Blog;

use App\Repositories\Site\Blog\BlogRepository;

class NewsController
{
    public function list()
    {
        $posts = (new BlogRepository)->list();
        return view('site.v1.templates.blog.list', compact('posts'));
    }

    public function post()
    {
        $post = (new BlogRepository)->list();
        return view('site.v1.templates.blog.post', compact('post'));
    }
}
