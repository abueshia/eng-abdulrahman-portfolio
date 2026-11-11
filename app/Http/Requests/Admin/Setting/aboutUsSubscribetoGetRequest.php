<?php

namespace App\Http\Requests\Admin\Setting;

use Illuminate\Foundation\Http\FormRequest;

class aboutUsSubscribetoGetRequest extends FormRequest
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

            'section_five_title_one.en' => 'required',
            'section_five_title_one.ar' => 'required',

            'section_five_description_one.en' => 'required',
            'section_five_description_one.ar' => 'required',

            'Subscribe_image'=> 'sometimes',

        ];
    }}
