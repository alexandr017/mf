<?php

namespace App\Models\Notifications;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Notification extends Model
{
    use HasFactory;

    protected $table = 'notifications';

    protected $fillable = [
        'type',
        'title',
        'message',
        'data',
        'created_by_user_id',
        'is_mass',
        'scheduled_at',
    ];

    protected $casts = [
        'data' => 'array',
        'is_mass' => 'boolean',
        'scheduled_at' => 'datetime',
    ];

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by_user_id');
    }

    public function userNotifications()
    {
        return $this->hasMany(UserNotification::class);
    }
}

