<?php

namespace App\Http\Requests\Admin\Card;

use App\Helpers\TranslationHelper;
use Illuminate\Foundation\Http\FormRequest;

class CardRequest extends FormRequest
{
    /**
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
            'card_video' => 'nullable',
            'image' => 'required',
            'category_id' => 'required',
            // 'video' => 'nullable|mimes:mp4,avi,mov,wmv|max:10240',
            'title' => 'required',
            'des' => 'required',
            'categorycolid_id' => 'required',
          
        ];
    }
    public function messages(): array
    {
        return [

            'image.required' => TranslationHelper::translate('Please Upload Image'),
            'image.image' => TranslationHelper::translate('Image is Not Valid'),
            'image.mimes' => TranslationHelper::translate('Image Type is Not Valid'),

            'title.required' => TranslationHelper::translate('Please Upload title'),
             'des.required' => TranslationHelper::translate('Please Upload des'),
            'categorycolid_id.required' => TranslationHelper::translate('Please Upload categorycolid_id'),
            'category_id.required' => TranslationHelper::translate('Please Upload category_id'),
        ];
    }
}
