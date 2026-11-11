<?php

namespace App\Http\Requests\Admin\Group;

use App\Helpers\TranslationHelper;
use Illuminate\Foundation\Http\FormRequest;

class GroupRequest extends FormRequest
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
            'name.ar' => 'required|max:255',
            'name.en' => 'required|max:255',
            'points' => 'nullable|integer|min:0',
            'validate_to' => 'nullable|date|after:today',
   
        ];
    }
    public function messages(): array
    {
        return [
            'name.ar.required' => TranslationHelper::translate('Please Enter Name in Arabic'),
            'name.en.required' => TranslationHelper::translate('Please Enter Name in English'),
        ];
    }
}
