<?php

namespace App\Models\Teams;

use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Tournaments\TournamentMatch;

class Team extends Model
{
    protected $table = 'teams';

    protected $fillable = [
        'name',
        'alias',
        'stadium',
        'stadium_info',
        'description',
        'logo',
        'title',
        'h1',
        'meta_description',
        'country_id',
        'city_id',
        'date_created',
        'stadium_small_preview',
        'stadium_big_preview',
        'status'
    ];

    //use SoftDeletes;

    public $timestamps = false;

    public function homeMatches()
    {
        return $this->hasMany(TournamentMatch::class, 'team_1');
    }

    public function awayMatches()
    {
        return $this->hasMany(TournamentMatch::class, 'team_2');
    }
}
