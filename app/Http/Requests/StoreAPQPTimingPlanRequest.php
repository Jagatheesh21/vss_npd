<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAPQPTimingPlanRequest extends FormRequest
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
            'revision_number' => 'required',
            'revision_date' => 'required',
            'issuance_number' => 'required',
            'issuance_date' => 'required',
            'stage_id.*' => 'required',
            'sub_stage_id.*' => 'required',
            'status.*' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'customer_id.required' => 'Customer Name is Required.',
            'part_number_id.required' => 'Part Number is Required.',
        ];
    }
}
