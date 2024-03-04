<?php

namespace App\Http\Controllers;

use App\Http\Requests\WorkLog\WorkLogFilterRequest;
use App\Services\WorkLogService;
use Carbon\Carbon;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class WorkLogController extends BaseController
{
    public function __construct(protected WorkLogService $workLogService)
    {

    }

    public function index(WorkLogFilterRequest $request): Factory|View
    {
        $dateFrom = empty($request->date_from) ? now()->subWeek()->startOfDay() : Carbon::make($request->date_from)->startOfDay();
        $dateTo = empty($request->date_to) ? now()->endOfDay() : Carbon::make($request->date_to)->endOfDay();
        $request->merge(['date_from' => $dateFrom, 'date_to' => $dateTo]);
        $data = $this->workLogService->report($request, 30);
        $dateFrom = $dateFrom->format('Y-m-d');
        $dateTo = $dateTo->format('Y-m-d');

        return view('work-log.index', compact('data', 'dateFrom', 'dateTo'));
    }
}
