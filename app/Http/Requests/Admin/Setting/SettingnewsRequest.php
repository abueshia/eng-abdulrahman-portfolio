<?php

namespace App\Http\Requests\Admin\Setting;

use Illuminate\Foundation\Http\FormRequest;

class SettingnewsRequest extends FormRequest
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

            // section __one
            'title.en' => 'required',
            'title.ar' => 'required',

            'title_tow.en' => 'required',
            'title_tow.ar' => 'required',

            'description.en' => 'required',
            'description.ar' => 'required',

            'image_one_news' => 'sometimes',
            
            // 'image_tow' => 'sometimes',
           
            
        
        ];
    }}
