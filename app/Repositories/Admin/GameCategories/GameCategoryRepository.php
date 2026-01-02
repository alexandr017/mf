<?php

namespace App\Repositories\Admin\GameCategories;

use App\Models\GameCategories\GameCategory;
use App\Repositories\Repository;
use Illuminate\Support\Collection;

class GameCategoryRepository extends Repository
{
    public function getForShow(): Collection
    {
        return GameCategory::orderBy('order')->orderBy('name')->get();
    }

    public function find($id): GameCategory|null
    {
        return GameCategory::find($id);
    }

    public function findOrFail(int $id): GameCategory
    {
        return GameCategory::findOrFail($id);
    }
}




