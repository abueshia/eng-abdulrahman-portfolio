<?php

namespace App\Http\Requests\Front\Auth;

use App\Helpers\TranslationHelper;
use Illuminate\Foundation\Http\FormRequest;

class RegisterSubmitRequest extends FormRequest
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
            'name'          =>'required|min:2',
            'l_name'          => 'required|min:2',
            'email'         => 'required',
            'phone'         =>'required|unique:users,phone',
            'username'         =>'required|unique:users,username',
            'password'      =>'required|min:6'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => TranslationHelper::translate('Please Enter Your First Name'),
            'name.min' => TranslationHelper::translate('Please Enter Your First Name'),
            'email.required' => TranslationHelper::translate('Please Enter Your First email'),
            'email.unique' => TranslationHelper::translate('Please Enter Your First email'),
            'l_name.required' => TranslationHelper::translate('Please Enter Your Last Name'),
            'l_name.min' => TranslationHelper::translate('Please Enter Your Last Name'),
            'phone.required' => TranslationHelper::translate('Please Enter Your Phone',),
            'phone.unique' => TranslationHelper::translate('This Phone is Already in Use',),
            'username.required' => TranslationHelper::translate('Please Enter Your Username'),
            'username.unique' => TranslationHelper::translate('This Username is Already Been Taken'),
            'password.required' => TranslationHelper::translate('Please Enter Your Password'),
            'password.min' => TranslationHelper::translate('Password Must Be More Than 6 Digits'),


        ];
    }
}
