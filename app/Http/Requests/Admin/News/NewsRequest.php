<?php

namespace App\Http\Requests\Admin\News;

use App\Helpers\TranslationHelper;
use Illuminate\Foundation\Http\FormRequest;

class NewsRequest extends FormRequest
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
            'news_video' => 'required',
            'image' => 'nullable',
            // 'video' => 'nullable|mimes:mp4,avi,mov,wmv|max:10240',
            'title' => 'nullable',
            'des' => 'nullable',
          
        ];
    }
    public function messages(): array
    {
        return [

            'image.required' => TranslationHelper::translate('Please Upload Image'),
            'image.image' => TranslationHelper::translate('Image is Not Valid'),
            'image.mimes' => TranslationHelper::translate('Image Type is Not Valid'),
        ];
    }
}
