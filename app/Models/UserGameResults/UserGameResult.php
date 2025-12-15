<?php

namespace App\Models\UserGameResults;

use App\Models\Games\Game;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class UserGameResult extends Model
{
    protected $table = 'user_game_results';

    protected $fillable = [
        'user_id',
        'game_id',
        'score',
        'rating_points_earned',
        'win',
        'played_at',
    ];

    protected $casts = [
        'score' => 'integer',
        'rating_points_earned' => 'integer',
        'win' => 'boolean',
        'played_at' => 'datetime',
    ];

    public $timestamps = true;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function game()
    {
        return $this->belongsTo(Game::class);
    }
}

