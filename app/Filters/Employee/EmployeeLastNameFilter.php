<?php

namespace App\Filters\Employee;

use App\Filters\FilterAbstract;
use Illuminate\Database\Eloquent\Builder;

class EmployeeLastNameFilter extends FilterAbstract
{
    public function filter(Builder $query, $value): Builder
    {
        return $query->where('last_name', $value);
    }
}
