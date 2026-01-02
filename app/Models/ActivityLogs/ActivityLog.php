<?php

namespace App\Models\ActivityLogs;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class ActivityLog extends Model
{
    protected $table = 'activity_logs';

    protected $fillable = [
        'user_id',
        'action',
        'model_type',
        'model_id',
        'changes',
        'ip_address',
        'user_agent',
        'description',
    ];

    protected $casts = [
        'changes' => 'array',
    ];

    public $timestamps = true;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function model()
    {
        return $this->morphTo();
    }
}




