<?php

namespace App\Models\Cities;

use App\Models\Countries\Country;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class City extends Model
{
    protected $table = 'cities';

    protected $fillable = [
        'country_id',
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

    /**
     * Связь с страной
     */
    public function country()
    {
        return $this->belongsTo(Country::class);
    }
}
