<?php

namespace App\Models\FAQ;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FAQ extends Model
{
    use HasFactory;

    protected $table = 'faq';

    protected $fillable = [
        'question',
        'answer',
        'order',
        'status',
    ];

    protected $casts = [
        'status' => 'boolean',
    ];
}


