<?php

namespace App\Repositories\Admin\Users;

use App\Models\User;
use App\Repositories\Repository;
use Illuminate\Support\Collection;

class UserRepository extends Repository
{
    public function getForShow(): Collection
    {
        return User::with('referredBy')
            ->orderBy('rating', 'desc')
            ->orderBy('goals', 'desc')
            ->orderBy('name')
            ->get();
    }

    public function find($id): User|null
    {
        return User::find($id);
    }

    public function findOrFail(int $id): User
    {
        return User::findOrFail($id);
    }
}

