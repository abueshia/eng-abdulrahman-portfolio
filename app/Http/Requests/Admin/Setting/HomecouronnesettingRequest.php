<?php

namespace App\Http\Requests\Admin\Setting;

use Illuminate\Foundation\Http\FormRequest;

class HomecouronnesettingRequest extends FormRequest
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
            'title_header.en' => 'sometimes',
            'title_header.ar' => 'sometimes',

            'description_home.en' => 'sometimes',
            'description_home.ar' => 'sometimes',

            'image_one_home' => 'sometimes',

            'description_footer.en' => 'sometimes',
            'description_footer.ar' => 'sometimes',

            'image_logo' => 'sometimes',

            'file_one_home' => 'sometimes',

            
            
        
        ];
    }}
