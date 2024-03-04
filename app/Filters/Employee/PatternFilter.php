<?php

namespace App\Filters\Employee;

use App\Filters\FilterAbstract;
use Illuminate\Database\Eloquent\Builder;

class PatternFilter extends FilterAbstract
{
    public function filter(Builder $query, $value): Builder
    {
        return $query
            ->where(function (Builder $q) use ($value) {
                return $q
                    ->where('first_name', 'ilike', "%".mb_strtolower($value)."%")
                    ->orWhere('last_name', 'ilike', "%".mb_strtolower($value)."%")
                    ->orWhere('middle_name', 'ilike', "%".mb_strtolower($value)."%");
            });
    }
}
