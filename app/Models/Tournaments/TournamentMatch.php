<?php

namespace App\Models\Tournaments;

use Illuminate\Database\Eloquent\Model;
use App\Models\Teams\Team;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TournamentMatch extends Model
{
    use HasFactory;

    protected $table = 'tournaments_matches';
    protected $fillable = [
        'stage_id', 'group_id', 'team_1', 'team_2', 'date',
        'score_1', 'score_2', 'pen_1', 'pen_2', 'status',
        'stadium_id', 'referee', 'attendance', 'description', 'video_url', 'match_report'
    ];

    protected $casts = [
        'date' => 'datetime',
    ];

    public function stage()
    {
        return $this->belongsTo(TournamentStage::class, 'stage_id');
    }

    public function group()
    {
        return $this->belongsTo(TournamentGroup::class, 'group_id');
    }

    public function homeTeam()
    {
        return $this->belongsTo(Team::class, 'team_1');
    }

    public function awayTeam()
    {
        return $this->belongsTo(Team::class, 'team_2');
    }

    public function stadium()
    {
        return $this->belongsTo(Team::class, 'stadium_id');
    }

    public function events()
    {
        return $this->hasMany(\App\Models\MatchEvents\MatchEvent::class, 'match_id');
    }

    public function goals()
    {
        return $this->hasMany(\App\Models\MatchEvents\MatchEvent::class, 'match_id')->where('type', 'goal');
    }

    public function assists()
    {
        return $this->hasMany(\App\Models\MatchEvents\MatchEvent::class, 'match_id')->where('type', 'assist');
    }

}
