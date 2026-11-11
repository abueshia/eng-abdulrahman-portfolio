<?php

namespace App\Http\Requests\Admin\Setting;

use Illuminate\Foundation\Http\FormRequest;

class aboutUsClientsSayRequest extends FormRequest
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
            // section __three

            'section_three_title.en' => 'required',
            'section_three_title.ar' => 'required',

            'section_three_description.en' => 'required',
            'section_three_description.ar' => 'required',


            
        
        ];
    }}
