<?php

namespace App\Repositories\Admin\News;

use App\Models\News\News;
use App\Repositories\Repository;
use Illuminate\Support\Collection;

class NewsRepository extends Repository
{
    public function getForShow(): Collection
    {
        return News::orderBy('created_at', 'desc')
            ->get();
    }

    public function find($id): News|null
    {
        return News::find($id);
    }

    public function findOrFail(int $id): News
    {
        return News::findOrFail($id);
    }

    public function getByAlias(string $alias): News|null
    {
        return News::where(['alias' => $alias])->first();
    }
}




