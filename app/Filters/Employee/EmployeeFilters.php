<?php

namespace App\Filters\Employee;

use App\Filters\FiltersAbstract;

class EmployeeFilters extends FiltersAbstract
{
    protected array $filters = [
        'pattern' => PatternFilter::class,
        'ids' => IdsFilter::class,
        'employee_id' => EmployeeIdFilter::class,
        'first_name' => EmployeeFirstNameFilter::class,
        'last_name' => EmployeeLastNameFilter::class,
        'middle_name' => EmployeeMiddleNameFilter::class,
        'birthdate' => EmployeeBirthdateFilter::class,
    ];
}
