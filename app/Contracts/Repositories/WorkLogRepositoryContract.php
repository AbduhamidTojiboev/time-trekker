<?php

namespace App\Contracts\Repositories;

use App\Data\WorkLogData;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

interface WorkLogRepositoryContract
{
    public function create(WorkLogData $workLogData): WorkLogData;
    public function getAll(array $columns = ['*']): Collection;
    public function findByEmployeeId(int $employeeId): Collection;
    public function findById(int $workLogId): WorkLogData;
    public function update(int $workLogId, WorkLogData $workLogData): WorkLogData;
    public function paginate(Request $request, int $perPage = 30, array $columns = ['*']): LengthAwarePaginator;
    public function start(int $employeeId, \DateTime $start): string;
    public function stop(int $employeeId, \DateTime $start): string;
}
