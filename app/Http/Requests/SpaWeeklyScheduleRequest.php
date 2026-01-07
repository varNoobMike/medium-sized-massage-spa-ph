<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SpaWeeklyScheduleRequest extends FormRequest
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
            'day_of_week' => 'required|string',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'break_time_start' => 'required|date_format:H:i|after:start_time|before:end_time',
            'break_time_end' => 'required|date_format:H:i|after:break_time_start|before:end_time',
        ];
    }
}
