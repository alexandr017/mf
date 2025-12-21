<?php

namespace App\Models\Achievements;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Achievement extends Model
{
    use HasFactory;

    protected $table = 'achievements';

    protected $fillable = [
        'name',
        'description',
        'image',
    ];

    /**
     * Пользователи, получившие это достижение
     */
    public function users()
    {
        return $this->belongsToMany(\App\Models\User::class, 'user_achievements')
            ->withPivot('earned_at')
            ->withTimestamps();
    }
}




