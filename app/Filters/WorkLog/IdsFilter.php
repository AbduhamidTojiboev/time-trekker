<?php

namespace App\Filters\WorkLog;

use App\Filters\FilterAbstract;
use Illuminate\Database\Eloquent\Builder;

class IdsFilter extends FilterAbstract
{
    public function filter(Builder $query, $value): Builder
    {
        $values = explode(',', $value);

        return $query->whereIn('work_logs.id', $values);
    }
}
