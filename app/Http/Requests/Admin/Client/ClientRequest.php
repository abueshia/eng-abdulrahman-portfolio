<?php

namespace App\Http\Requests\Admin\Client;

use App\Helpers\TranslationHelper;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;


class ClientRequest extends FormRequest
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
            'name' => 'required|max:255',
            'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            // 'card' => 'required|unique:clients,card,' . $this->id, 
            'card' => [
                $this->id ? 'nullable' : 'required', // إذا كان في حالة تعديل، يصبح nullable
                'unique:clients,card,' . $this->id, // في حالة التعديل لا يتم التحقق من التكرار إلا إذا كانت القيمة جديدة
                'numeric', // للتحقق من أن المدخل عبارة عن أرقام فقط
                'max:99999999999999', // أقصى عدد يمكن إدخاله هو 14 رقم
            ],
            'username' => 'required|max:255',
            'password' => $this->id ? 'nullable|min:6' : 'required|min:6', // كلمة المرور مطلوبة عند الإنشاء فقط
            'category' => 'required',
            'image' => [
                $this->id ? 'nullable' : 'required', // إذا كان في حالة تعديل، يصبح nullable
                'image',
                'mimes:png,jpg,jpeg,webp',
            ],
            'is_banned' => 'nullable|boolean', // إضافية لتأكيد النوع
            'city_id' => 'nullable|exists:cities,id',
            'region_id' => 'nullable|exists:regions,id',

            'points' => 'nullable',

            'country_id'=> 'nullable',
            'code_for_client' => 'nullable',
            
            
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => TranslationHelper::translate('Please Enter Name'),
            'phone.required' => TranslationHelper::translate('Please Enter Phone'),
            'phone.regex' => TranslationHelper::translate('Phone number is not valid'),
            'card.required' => TranslationHelper::translate('Please Enter Card Number'),

            'card.unique' => TranslationHelper::translate('Card Number already exists'),
            'card.max' => TranslationHelper::translate('حقل البطاقة يجب ألا يزيد عن 14 رقم.'),

            'username.required' => TranslationHelper::translate('Please Enter Username'),
            'password.required' => TranslationHelper::translate('Please Enter Password'),
            'password.min' => TranslationHelper::translate('Password must be at least 6 characters'),
            'category.required' => TranslationHelper::translate('Please Enter Category'),

            'image.required' => TranslationHelper::translate('Please Upload Image'),
            'image.image' => TranslationHelper::translate('Uploaded file must be an image'),
            'image.mimes' => TranslationHelper::translate('Image must be of type png, jpg, jpeg, or webp'),

             'is_banned.boolean' => TranslationHelper::translate('Invalid value for Ban Status'),

            'city_id.nullable' => TranslationHelper::translate('Please Enter city_id'),

            'region_id.nullable' => TranslationHelper::translate('Please Enter region_id'),
        ];
    }

    // public function failedValidation(Validator $validator)
    // {
    //     throw new HttpResponseException(response()->json([
    //         'code' => 422,
    //         'success'   => false,
    //         'message'   => $validator->errors()
    //     ]));
    // }

}
