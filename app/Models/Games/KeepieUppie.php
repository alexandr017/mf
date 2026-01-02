<?php

namespace App\Models\Games;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class KeepieUppie extends Model
{
    use HasFactory;

    protected $table = 'game_keepie_uppie';

    protected $fillable = [
        'user_id',
        'score',
        'duration_seconds',
        'rating_earned',
        'ip_address',
        'user_agent',
    ];

    protected $casts = [
        'score' => 'integer',
        'duration_seconds' => 'integer',
        'rating_earned' => 'decimal:3',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

