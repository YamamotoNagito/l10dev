<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules()
    {
        return [
            'name' => 'required|max:32',
            'email' => 'required|email',
            'category' => 'required|string',
            'message' => 'required|string|max:2000', // 2000文字以内のバリデーションルールを修正
        ];
    }

    public function messages()
    {
        return [
            'name.required' => '名前は必須項目です。',
            'name.max' => '名前は最大32文字までです。',
            'email.required' => 'メールアドレスは必須項目です。',
            'email.email' => 'メールアドレスが無効です。',
            'category.required' => 'カテゴリーは必須項目です。',
            'category.string' => 'カテゴリーは文字列である必要があります。',
            'message.required' => 'メッセージは必須項目です。',
            'message.string' => 'メッセージは文字列である必要があります。',
            'message.max' => 'メッセージは最大2000文字までです。',
        ];
    }
}
