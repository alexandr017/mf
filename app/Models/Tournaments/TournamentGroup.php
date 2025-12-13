<?php

namespace App\Models\Tournaments;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TournamentGroup extends Model
{
    use HasFactory;

    protected $table = 'tournaments_groups';
    protected $fillable = ['stage_id', 'name'];

    public function stage()
    {
        return $this->belongsTo(TournamentStage::class, 'stage_id');
    }

    public function matches()
    {
        return $this->hasMany(TournamentMatch::class, 'group_id');
    }
}
