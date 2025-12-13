<?php

namespace App\Models\Tournaments;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TournamentStage extends Model
{
    use HasFactory;

    protected $table = 'tournaments_stages';
    protected $fillable = ['tournaments_season_id', 'name', 'type', 'stage_order'];

    public function season()
    {
        return $this->belongsTo(TournamentSeason::class, 'tournaments_season_id');
    }

    public function groups()
    {
        return $this->hasMany(TournamentGroup::class, 'stage_id');
    }

    public function matches()
    {
        return $this->hasMany(TournamentMatch::class, 'stage_id');
    }
}
