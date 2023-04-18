<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSirApprovalRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
<<<<<<< HEAD
        return false;
=======
        return true;
>>>>>>> 6effb6f30f1247ca2f8a711aad43bb1d1ea9ff99
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
<<<<<<< HEAD
            //
=======
            'apqp_timing_plan_id' => 'required|unique:sir_approvals',
            'part_number_id' => 'required',
            'revision_number' => 'required',
            'revision_date' => 'required',
            'application' => 'required',
            'customer_id' => 'required',
            'product_description' => 'required',
            'stage_id' => 'required',
            'sub_stage_id' => 'required',
            'file' => 'required',
            'remarks' => 'required'
>>>>>>> 6effb6f30f1247ca2f8a711aad43bb1d1ea9ff99
        ];
    }
}
