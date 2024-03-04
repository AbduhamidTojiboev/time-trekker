<?php

namespace App\Providers;

use App\Contracts\Repositories\EmployeeRepositoryContract;
use App\Contracts\Repositories\WorkLogRepositoryContract;
use App\Imports\Csv\ImportEmployee;
use App\Repositories\EmployeeRepository;
use App\Repositories\WorkLogRepository;
use App\Services\WorkLogService;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->registerBindRepositories();
        $this->app->bind(ImportEmployee::class);
        $this->app->bind(WorkLogService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrap();
    }


    public function registerBindRepositories()
    {
        $this->app->bind(EmployeeRepositoryContract::class, EmployeeRepository::class);
        $this->app->bind(WorkLogRepositoryContract::class, WorkLogRepository::class);
    }
}
