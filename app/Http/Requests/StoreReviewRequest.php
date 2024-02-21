<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreReviewRequest extends FormRequest
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
            'userId' => 'required|integer',
            'lectureName' => 'required|string|max:255',
            'teacherName' => 'required|string|max:255',
            'attendanceYear' => 'required|integer',
            // 変更可能性を考えて、渡ってくる文字列の検証はしない。本当はするべき。
            'attendanceConfirm' => 'required|string|max:32',
            'weeklyAssignments' => 'required|string|max:32',
            'midtermAssignments' => 'required|string|max:32',
            'finalAssignments' => 'required|string|max:32',
            'pastExamPossession' => 'required|string|max:32',
            'grades' => 'required|string|max:32',
            'creditLevel' => 'required|integer|min:1|max:5',
            'interestLevel' => 'required|integer|min:1|max:5',
            'skillLevel' => 'required|integer|min:1|max:5',
            'comments' => 'nullable|string|max:2000',
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
            'userId.required' => 'ユーザーIDは必須です。',
            'userId.integer' => 'ユーザーIDは整数である必要があります。',
            'lectureName.required' => '講義名は必須です。',
            'lectureName.string' => '講義名は文字列である必要があります。',
            'lectureName.max' => '講義名は255文字以下である必要があります。',
            'teacherName.required' => '教員名は必須です。',
            'teacherName.string' => '教員名は文字列である必要があります。',
            'teacherName.max' => '教員名は255文字以下である必要があります。',
            'attendanceYear.required' => '出席年は必須です。',
            'attendanceYear.integer' => '出席年は整数である必要があります。',
            'attendanceConfirm.required' => '出席確認は必須です。',
            'attendanceConfirm.string' => '出席確認は文字列である必要があります。',
            'attendanceConfirm.max' => '出席確認は32文字以下である必要があります。',
            'weeklyAssignments.required' => '週次課題は必須です。',
            'weeklyAssignments.string' => '週次課題は文字列である必要があります。',
            'weeklyAssignments.max' => '週次課題は32文字以下である必要があります。',
            'midtermAssignments.required' => '中間課題は必須です。',
            'midtermAssignments.string' => '中間課題は文字列である必要があります。',
            'midtermAssignments.max' => '中間課題は32文字以下である必要があります。',
            'finalAssignments.required' => '期末課題は必須です。',
            'finalAssignments.string' => '期末課題は文字列である必要があります。',
            'finalAssignments.max' => '期末課題は32文字以下である必要があります。',
            'pastExamPossession.required' => '過去試験所持は必須です。',
            'pastExamPossession.string' => '過去試験所持は文字列である必要があります。',
            'pastExamPossession.max' => '過去試験所持は32文字以下である必要があります。',
            'grades.required' => '成績は必須です。',
            'grades.string' => '成績は文字列である必要があります。',
            'grades.max' => '成績は32文字以下である必要があります。',
            'creditLevel.required' => '単位レベルは必須です。',
            'creditLevel.integer' => '単位レベルは整数である必要があります。',
            'creditLevel.min' => '単位レベルは1以上である必要があります。',
            'creditLevel.max' => '単位レベルは5以下である必要があります。',
            'interestLevel.required' => '興味レベルは必須です。',
            'interestLevel.integer' => '興味レベルは整数である必要があります。',
            'interestLevel.min' => '興味レベルは1以上である必要があります。',
            'interestLevel.max' => '興味レベルは5以下である必要があります。',
            'skillLevel.required' => 'スキルレベルは必須です。',
            'skillLevel.integer' => 'スキルレベルは整数である必要があります。',
            'skillLevel.min' => 'スキルレベルは1以上である必要があります。',
            'skillLevel.max' => 'スキルレベルは5以下である必要があります。',
            'comments.string' => 'コメントは文字列である必要があります。',
            'comments.max' => 'コメントは2000文字以下である必要があります。',
        ];
    }
}
