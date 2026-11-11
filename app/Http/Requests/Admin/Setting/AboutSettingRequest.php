<?php

namespace App\Http\Requests\Admin\Setting;

use Illuminate\Foundation\Http\FormRequest;

class AboutSettingRequest extends FormRequest
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
            'section_one_title_one.en' => 'required',
            'section_one_title_one.ar' => 'required',

            'section_one_description.en' => 'required',
            'section_one_description.ar' => 'required',

            'section_one_title_two.en' => 'required',
            'section_one_title_two.ar' => 'required',

            'section_one_title_three.en' => 'required',
            'section_one_title_three.ar' => 'required',

            'section_one_title_four.en' => 'required',
            'section_one_title_four.ar' => 'required',


            'section_one_number.en' => 'required',
            'section_one_number.ar' => 'required',

            'section_one_image_one' => 'sometimes',
            
            'section_one_image_two' => 'sometimes',
            
            // section __tow
            'section_tow_title_one.en' => 'required',
            'section_tow_title_one.ar' => 'required',

            'section_tow_description_one.en' => 'required',
            'section_tow_description_one.ar' => 'required',
            
            
        
        ];
    }}
