<?php

namespace App\Http\Requests\Admin\Gallery;

use App\Helpers\TranslationHelper;
use Illuminate\Foundation\Http\FormRequest;

class GalleryRequest extends FormRequest
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
            'image' => 'required_without:id|image|mimes:png,jpg,jpeg,webp|nullable',
            // 'categorygallery_id'=>'required',

        ];
    }
    public function messages(): array
    {
        return [
            'image.required_without' => TranslationHelper::translate('Please Upload Image'),
            'image.image' => TranslationHelper::translate('Image is Not Valid'),
            'image.mimes' => TranslationHelper::translate('Image Type is Not Valid'),
            // 'categorygallery_id.required' => TranslationHelper::translate('Please Choose Category'),

           
        ];
    }
}
