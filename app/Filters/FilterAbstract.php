<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;

abstract class FilterAbstract
{
    public static $field;

    abstract public function filter(Builder $query, $value);

    public function mappings(): array
    {
        return [];
    }

    protected function resolveFilterValue($key)
    {
        return Arr::get($this->mappings, $key);
    }
}
