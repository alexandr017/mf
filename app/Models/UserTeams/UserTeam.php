<?php

namespace App\Models\UserTeams;

use App\Models\Teams\Team;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class UserTeam extends Model
{
    protected $table = 'user_teams';

    protected $fillable = [
        'user_id',
        'team_id',
        'season', // Год сезона
    ];

    public $timestamps = true;

    protected $casts = [
        'season' => 'integer',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function team()
    {
        return $this->belongsTo(Team::class);
    }
}

