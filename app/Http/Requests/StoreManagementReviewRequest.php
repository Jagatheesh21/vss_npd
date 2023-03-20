<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreManagementReviewRequest extends FormRequest
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
            "meeting_number" => 'required',
            "meeting_date" => 'required',
            "meeting_attend_by" => 'required',
            "point_discuessed.*" => 'required',
            "responsibility.*" => 'required',
            "target_date.*" => 'required',
            // "actual_date.*" => 'required',
            "delay_reason.*" => 'required',
            "action_plan.*" => 'required',
            "revisied_target_date.*" => 'required',
            "review_comments.*" => 'required',
        ];
    }
}
