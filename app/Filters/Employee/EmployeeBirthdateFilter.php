<?php

namespace App\Filters\Employee;

use App\Filters\FilterAbstract;
use Illuminate\Database\Eloquent\Builder;

class EmployeeBirthdateFilter extends FilterAbstract
{
    public function filter(Builder $query, $value): Builder
    {
        return $query->where('birthdate', $value);
    }
}
