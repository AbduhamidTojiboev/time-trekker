<?php

namespace App\Http\Requests\WorkLog;

use Illuminate\Foundation\Http\FormRequest;

class WorkLogFilterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'employee_id' => 'nullable|int',
            'date_from' => 'required_with:date_to|nullable|date|date_format:Y-m-d',
            'date_to' => 'required_with:date_from|nullable|date|date_format:Y-m-d|after_or_equal:date_from'
        ];
    }
}
