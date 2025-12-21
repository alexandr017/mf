<?php

namespace App\Repositories\Admin\Countries;

use App\Models\Countries\Country;
use App\Repositories\Repository;
use Illuminate\Support\Collection;

class CountryRepository extends Repository
{
    public function getForShow(): Collection
    {
        return Country::orderBy('name')
            ->get();
    }

    public function find($id): Country|null
    {
        return Country::find($id);
    }

    public function findOrFail(int $id): Country
    {
        return Country::findOrFail($id);
    }
}




