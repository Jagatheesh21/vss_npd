<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAPQPPLanActivityRequest extends FormRequest
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
            'plan_start_date.*' => 'required',
            'plan_end_date.*' => 'required',
            'responsibility.*' => 'required',
            'verified_by.*' => 'required',
            'approved_by.*' => 'required',

        ];
    }
}
