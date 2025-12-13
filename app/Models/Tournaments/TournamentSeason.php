<?php

namespace App\Models\Tournaments;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TournamentSeason extends Model
{
    protected $table = 'tournaments_seasons';

    use HasFactory;
    protected $fillable = ['tournament_id', 'year_start', 'year_finish', 'status', 'rules_json'];

    protected $casts = [
        'rules_json' => 'array',
    ];

    public function tournament()
    {
        return $this->belongsTo(Tournament::class);
    }

    public function stages()
    {
        return $this->hasMany(TournamentStage::class, 'tournaments_season_id');
    }

    public function getMatchesCountAttribute(): int
    {
        return $this->stages->sum(function($stage) {
            return $stage->matches->count();
        });
    }
}
