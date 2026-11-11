<?php

namespace App\Http\Requests\Admin\Categorycolid;

use App\Helpers\TranslationHelper;
use Illuminate\Foundation\Http\FormRequest;

class CategorycolidRequest extends FormRequest
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
            'category_id' => 'required',
            
            
        ];
    }
    public function messages(): array
    {
        return [
            'name.required' => TranslationHelper::translate('Please Enter Name'),
            'category_id.required' => TranslationHelper::translate('Please Enter category_id'),
        ];
    }
}
