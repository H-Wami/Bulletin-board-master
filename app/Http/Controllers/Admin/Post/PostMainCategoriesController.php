<?php

namespace App\Http\Controllers\Admin\Post;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Posts\PostMainCategory;

class PostMainCategoriesController extends Controller
{
    // メインカテゴリー作成機能
    public function mainCategoryCreate(Request $request)
    {
        // バリデーション定義・メッセージ
        $request->validate([
            'main_category' => 'required|string|max:100|unique:post_main_categories,main_category'
        ],
        [
            'main_category.required' => 'メインカテゴリーは入力必須です。',
            'main_category.max' => 'メインカテゴリーは100文字以下で入力して下さい。',
            'main_category.unique' => '登録済みのメインカテゴリーは作成できません。'
        ]);

        PostMainCategory::create([ // post_main_categoriesテーブルに入力された値を保存する。
            'main_category' => $request->main_category
        ]);

        return redirect()->route('categoryView');
    }

    // メインカテゴリー削除機能
    public function mainCategoryDelete($id)
    {
        $main_category = PostMainCategory::findOrFail($id); //削除したいメインカテゴリー(post_main_categoriesテーブル)を取得する。なければエラー文を出す。
        $main_category->delete(); // 削除実行

        return redirect()->route('categoryView');
    }
}
