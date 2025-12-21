<?php

namespace App\Repositories\Admin\Reports;

use App\Models\Reports\UserReport;
use App\Repositories\Repository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class ReportRepository extends Repository
{
    public function getForShow(int $perPage = 50): LengthAwarePaginator
    {
        return UserReport::with(['reportedUser', 'reporterUser', 'reviewer'])
            ->orderBy('created_at', 'desc')
            ->paginate($perPage);
    }

    public function find($id): UserReport|null
    {
        return UserReport::with(['reportedUser', 'reporterUser', 'reviewer'])->find($id);
    }

    public function findOrFail(int $id): UserReport
    {
        return UserReport::with(['reportedUser', 'reporterUser', 'reviewer'])->findOrFail($id);
    }
}

