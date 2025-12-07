<?php

namespace App\Models\StaticPages;

use Illuminate\Database\Eloquent\Model;

class StaticPage extends Model
{
    protected $table = 'static_pages';

    protected $fillable = [
        'alias',
        'title',
        'meta_description',
        'h1',
        'content',
        'menu_content'
    ];

    public $timestamps = false;
}
