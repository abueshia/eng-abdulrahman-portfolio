<?php

namespace App\Http\Requests\Front\Dashboard;

use App\Helpers\TranslationHelper;
use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends FormRequest
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
            'l_name'          =>'required|min:2',
            'email'         =>'sometimes',
            'phone'         =>'required',
            'username'         =>'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => TranslationHelper::translate('Please Enter Your First Name', 'site'),
            'name.min' => TranslationHelper::translate('Please Enter Your First Name', 'site'),
            'l_name.required' => TranslationHelper::translate('Please Enter Your Last Name', 'site'),
            'l_name.min' => TranslationHelper::translate('Please Enter Your Last Name', 'site'),
            'phone.required' => TranslationHelper::translate('Please Enter Your Phone', 'site'),
            'username.required' => TranslationHelper::translate('Please Enter Your Username', 'site'),
            'username.unique' => TranslationHelper::translate('This Username is Already Been Taken', 'site'),

        ];
    }
}
