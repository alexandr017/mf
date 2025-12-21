<?php

namespace App\Models\MatchEvents;

use App\Models\Tournaments\TournamentMatch;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class MatchEvent extends Model
{
    protected $table = 'match_events';

    protected $fillable = [
        'match_id',
        'user_id',
        'type',
        'minute',
        'description',
    ];

    protected $casts = [
        'minute' => 'integer',
    ];

    public $timestamps = true;

    public function match()
    {
        return $this->belongsTo(TournamentMatch::class, 'match_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}



