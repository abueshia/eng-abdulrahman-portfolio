<?php

namespace App\Http\Requests\Admin\Setting;

use Illuminate\Foundation\Http\FormRequest;

class FindBestPlacesIndexRequest extends FormRequest
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
            'Find_best_places_title.en' => 'required',
            'Find_best_places_title.ar' => 'required',

            'Whether_you’re_looking_description.en' => 'required',
            'Whether_you’re_looking_description.ar' => 'required',

            'ourney_Beyond_title.en' => 'required',
            'ourney_Beyond_title.ar' => 'required',

            'We_have_been_operating_description.en' => 'required',
            'We_have_been_operating_description.ar' => 'required',


            'ourney_Beyond_image' => 'sometimes',



       
            
            
        
        ];
    }}
