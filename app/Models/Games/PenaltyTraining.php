<?php

namespace App\Models\Games;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PenaltyTraining extends Model
{
    use HasFactory;

    protected $table = 'game_penalty_training';

    protected $fillable = [
        'user_id',
        'player_choice',
        'goalkeeper_choice',
        'is_goal',
        'rating_earned',
        'duration_seconds',
        'ip_address',
        'user_agent',
    ];

    protected $casts = [
        'is_goal' => 'boolean',
        'rating_earned' => 'decimal:3',
        'duration_seconds' => 'integer',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

