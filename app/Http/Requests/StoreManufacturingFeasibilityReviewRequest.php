<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreManufacturingFeasibilityReviewRequest extends FormRequest
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
            "grid_ref_no.*" => 'required',
            "initial_sample_layout_inspection.*" => 'required',
            "mass_production.*" => 'required',
            "pfd.*" => 'required',
            "specification_as_per_drawing.*" => 'required',
            "past_trouble.*" => 'required',
            "mass_production.*" => 'required',
            "feasibility_confirmation.*" => 'required',
            "cpk_cmk.*" => 'required',
            "remarks.*" => 'required',
        ];
    }
}
