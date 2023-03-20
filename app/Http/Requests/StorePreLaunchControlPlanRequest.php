<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePreLaunchControlPlanRequest extends FormRequest
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
            "core_team" => 'required',
            "model_reference" => 'required',
            "supplier_plant_approval_date" => 'required',
            "customer_engineer_approval_date" => 'required',
            "other_approval_date" => 'required',
            "material_specification_norms" => 'required',
            "process_seq_no.*" => 'required',
            "tools_for_manufacturing.*" => 'required',
            "s_no.*" => 'required',
            "product.*" => 'required',
            "material_grade.*" => 'required',
            "special_character.*" => 'required',
            "process_specification.*" => 'required',
            "measurement_technique.*" => 'required',
            "size.*" => 'required',
            "frequency.*" => 'required',
            "control_method.*" => 'required',
            "responsiblity.*" => 'required',
            "reaction_plan.*" => 'required',

        ];
    }
}
