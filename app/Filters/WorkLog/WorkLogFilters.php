<?php

namespace App\Filters\WorkLog;

use App\Filters\FiltersAbstract;

class WorkLogFilters extends FiltersAbstract
{
    protected array $filters = [
        'ids' => IdsFilter::class,
        'date_from' => WorkLogDateFromFilter::class,
        'date_to' => WorkLogDateToFilter::class,
        'employee_id' => WorkLogEmployeeIdFilter::class,
    ];
}
