<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProcessDesignGoalRequest extends FormRequest
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
            "apqp_timing_plan_id" => 'required',
            "part_number_id" => 'required',
            "revision_number" => 'required',
            "revision_date" => 'required',
            "application" => 'required',
            "customer_id" => 'required',
            "product_description" => 'required',
            "process_description.*" => 'required',
            "target_cost.*" => 'required',
            "target_quality.*" => 'required',
            "target_output.*" => 'required',
            "target_cpk.*" => 'required',
            "actual_cost.*" => 'required',
            "actual_quality.*" => 'required',
            "actual_output.*" => 'required',
            "actual_cpk.*" => 'required',
        ];
    }
}
