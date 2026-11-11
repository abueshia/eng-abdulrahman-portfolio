<?php

namespace App\Http\Requests\Front\Search;

use App\Helpers\TranslationHelper;
use Illuminate\Foundation\Http\FormRequest;

class HotelSearchRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'destination' => 'required',
            'nationality_id' => 'required',
            'hotel_check_in' => 'required|date',
            'hotel_check_out' => 'required|date',
            'adult_number' => 'required|array|min:1',
            'adult_number.*' => 'required|numeric|min:1',

        ];
    }

    public function messages()
    {
        return [
            'destination.required' => TranslationHelper::translate('Please Enter Your Destination'),
            'nationality_id.required' => TranslationHelper::translate('Please Enter Your Nationality'),
            'hotel_check_in.required' => TranslationHelper::translate('Please Enter Checkin Date'),
            'hotel_check_out.required' => TranslationHelper::translate('Please Enter Checkout Date'),
            'adult_number.required' => TranslationHelper::translate('Minimum 1 Room'),
            'adult_number.array' => TranslationHelper::translate('Invalid Room Values'),
            'adult_number.min' => TranslationHelper::translate('Minimum 1 Room'),
            'adult_number.*.required' => TranslationHelper::translate('Minimum 1 Adult Person'),
            'adult_number.*.numeric' => TranslationHelper::translate('Invalid Adult Person Value'),
            'adult_number.*.min' => TranslationHelper::translate('Minimum 1 Adult Person'),
        ];
    }
}
