<?php

namespace App\Models\UserTeams;

use App\Models\Teams\Team;
use App\Models\Tournaments\TournamentSeason;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class UserTeam extends Model
{
    protected $table = 'user_teams';

    protected $fillable = [
        'user_id',
        'team_id',
        'season_id',
    ];

    public $timestamps = true;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function team()
    {
        return $this->belongsTo(Team::class);
    }

    public function season()
    {
        return $this->belongsTo(TournamentSeason::class, 'season_id');
    }
}

