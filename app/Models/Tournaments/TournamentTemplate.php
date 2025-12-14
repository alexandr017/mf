<?php

namespace App\Models\Tournaments;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TournamentTemplate extends Model
{
    use HasFactory;

    protected $table = 'tournament_templates';

    protected $fillable = [
        'name',
        'type',
        'description',
        'structure_json',
        'config_json',
        'is_default'
    ];

    protected $casts = [
        'structure_json' => 'array',
        'config_json' => 'array',
        'is_default' => 'boolean',
    ];

    public function tournaments()
    {
        return $this->hasMany(Tournament::class, 'tournament_template_id');
    }
}


