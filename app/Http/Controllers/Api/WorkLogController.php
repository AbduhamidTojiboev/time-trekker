<?php

namespace App\Http\Controllers\Api;

use App\Contracts\Repositories\WorkLogRepositoryContract;
use App\Http\Requests\WorkLog\WorkLogStopRequest;
use App\Http\Requests\WorkLog\WorkLogStartRequest;
use Illuminate\Http\JsonResponse;

class WorkLogController extends ApiBaseController
{
    public function __construct(protected WorkLogRepositoryContract $workLogRepository)
    {

    }

    public function start(WorkLogStartRequest $request): JsonResponse
    {
        $message = $this->workLogRepository->start($request->employee_id, now());

        return response()->json(['message' => $message]);
    }
    public function stop(WorkLogStopRequest $request): JsonResponse
    {
        $message = $this->workLogRepository->stop($request->employee_id, now());

        return response()->json(['message' => $message]);
    }
}
