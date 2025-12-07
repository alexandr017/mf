<?php

namespace App\Models\Teams;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Team extends Model
{
    protected $table = 'teams';

    protected $fillable = [
        'name',
        'alias',
        'stadium',
        'stadium_info',
        'description',
        'logo',
        'title',
        'meta_description',
        'country_id',
        'city_id',
        'date_created',
        'stadium_small_preview',
        'stadium_big_preview',
        'status'
    ];

    use SoftDeletes;

    public $timestamps = false;
}
