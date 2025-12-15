<?php

namespace App\Models\Transactions;

use App\Models\Games\Game;
use App\Models\Tournaments\TournamentMatch;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $table = 'transactions';

    protected $fillable = [
        'user_id',
        'game_id',
        'match_id',
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

    public function match()
    {
        return $this->belongsTo(TournamentMatch::class, 'match_id');
    }
}

