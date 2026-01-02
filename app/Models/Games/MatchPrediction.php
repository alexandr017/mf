<?php

namespace App\Models\Games;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MatchPrediction extends Model
{
    use HasFactory;

    protected $table = 'game_match_predictions';

    protected $fillable = [
        'team_1_name',
        'team_2_name',
        'team_1_logo',
        'team_2_logo',
        'match_date',
        'score_1',
        'score_2',
        'status',
        'prediction_deadline',
        'description',
    ];

    protected $casts = [
        'match_date' => 'datetime',
        'prediction_deadline' => 'datetime',
        'score_1' => 'integer',
        'score_2' => 'integer',
    ];

    public function userPredictions()
    {
        return $this->hasMany(MatchPredictionUser::class, 'match_id');
    }

    public function isFinished(): bool
    {
        return $this->status === 'finished';
    }

    public function isScheduled(): bool
    {
        return $this->status === 'scheduled';
    }

    public function canPredict(): bool
    {
        return $this->isScheduled() && now() < $this->prediction_deadline;
    }

    public function getResult(): ?string
    {
        if (!$this->isFinished() || $this->score_1 === null || $this->score_2 === null) {
            return null;
        }

        if ($this->score_1 > $this->score_2) {
            return 'team_1';
        } elseif ($this->score_1 < $this->score_2) {
            return 'team_2';
        } else {
            return 'draw';
        }
    }
}

