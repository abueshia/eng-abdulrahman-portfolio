<?php

namespace App\Http\Requests\Front\Auth;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'name'          =>'required|min:3',
            'manager_name'   => 'required|min:3',
            // 'manager_id'    =>'required',
             'email'         =>'required|email|unique:managers,email',
             'rate'          =>'required|min:1|numeric',
             'star'          =>'required|min:1|numeric|max:7',
             'address_ar'    =>'required|min:3',
             'address_en'    =>'required|min:3',
             'country_id'    =>'required|exists:countries,id',
             'city_id'       =>'required|exists:cities,id',
             'website'       =>'required',
             'postcode'      =>'required',
             'phone'         =>'required',
             'password'      =>'required|min:6'
        ];
    }
}
