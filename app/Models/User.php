<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'goals',
        'assists',
        'rating',
        'referral_code',
        'referred_by_id',
        'referrals_count',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'rating' => 'decimal:2',
        ];
    }

    /**
     * Пользователь, который пригласил этого пользователя
     */
    public function referredBy()
    {
        return $this->belongsTo(User::class, 'referred_by_id');
    }

    /**
     * Пользователи, приглашенные этим пользователем
     */
    public function referrals()
    {
        return $this->hasMany(User::class, 'referred_by_id');
    }

    /**
     * Достижения пользователя
     */
    public function achievements()
    {
        return $this->belongsToMany(\App\Models\Achievements\Achievement::class, 'user_achievements')
            ->withPivot('earned_at')
            ->withTimestamps();
    }

    /**
     * Результаты игр пользователя
     */
    public function gameResults()
    {
        return $this->hasMany(\App\Models\UserGameResults\UserGameResult::class);
    }

    /**
     * Транзакции пользователя
     */
    public function ratingHistory()
    {
        return $this->hasMany(\App\Models\RatingHistory\RatingHistory::class);
    }
    
    // Оставляем для обратной совместимости, если где-то используется
    public function transactions()
    {
        return $this->ratingHistory();
    }

    /**
     * События матчей пользователя
     */
    public function matchEvents()
    {
        return $this->hasMany(\App\Models\MatchEvents\MatchEvent::class);
    }

    /**
     * Команды пользователя
     */
    public function teams()
    {
        return $this->belongsToMany(\App\Models\Teams\Team::class, 'team_players')
            ->withPivot('season_id')
            ->withTimestamps();
    }

    /**
     * Тикеты, созданные пользователем
     */
    public function createdTickets()
    {
        return $this->hasMany(\App\Models\Tickets\Ticket::class, 'created_by_user_id');
    }

    /**
     * Тикеты, назначенные пользователю
     */
    public function assignedTickets()
    {
        return $this->hasMany(\App\Models\Tickets\Ticket::class, 'assigned_to_user_id');
    }

    /**
     * Сообщения в тикетах
     */
    public function ticketMessages()
    {
        return $this->hasMany(\App\Models\Tickets\TicketMessage::class);
    }

    /**
     * Логи активности пользователя
     */
    public function activityLogs()
    {
        return $this->hasMany(\App\Models\ActivityLogs\ActivityLog::class);
    }

    /**
     * Аккаунты соцсетей пользователя
     */
    public function socialAccounts()
    {
        return $this->hasMany(SocialAccount::class);
    }
}
