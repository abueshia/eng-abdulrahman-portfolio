<?php

namespace App\Http\Requests\Admin\Setting;

use Illuminate\Foundation\Http\FormRequest;

class WhyChooseIndexRequest extends FormRequest
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
            'Your_gateway_to_title.en' => 'required',
            'Your_gateway_to_title.ar' => 'required',

            'We_have_been_description.en' => 'required',
            'We_have_been_description.ar' => 'required',


            'Et_purus_duis_description.en' => 'required',
            'Et_purus_duis_description.ar' => 'required',


            'Pricing_Plan_title.en' => 'required',
            'Pricing_Plan_title.ar' => 'required',

            'Traveling_opens_title.en' => 'required',
            'Traveling_opens_title.ar' => 'required',

            
            
        
        ];
    }}
