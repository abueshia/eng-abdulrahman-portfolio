<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Message; 
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    use ApiResponseTrait;

    public function CreateMessage(Request $request)
    {
        try {
            $validated = $request->validate([
                'message' => 'required|string',
                'name' => 'required|string|max:100',
                'phone' => 'required|string|regex:/^[0-9]{10,15}$/', 
            ], [
                'message.required' => 'حقل الرسالة مطلوب.',
                'message.string' => 'الرسالة يجب أن تكون نصًا.',
                'name.required' => 'حقل الاسم مطلوب.',
                'name.string' => 'الاسم يجب أن يكون نصًا.',
                'name.max' => 'الاسم يجب ألا يتجاوز 100 حرف.',
                'phone.required' => 'حقل الهاتف مطلوب.',
                'phone.string' => 'رقم الهاتف يجب أن يكون نصًا.',
                'phone.regex' => 'رقم الهاتف غير صالح. يجب أن يتكون من 10 إلى 15 رقمًا.',
            ]);

            $message = Message::create([
                'message' => $validated['message'],
                'name' => $validated['name'],
                'phone' => $validated['phone'],
            ]);

            return $this->success_response($message, 'Message created successfully', 201);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return $this->error_response('Validation failed', $e->errors(), 422);
        }
    }
}
