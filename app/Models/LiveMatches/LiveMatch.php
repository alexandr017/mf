<?php

namespace App\Models\LiveMatches;

use App\Models\Tournaments\TournamentMatch;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LiveMatch extends Model
{
    use HasFactory;

    protected $table = 'live_matches';

    protected $fillable = [
        'match_id',
        'started_at',
        'ends_at',
        'status',
        'score_1',
        'score_2',
        'current_minute',
        'events',
        'players_positions',
        'result_saved',
    ];

    protected $casts = [
        'started_at' => 'datetime',
        'ends_at' => 'datetime',
        'events' => 'array',
        'players_positions' => 'array',
        'result_saved' => 'boolean',
    ];

    /**
     * Связь с основным матчем
     */
    public function match()
    {
        return $this->belongsTo(TournamentMatch::class, 'match_id');
    }

    /**
     * Проверка, идет ли матч сейчас
     */
    public function isLive(): bool
    {
        return $this->status === 'live' && now() >= $this->started_at && now() <= $this->ends_at;
    }

    /**
     * Проверка, завершен ли матч
     */
    public function isFinished(): bool
    {
        return $this->status === 'finished' || now() > $this->ends_at;
    }

    /**
     * Получить оставшееся время в секундах
     */
    public function getRemainingSeconds(): int
    {
        if ($this->isFinished()) {
            return 0;
        }
        return max(0, $this->ends_at->diffInSeconds(now()));
    }

    /**
     * Получить текущую минуту матча
     */
    public function getCurrentMinute(): int
    {
        if ($this->isFinished()) {
            return 15;
        }
        if (!$this->isLive()) {
            return 0;
        }
        // Вычисляем минуту на основе прошедшего времени
        $elapsed = now()->diffInSeconds($this->started_at);
        return min(15, (int)($elapsed / 60));
    }
}

