<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCustomerSpecificRequirementRequest extends FormRequest
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
            'apqp_timing_plan_id' => 'required|unique:customer_specific_requirements',
            'stage_id' => 'required',
            'sub_stage_id' => 'required',
            'part_number_id' => 'required',
            'revision_number' => 'required',
            'revision_date' => 'required',
            'customer_id' => 'required',
            'application' => 'required',
            'manufacturing_requirements' => 'required',
            'handling_requirements' => 'required',
            'marking_requirements' => 'required',
            'packing_preservation' => 'required',
            'delivery_requirements' => 'required',
            'document_requirements' => 'required',
            ];
    }
}
