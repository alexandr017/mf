<?php

namespace App\Models\RatingHistory;

use App\Models\Games\Game;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class RatingHistory extends Model
{
    protected $table = 'rating_history';

    protected $fillable = [
        'user_id',
        'game_id',
        'points',
        'type',
        'description',
        'details',
    ];

    protected $casts = [
        'points' => 'integer',
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


