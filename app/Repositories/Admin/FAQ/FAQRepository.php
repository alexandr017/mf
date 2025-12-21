<?php

namespace App\Repositories\Admin\FAQ;

use App\Models\FAQ\FAQ;
use App\Repositories\Repository;
use Illuminate\Support\Collection;

class FAQRepository extends Repository
{
    public function getForShow(): Collection
    {
        return FAQ::orderBy('order')
            ->orderBy('id')
            ->get();
    }

    public function find($id): FAQ|null
    {
        return FAQ::find($id);
    }

    public function findOrFail(int $id): FAQ
    {
        return FAQ::findOrFail($id);
    }
}




