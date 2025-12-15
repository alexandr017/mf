<?php

namespace App\Models\GameCategories;

use App\Models\Games\Game;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GameCategory extends Model
{
    use SoftDeletes;

    protected $table = 'game_categories';

    protected $fillable = [
        'name',
        'alias',
        'description',
        'order',
        'status',
    ];

    protected $casts = [
        'status' => 'boolean',
    ];

    public function games()
    {
        return $this->hasMany(Game::class);
    }
}

