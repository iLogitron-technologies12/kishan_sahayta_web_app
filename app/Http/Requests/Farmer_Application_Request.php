<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Farmer_Application_Request extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name_of_beneficiary' => 'required',
                'name_of_beneficiary_father_or_husband' => 'required',
                'gp_vc' => 'required',
                'block' => 'required',
                'sub_division' => 'required',
                'district' => 'required',
                'pin_code' => 'required',
                'mobile_no' => 'required|size:10,unique:farmer_applications',
                'ration_no' => 'required|unique:farmer_applications',
                'ration_no' => 'required|size:12',
                'bank_name' => 'required',
                'branch_name' => 'required',
                'account_number' => 'required|between:5,20',
                'ifsc_code' => 'required|size:11',
                'area_in_hectares' => 'required',
                'amount_in_rupees' => 'required',
        ];
    }
}
