<?php

namespace App\Repositories;

use App\Contracts\Repositories\EmployeeRepositoryContract;
use App\Data\EmployeeData;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class EmployeeRepository implements EmployeeRepositoryContract
{
    public function __construct(protected Employee $model)
    {

    }
    public function create(EmployeeData $employeeData): EmployeeData
    {
        return EmployeeData::from($this->model->query()->create($employeeData->toArray()));
    }

    public function getAll(array $columns = ['*']): Collection
    {
        return EmployeeData::collect($this->model->query()->get($columns));
    }

    public function findById(int $employeeId): EmployeeData
    {
        return EmployeeData::from($this->model->query()->find($employeeId));
    }

    public function update(int $employeeId, EmployeeData $employeeData): EmployeeData
    {
        return EmployeeData::from(
            $this->model->query()
                ->find($employeeId)
                ->first()
                ->update($employeeData->toArray())
        );
    }

    public function paginate(Request $request, int $perPage = 30, array $columns = ['*']): LengthAwarePaginator
    {
        return $this->model->query()->filter($request)->paginate($perPage, $columns);
    }

    public function insert(array $data): void
    {
        $chunkData = array_chunk($data, 30);
        foreach ($chunkData as $item) {
            $this->model->newQuery()->insert($item);
        }
    }

    public function paginateWorkLog(Request $request, int $perPage = 30, array $columns = ['*']): LengthAwarePaginator
    {
        return $this->model->newQuery()->with(['workLogs' => function($query) use($request){
            $query->filter($request);
        }])->filter($request)->paginate($perPage, $columns);
    }
}
