<?php

namespace App\Models\TeamPlayers;

use App\Models\Teams\Team;
use App\Models\Tournaments\TournamentSeason;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class TeamPlayer extends Model
{
    protected $table = 'team_players';

    protected $fillable = [
        'team_id',
        'user_id',
        'season_id',
    ];

    public $timestamps = true;

    public function team()
    {
        return $this->belongsTo(Team::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function season()
    {
        return $this->belongsTo(TournamentSeason::class, 'season_id');
    }
}




