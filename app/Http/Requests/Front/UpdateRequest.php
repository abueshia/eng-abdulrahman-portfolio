<?php

namespace App\Http\Requests\Front;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
            'name'         =>'required|min:2',
            'email'        =>'required|email|unique:hotels,email,'.request('hotel')->id,
            'phone'        =>'required',
            'star'         =>'required',
            'start_date'   =>'required|after_or_equal:today',
            'end_date'     =>'required|after_or_equal:start_date',
            'address_ar'   =>'required',
            'address_en'   =>'required',
            'country'   =>'required|exists:countries,id',
            'city'      =>'required|exists:cities,id',
            'availability_status'           =>'nullable',
            'website'                       =>'nullable',
            'postcode'                      =>'nullable',
            'description_condition_ar'      =>'nullable',
            'description_condition_en'      =>'nullable',
            'description_policy_ar'         =>'nullable',
            'description_policy_en'         =>'nullable',
            'description_children_age_ar'   =>'nullable',
            'description_children_age_en'   =>'nullable',
            'main_image'              =>'nullable|mimes:png,jpg,jpeg,gif'
        ];
    }
}
