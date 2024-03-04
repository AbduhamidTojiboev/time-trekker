<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

abstract class FiltersAbstract
{
    protected ?Request $request = null;
    protected array $data;

    protected array $filters = [];

    public function __construct(Request|array $data = [])
    {
        if (is_array($data)) {
            $this->data = $data;
            return;
        }

        $this->request = $data;
        $this->data = $data->all();
    }

    public function filter(Builder $query): Builder
    {
        $this->filterFilters($this->filters)
            ->each(fn($value, $filter) => $this->resolveFilter($filter)->filter($query, $value));

        return $query;
    }

    public function getFilters(): array
    {
        return $this->filterFilters($this->filters)->toArray();
    }

    protected function filterFilters($filters): Collection
    {
        return collect($this->data)
            ->only(array_keys($filters))
            ->mapWithKeys(
                function ($value, $key) {
                    if (is_null($value)) {
                        return [$key => null];
                    }
                    return [
                        $key => is_numeric($value)
                            ? (($value == (int) $value) ? (int) $value : (float) $value)
                            : $value
                    ];
                }
            )->filter(fn($item) => $item !== null && $item !== '');
    }

    protected function resolveFilter($filter)
    {
        $classExplode = explode('|', $this->filters[$filter]);
        $className = $classExplode[0];
        $classDatabaseKey = $classExplode[1] ?? null;
        $filterClass = new $className;

        if ($classDatabaseKey && $filterClass instanceof ValueFilter) {
            return $filterClass->setDatabaseKey($classDatabaseKey);
        }

        return $filterClass;
    }

    public function add(array $filters): FiltersAbstract
    {
        $this->filters = array_merge($this->filters, $filters);

        return $this;
    }

    public function remove(array $filters): FiltersAbstract
    {
        if (!empty($filters)) {
            foreach ($filters as $filter) {
                if (isset($this->filters[$filter])) {
                    unset($this->filters[$filter]);
                }
            }
        }

        return $this;
    }

    public function only(array $filters): FiltersAbstract
    {
        if (!empty($filters)) {
            foreach ($this->filters as $keyFilter => $basFilter) {
                if (!in_array($keyFilter, $filters)) {
                    unset($this->filters[$keyFilter]);
                }
            }
        }

        return $this;
    }
}
