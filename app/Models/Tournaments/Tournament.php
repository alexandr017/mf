<?php

namespace App\Models\Tournaments;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tournament extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 'country_id', 'title', 'alias', 'meta_description', 'image', 'type', 'content', 'status', 'h1', 'tournament_template_id'
    ];

    public function template()
    {
        return $this->belongsTo(TournamentTemplate::class, 'tournament_template_id');
    }

    public function seasons()
    {
        return $this->hasMany(TournamentSeason::class);
    }
}
