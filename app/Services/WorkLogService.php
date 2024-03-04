<?php

namespace App\Services;

use App\Contracts\Repositories\EmployeeRepositoryContract;
use App\Http\Requests\WorkLog\WorkLogFilterRequest;
use Illuminate\Pagination\LengthAwarePaginator;

class WorkLogService
{
    public function __construct(private EmployeeRepositoryContract $employeeRepository)
    {

    }

    public function report(WorkLogFilterRequest $request, int $perPage = 30): LengthAwarePaginator
    {
        $data = $this->employeeRepository->paginateWorkLog($request, $perPage);
        foreach ($data as $employee) {
            $resultMinutes = 0;
            foreach ($employee->workLogs as $workLog) {
                if (isset($workLog->end_time)){
                    $resultMinutes += $workLog->end_time->diffInMinutes($workLog->start_time);
                }else{
                    $resultMinutes += now()->diffInMinutes($workLog->start_time);
                }
            }
            $employee->work_hours = $this->convertMinutesToHoursAndMinutes($resultMinutes);
        }

        return $data;
    }
    private function convertMinutesToHoursAndMinutes(int $minutes): string
    {
        if ($minutes == 0){
            return 0;
        }
        $hours = floor($minutes / 60);
        $remainingMinutes = $minutes % 60;

        return sprintf('%02d:%02d', $hours, $remainingMinutes);
    }
}
