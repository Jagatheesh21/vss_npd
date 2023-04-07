<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEnquiryRegisterRequest extends FormRequest
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
            'status_id' => 'required',
            'received_date' => 'required|date',
            'average_annum_demand' => 'required',
            'enquiry_document' => 'mimes:csv,txt,xlsx,xls,pdf,jpg,png,PNG|max:2048',
            'type_of_enquiry' => 'required'
        ];
    }
}
