<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AuthenticatedRequest extends FormRequest
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
            'email' => 'required|string|email',
            'password' => 'required|string|min:8|max:191',
        ];
    }


    public function messages()
    {
        return [
            'email.required' => 'メールアドレスは入力必須です。',
            'email.string' => 'メールアドレスは文字列である必要があります。',
            'email.email' => 'メールアドレスの形式が不正です。',
            'password.required' => 'パスワードは入力必須です。',
            'password.string' => 'パスワードは文字列である必要があります。',
            'password.min' => 'パスワードは8文字以上である必要があります。',
            'password.max' => 'パスワードは191文字以内で入力してください。',
        ];
    }
}
