<?php

namespace App\Models\Games;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Game extends Model
{
    use SoftDeletes;

    protected $table = 'games';

    protected $fillable = [
        'name',
        'description',
        'preview',
        'rules',
        'rating_points',
        'status',
        'order',
        'category_id',
    ];

    protected $casts = [
        'rating_points' => 'integer',
        'status' => 'boolean',
        'order' => 'integer',
    ];

    public $timestamps = true;

    public function category()
    {
        return $this->belongsTo(\App\Models\GameCategories\GameCategory::class);
    }
}

