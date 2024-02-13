<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'username' => 'required|string|max:191',
            'email' => 'required|string|email|max:191|unique:users',
            'password' => 'required|string|min:8|max:191',
            'confirm_password' => 'required_with:password|same:password'
        ];
    }

    public function messages()
    {
        return [
            'username.required' => 'ユーザーネームは必須です。',
            'email.required' => 'メールアドレスは必須です。',
            'email.email' => 'メールアドレスは有効なメール形式である必要があります。',
            'email.unique' => 'このメールアドレスは既に使用されています。',
            'password.required' => 'パスワードは必須です。',
            'password.min' => 'パスワードは最低8文字必要です。',
            'confirm_password.required_with' => '確認用パスワードは必須です。',
            'confirm_password.same' => 'パスワードと確認用パスワードが一致している必要があります。',
        ];
    }
}
