<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Log;
use App\Models\User;
use Illuminate\Validation\Rule;


class UserEditRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // ここを false にすると、このリクエストは常に拒否されます
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        $userId = auth()->id(); // 認証されたユーザーのIDを取得

        $user = User::findOrFail($userId);

        log::debug($userId);
        log::debug($user);

        return [
            'userName' => 'required|string|max:32',
            // userEmailのバリデーションルールを更新
            'userEmail' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users')->ignore($user->userEmail, 'userEmail'),
            ],
            'category' => 'required|string|max:255',
            'faculty' => 'required|string|max:255',
            'department' => 'required|string|max:255',
            'admissionYear' => 'required|string|max:255',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'userName.required' => 'ユーザー名は必須項目です。',
            'userName.string' => 'ユーザー名は文字列である必要があります。',
            'userName.max' => 'ユーザー名は32文字以内で入力してください。',

            'userEmail.required' => 'メールアドレスは必須項目です。',
            'userEmail.string' => 'メールアドレスは文字列である必要があります。',
            'userEmail.email' => 'メールアドレスの形式が正しくありません。',
            'userEmail.max' => 'メールアドレスは255文字以内で入力してください。',
            'userEmail.unique' => 'このメールアドレスは既に使用されています。',

            'category.required' => 'カテゴリは必須項目です。',
            'category.string' => 'カテゴリは文字列である必要があります。',
            'category.max' => 'カテゴリは255文字以内で入力してください。',

            'faculty.required' => '学部は必須項目です。',
            'faculty.string' => '学部は文字列である必要があります。',
            'faculty.max' => '学部は255文字以内で入力してください。',

            'department.required' => '学科は必須項目です。',
            'department.string' => '学科は文字列である必要があります。',
            'department.max' => '学科は255文字以内で入力してください。',

            'admissionYear.required' => '入学年度は必須項目です。',
            'admissionYear.string' => '入学年度は文字列である必要があります。',
            'admissionYear.max' => '入学年度は255文字以内で入力してください。',
        ];
    }
}
