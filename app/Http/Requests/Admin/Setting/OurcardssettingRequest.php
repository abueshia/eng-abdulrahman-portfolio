<?php

namespace App\Http\Requests\Admin\Setting;

use Illuminate\Foundation\Http\FormRequest;

class OurcardssettingRequest extends FormRequest
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
            // 
            'title_regular_user_cards.en' => 'sometimes',
            'title_regular_user_cards.ar' => 'sometimes',

            'description_regular_user_cards.en' => 'sometimes',
            'description_regular_user_cards.ar' => 'sometimes',
            // 
            'title_royal_cards.en' => 'sometimes',
            'title_royal_cards.ar' => 'sometimes',

            'description_royal_cards.en' => 'sometimes',
            'description_royal_cards.ar' => 'sometimes',
            // 
            'title_imperial_cards.en' => 'sometimes',
            'title_imperial_cards.ar' => 'sometimes',

            'description_imperial_cards.en' => 'sometimes',
            'description_imperial_cards.ar' => 'sometimes',
            
            
        
        ];
    }}
