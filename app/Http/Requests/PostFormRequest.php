<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostFormRequest extends FormRequest
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
            'post_sub_category_id' => 'required|exists:post_sub_categories,id',
            'title' => 'required|string|max:100',
            'post' => 'required|string|max:5000'
        ];
    }

    public function messages()
    {
        return [
            //'項目名.検証ルール' => 'メッセージ',
            'post_sub_category_id.required' => 'サブカテゴリーは入力必須です。',
            'post_sub_category_id.exists' => 'このサブカテゴリーは登録されていません。',

            'title.required' => 'タイトルは入力必須です。',
            'title.max' => 'タイトルは100文字以下で入力して下さい。',

            'post.required' => '投稿は入力必須です。',
            'post.max' => '投稿は5000文字以下で入力して下さい。'
        ];
    }
}
