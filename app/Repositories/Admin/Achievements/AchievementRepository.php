<?php

namespace App\Repositories\Admin\Achievements;

use App\Models\Achievements\Achievement;
use App\Repositories\Repository;
use Illuminate\Support\Collection;

class AchievementRepository extends Repository
{
    public function getForShow(): Collection
    {
        return Achievement::withCount('users')
            ->orderBy('name')
            ->get();
    }

    public function find($id): Achievement|null
    {
        return Achievement::find($id);
    }

    public function findOrFail(int $id): Achievement
    {
        return Achievement::findOrFail($id);
    }
}

