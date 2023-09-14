<?php

namespace App\Http\Controllers\Admin\Post;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Posts\PostSubCategory;

class PostSubCategoriesController extends Controller
{
    // サブカテゴリー作成機能
    public function subCategoryCreate(Request $request)
    {
        // バリデーション定義・メッセージ
        $request->validate([
            'post_main_category_id' => 'required|exists:post_main_categories,id',
            'sub_category' => 'required|string|max:100|unique:post_sub_categories,sub_category'
        ],
        [
            'post_main_category_id.required' => 'メインカテゴリーは入力必須です。',
            'post_main_category_id.exists' => 'このメインカテゴリーは登録されていません。',

            'sub_category.required' => 'サブカテゴリーは入力必須です。',
            'sub_category.max' => 'サブカテゴリーは100文字以内で入力して下さい。',
            'sub_category.unique' => '登録済みのサブカテゴリーは作成できません。'
        ]);

        PostSubCategory::create([ // post_sub_categoriesテーブルに入力された値を保存する。
            'post_main_category_id' => $request->post_main_category_id,
            'sub_category' => $request->sub_category
        ]);

        return redirect()->route('categoryView');
    }

    // サブカテゴリー削除機能
    public function subCategoryDelete($id)
    {
        $sub_category = PostSubCategory::findOrFail($id); //削除したいサブカテゴリー(post_sub_categoriesテーブル)を取得する。なければエラー文を出す。
        $sub_category->delete(); // 削除実行

        return redirect()->route('categoryView');
    }
}
