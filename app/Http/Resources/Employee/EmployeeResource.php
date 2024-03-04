<?php

namespace App\Http\Resources\Employee;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EmployeeResource extends JsonResource
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
            'first_name'  => $this->first_name,
            'last_name'  => $this->last_name,
            'middle_name'  => $this->middle_name,
            'birthdate'  => $this->birthdate,
        ];
    }
}
