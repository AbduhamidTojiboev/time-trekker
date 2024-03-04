<?php

namespace App\Models;

use App\Filters\Employee\EmployeeFilters;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Http\Request;

class Employee extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'middle_name',
        'birthdate',
    ];


    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'birthdate' => 'date',
    ];

    public function workLogs(): HasMany
    {
        return $this->hasMany(WorkLog::class, 'employee_id', 'id');
    }

    public function scopeFilter(Builder $query, Request|array $data, array $filters = [], array $removeFilters = []): Builder
    {
        return (new EmployeeFilters($data))->add($filters)->remove($removeFilters)->filter($query);
    }
}
