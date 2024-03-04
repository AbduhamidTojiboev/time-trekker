<?php

namespace App\Http\Resources\WorkLog;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class WorkLogListResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'employee_id'  => $this->employee_id,
            'start_time'  => $this->start_time,
            'end_time'  => $this->end_time,
        ];
    }
}
