<?php

namespace App\Repositories\Admin\StaticPages;

use App\Models\StaticPages\StaticPage;
use App\Repositories\Repository;
use Illuminate\Support\Collection;

class StaticPageRepository extends Repository
{
    public function getForShow(): Collection
    {
        return StaticPage::orderBy('id', 'desc')
            ->get();
    }

    public function find($id): StaticPage|null
    {
        return StaticPage::find($id);
    }

    public function findOrFail(int $id): StaticPage
    {
        return StaticPage::findOrFail($id);
    }

    public function getByAlias(string $alias): StaticPage|null
    {
        return StaticPage::where(['alias' => $alias])->first();
    }
}