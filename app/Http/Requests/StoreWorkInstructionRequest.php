<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreWorkInstructionRequest extends FormRequest
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
            'apqp_timing_plan_id' => 'required|unique:work_instructions',
            'part_number_id' => 'required',
            'revision_number' => 'required',
            'revision_date' => 'required',
            'application' => 'required',
            'customer_id' => 'required',
            'product_description' => 'required',
            'reference_number.*' => 'required',
            'description.*' => 'required',
            'description.*' => 'required',
            'inspection_method.*' => 'required',
        ];
    }
}
