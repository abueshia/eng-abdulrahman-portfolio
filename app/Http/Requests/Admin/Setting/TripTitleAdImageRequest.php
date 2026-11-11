<?php

namespace App\Http\Requests\Admin\Setting;

use Illuminate\Foundation\Http\FormRequest;

class TripTitleAdImageRequest extends FormRequest
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
            'title_create_memories.en' => 'required',
            'title_create_memories.ar' => 'required',

            'title_Find_your_path.en' => 'required',
            'title_Find_your_path.ar' => 'required',

            'title_Where_the_journey.en' => 'required',
            'title_Where_the_journey.ar' => 'required',


            'image_one' => 'sometimes',
            
            'image_tow' => 'sometimes',
           
            
        
        ];
    }}
