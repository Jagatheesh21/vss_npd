<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateScheduler extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'customer_id' => 'required',
            'part_number_id' => 'required',
            'apqp_timing_plan_id' => 'required',
            'stage_id.*' => 'required',
            'sub_stage_id.*' => 'required',
            'responsibility.*' => 'required',
            'process_time.*' => 'required',
        ];
    }
}
