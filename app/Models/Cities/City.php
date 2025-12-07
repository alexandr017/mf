<?php

namespace App\Models\Cities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class City extends Model
{
    protected $table = 'cities';

    protected $fillable = [
        'name',
        'ip',
        'rp',
        'dp',
        'vp',
        'tp',
        'mp',
    ];

    use SoftDeletes;

    public $timestamps = false;
}
