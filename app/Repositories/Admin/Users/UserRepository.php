<?php

namespace App\Repositories\Admin\Users;

use App\Models\User;
use App\Repositories\Repository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class UserRepository extends Repository
{
    /**
     * Получить пользователей с пагинацией
     */
    public function getForShow(int $perPage = 50): LengthAwarePaginator
    {
        return User::orderBy('rating', 'desc')
            ->orderBy('goals', 'desc')
            ->orderBy('name')
            ->paginate($perPage);
    }

    /**
     * Получить всех пользователей (для случаев, когда нужны все записи)
     * Используйте с осторожностью на больших объемах данных
     */
    public function getAllForShow(): Collection
    {
        return User::orderBy('rating', 'desc')
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


