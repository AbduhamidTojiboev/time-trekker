<?php

namespace App\Repositories;

use App\Contracts\Repositories\WorkLogRepositoryContract;
use App\Data\WorkLogData;
use App\Models\WorkLog;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class WorkLogRepository implements WorkLogRepositoryContract
{
    public function __construct(protected WorkLog $model)
    {

    }

    public function create(WorkLogData $workLogData): WorkLogData
    {
        return WorkLogData::from(WorkLog::create($workLogData->toArray()));
    }

    public function findByEmployeeId(int $employeeId): Collection
    {
        return WorkLogData::collect(WorkLog::query()->where(['employee_id' => $employeeId])->get());
    }

    public function findById(int $workLogId): WorkLogData
    {
        return WorkLogData::from(WorkLog::query()->find($workLogId));
    }

    public function update(int $workLogId, WorkLogData $workLogData): WorkLogData
    {
        return WorkLogData::from(
            WorkLog::query()
                ->find($workLogId)
                ->first()
                ->update($workLogData->toArray())
        );
    }

    public function getAll(array $columns = ['*']): Collection
    {
        return WorkLogData::collect(WorkLog::all());
    }

    public function paginate(Request $request, int $perPage = 30, array $columns = ['*']): LengthAwarePaginator
    {
        return $this->model->query()->filter($request)->paginate($perPage, $columns);
    }

    public function start(int $employeeId, \DateTime $start): string
    {
        $status = $this->model->newQuery()
            ->where(['employee_id' => $employeeId])
            ->whereNull('end_time')
            ->exists();
        $message = 'The tracker was previously running, first stop the tracker';

        if (!$status){
            $this->create(WorkLogData::from([
                'employee_id' => $employeeId,
                'start_time'  => $start,
                'date' => $start
            ]));
            $message = 'Successfully launched tracker';
        }

        return $message;
    }

    public function stop(int $employeeId, \DateTime $end): string
    {
        $model = $this->model->newQuery()
            ->where(['employee_id' => $employeeId])
            ->whereNull('end_time')
            ->first();
        $message = 'First, launch the tracker';

        if (isset($model)){
            $model->end_time = $end;
            $model->save();
            $message = 'Tracker stopped successfully';
        }
        return $message;
    }
}
