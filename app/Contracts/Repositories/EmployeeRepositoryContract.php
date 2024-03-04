<?php

namespace App\Contracts\Repositories;

use App\Data\EmployeeData;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

interface EmployeeRepositoryContract
{
    public function create(EmployeeData $employeeData): EmployeeData;
    public function insert(array $data): void;
    public function getAll(array $columns = ['*']): Collection;
    public function findById(int $employeeId): EmployeeData;
    public function update(int $employeeId, EmployeeData $employeeData): EmployeeData;
    public function paginate(Request $request, int $perPage = 30, array $columns = ['*']): LengthAwarePaginator;
    public function paginateWorkLog(Request $request, int $perPage = 30, array $columns = ['*']): LengthAwarePaginator;
}
