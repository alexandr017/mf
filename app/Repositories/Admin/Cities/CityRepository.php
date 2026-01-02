<?php

namespace App\Repositories\Admin\Cities;

use App\Models\Cities\City;
use App\Repositories\Repository;
use Illuminate\Support\Collection;

class CityRepository extends Repository
{
    public function getForShow(): Collection
    {
        return City::orderBy('name')
            ->get();
    }

    public function find($id): City|null
    {
        return City::find($id);
    }

    public function findOrFail(int $id): City
    {
        return City::findOrFail($id);
    }
}





