<?php

namespace App\Filters\WorkLog;

use App\Filters\FilterAbstract;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;

class WorkLogDateFromFilter extends FilterAbstract
{
    public function filter(Builder $query, $value): Builder
    {
        return $query->where(
            'date',
            '>=',
            $value
        );
    }
}
