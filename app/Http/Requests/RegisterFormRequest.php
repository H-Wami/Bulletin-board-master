<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true; // falseからtrueに変更
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() // バリデーション条件
    {
        return [
            //'項目名' => '検証ルール|検証ルール',
            'username' =>'required|string|max:30',
            'email' => 'required|string|max:100|email|unique:users,email',
            'password' =>'required|min:8|max:30|confirmed',
            'password_confirmation' => 'required|min:8|max:30'
        ];
    }

    public function messages()
    {
        return [
            //'項目名.検証ルール' => 'メッセージ',
            'username.required' => 'ユーザー名は入力必須です。',
            'username.max' => 'ユーザー名は30文字以下で入力して下さい。',

            'email.required' => 'メールアドレスは入力必須です。',
            'email.max' => 'メールアドレスは100文字以下で入力して下さい。',
            'email.email' => 'メールアドレスの形式で入力して下さい。',
            'email.unique' => '登録済みのメールアドレスは使用できません。',

            'password.required' => 'パスワードは入力必須です。',
            'password.min' => 'パスワードは8文字以上で入力して下さい。',
            'password.max' => 'パスワードは30文字以下で入力して下さい。',
            'password.confirmed' => 'パスワードが一致していません。',

            'password_confirmation.required' => 'パスワード確認は入力必須です。',
            'password_confirmation.min' => 'パスワード確認は8文字以上で入力して下さい。',
            'password_confirmation.max' => 'パスワード確認は30文字以下で入力して下さい。'

        ];
    }
}
