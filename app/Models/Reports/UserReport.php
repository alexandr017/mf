<?php

namespace App\Models\Reports;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserReport extends Model
{
    use HasFactory;

    protected $table = 'user_reports';

    protected $fillable = [
        'reported_user_id',
        'reporter_user_id',
        'reporter_email',
        'reporter_ip',
        'category_id',
        'description',
        'status',
        'admin_notes',
        'reviewed_by',
        'reviewed_at',
    ];

    protected $casts = [
        'reviewed_at' => 'datetime',
    ];

    /**
     * Пользователь, на которого пожаловались
     */
    public function reportedUser()
    {
        return $this->belongsTo(User::class, 'reported_user_id');
    }

    /**
     * Пользователь, который подал жалобу (если зарегистрирован)
     */
    public function reporterUser()
    {
        return $this->belongsTo(User::class, 'reporter_user_id');
    }

    /**
     * Администратор, который рассмотрел жалобу
     */
    public function reviewer()
    {
        return $this->belongsTo(User::class, 'reviewed_by');
    }

    /**
     * Получить название категории
     */
    public function getCategoryNameAttribute(): string
    {
        return ReportCategory::getName($this->category_id) ?? 'Неизвестная категория';
    }

    /**
     * Проверка, является ли жалоба от зарегистрированного пользователя
     */
    public function isFromRegisteredUser(): bool
    {
        return $this->reporter_user_id !== null;
    }
}

