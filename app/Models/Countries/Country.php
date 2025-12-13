<?php

namespace App\Models\Countries;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Country extends Model
{
    use HasFactory;

    protected $table = 'countries';

    protected $fillable = [
        'name',
        'code',
    ];

    public $timestamps = true;
}

