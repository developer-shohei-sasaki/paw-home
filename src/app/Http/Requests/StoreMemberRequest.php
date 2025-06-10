<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMemberRequest extends FormRequest
{
    /**
     * リクエストの認可判定
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * バリデーションルール
     */
    public function rules(): array
    {
        return [
            'last-name' => 'required|string|max:255',
            'first-name' => 'required|string|max:255',
            'birthday' => 'required|date',
            'email' => 'required|email|unique:members,email',
            'password' => 'required|string|min:8',
            'zip-code' => 'required|string|regex:/^\d{3}\d{4}$/',
            'address' => 'required|string|max:255',
        ];
    }

    /**
     * バリデーションエラーメッセージのカスタマイズ
     */
    public function messages(): array
    {
        return [
            'last-name.required' => '姓は必須項目です',
            'first-name.required' => '名は必須項目です',
            'birthday.required' => '生年月日は必須項目です',
            'birthday.date' => '生年月日は有効な日付を入力してください',
            'email.required' => 'メールアドレスは必須項目です',
            'email.email' => '有効なメールアドレスを入力してください',
            'email.unique' => 'このメールアドレスは既に登録されています',
            'password.required' => 'パスワードは必須項目です',
            'password.min' => 'パスワードは8文字以上で入力してください',
            'zip-code.required' => '郵便番号は必須項目です',
            'zip-code.regex' => '郵便番号は「1234567」の形式で入力してください',
            'address.required' => '住所は必須項目です',
        ];
    }
}
