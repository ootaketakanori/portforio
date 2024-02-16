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
            'name' => 'required|string|max:191',
            'email' => 'required|string|email|max:191|unique:users',
            'password' => 'required|string|min:8|max:191',
            'confirm_password' => 'required_with:password|same:password'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'ユーザーネームは入力必須です。',
            'name.string' => 'ユーザーネームは文字列である必要があります。',
            'name.max' => 'ユーザーネームは191文字以内で入力してください。',
            'email.required' => 'メールアドレスは入力必須です。',
            'email.string' => 'メールアドレスは文字列である必要があります。',
            'email.email' => 'メールアドレスの形式が不正です。',
            'email.max' => 'メールアドレスは191文字以内で入力してください。',
            'email.unique' => 'このメールアドレスはすでに使用されています。',
            'password.required' => 'パスワードは入力必須です。',
            'password.string' => 'パスワードは文字列である必要があります。',
            'password.min' => 'パスワードは8文字以上である必要があります。',
            'password.max' => 'パスワードは191文字以内で入力してください。',
        ];
    }
}
