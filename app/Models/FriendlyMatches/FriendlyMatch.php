<?php

namespace App\Models\FriendlyMatches;

use App\Models\Teams\Team;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FriendlyMatch extends Model
{
    use HasFactory;

    protected $table = 'friendly_matches';
    
    protected $fillable = [
        'team_1',
        'team_2',
        'date',
        'score_1',
        'score_2',
        'status',
        'scorers',
        'assists',
        'squad',
    ];

    protected $casts = [
        'date' => 'datetime',
        'scorers' => 'array',
        'assists' => 'array',
        'squad' => 'array',
    ];

    public function homeTeam()
    {
        return $this->belongsTo(Team::class, 'team_1');
    }

    public function awayTeam()
    {
        return $this->belongsTo(Team::class, 'team_2');
    }

    public function isPlayed(): bool
    {
        return $this->status === 'played';
    }

    public function isScheduled(): bool
    {
        return $this->status === 'scheduled';
    }

    public function isCancelled(): bool
    {
        return $this->status === 'cancelled';
    }
}

