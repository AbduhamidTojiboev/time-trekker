<?php

namespace App\Filters\WorkLog;

use App\Filters\FilterAbstract;
use Illuminate\Database\Eloquent\Builder;

class WorkLogEmployeeIdFilter extends FilterAbstract
{
    public function filter(Builder $query, $value): Builder
    {
        return $query->where('employee_id', $value);
    }
}
