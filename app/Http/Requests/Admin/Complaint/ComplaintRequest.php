<?php

namespace App\Http\Requests\Admin\Complaint;

use App\Helpers\TranslationHelper;
use Illuminate\Foundation\Http\FormRequest;

class ComplaintRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'message' => 'required',

            


        ];
    }
    public function messages(): array
    {
        return [
            'title.ar.required' => TranslationHelper::translate('Please Enter Name in Arabic'),
            'title.en.required' => TranslationHelper::translate('Please Enter Name in English'),
            'description.ar.required' => TranslationHelper::translate('Please Enter Description in Arabic'),
            'description.en.required' => TranslationHelper::translate('Please Enter Description in English'),

    

        ];
    }
}
