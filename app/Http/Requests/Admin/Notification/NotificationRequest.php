<?php

namespace App\Http\Requests\Admin\Notification;

use App\Helpers\TranslationHelper;
use App\Models\Client;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class NotificationRequest extends FormRequest
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
            // 'name' => 'required',
            // 'message' => 'required',
            // 'user_id' => 'required',

            'name' => 'required|string',
            'message' => 'required|string',
            'user_id' => 'required',
       
        ];
    }
    public function messages(): array
    {
        return [
            'name.required' => TranslationHelper::translate('Please Enter Name'),
            'message.required' => TranslationHelper::translate('Please Enter message'),
            'user_id.required' => TranslationHelper::translate('Please Enter user_id'),
        ];
    }
}
