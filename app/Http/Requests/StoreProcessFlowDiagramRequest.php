<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProcessFlowDiagramRequest extends FormRequest
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
            "process_identification" => 'required',
            "process_flow_number" => 'required',
            "process.*" => 'required',
            "process_name.*" => 'required',
            "incoming_source_of_variation.*" => 'required',
            "product_characteristics.*" => 'required',
            "process_characteristics.*" => 'required',
        ];
    }
}
