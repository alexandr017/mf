<?php

namespace App\Models\Games;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MatchPredictionUser extends Model
{
    use HasFactory;

    protected $table = 'game_match_predictions_users';

    protected $fillable = [
        'user_id',
        'match_id',
        'prediction',
        'is_correct',
        'rating_earned',
    ];

    protected $casts = [
        'is_correct' => 'boolean',
        'rating_earned' => 'decimal:3',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function match()
    {
        return $this->belongsTo(MatchPrediction::class, 'match_id');
    }
}

