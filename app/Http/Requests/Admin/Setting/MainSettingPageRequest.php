<?php

namespace App\Http\Requests\Admin\Setting;

use Illuminate\Foundation\Http\FormRequest;

class MainSettingPageRequest extends FormRequest
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
            'logo' => 'sometimes',
            // 'title_one' => 'required',
            'phone' => 'required',
            'email' => 'required',

            'video' => 'sometimes',

            'image' => 'sometimes',

            // 'Address' => 'required',

            // 'long_established' => 'required',

            // 'short_desc' => 'required',

            'whatsapp' => 'required',
            'facebook' => 'required',
            'twitter' => 'required',
            'linkedin' => 'required',
            'pinterest'=>'required',
            'instagram' => 'required',
            'tiktok' => 'required',
            'snapchat' => 'required',
            
            'Address.en' => 'required',
            'Address.ar' => 'required',

            'long_established.en' => 'required',
            'long_established.ar' => 'required',

            'title_one.en' => 'required',
            'title_one.ar' => 'required',

            'short_desc.en' => 'required',
            'short_desc.ar' => 'required',
        ];
    }
}
