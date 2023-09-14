<?php

namespace App\Http\Controllers\User\Post;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Users\User;
use App\Models\Posts\PostSubCategory;
use App\Models\Posts\PostMainCategory;
use App\Models\Posts\Post;
use App\Http\Requests\PostFormRequest; // フォームリクエスト使用
use Auth;
use Illuminate\Foundation\Http\FormRequest;

class PostsController extends Controller
{

    // 投稿一覧ページ表示
    public function postView()
    {
        $id = Auth::id();
        return view('post.post', ['id' => $id]);
    }

    // 新規投稿ページ表示
    public function postInput()
    {
        $main_categories = PostMainCategory::get(); // メインカテゴリー取得
        $sub_categories = PostSubCategory::get(); // サブカテゴリー取得
        return view('post.post_create',compact('main_categories','sub_categories'));
    }

    // 新規投稿機能
    public function postCreate(PostFormRequest $request) // フォームリクエスト使用・バリデーションメッセージ
    {
        $post = Post::create([ // postsテーブルに入力された値を保存する
            'user_id' => Auth::id(),
            'post_sub_category_id' => $request->post_sub_category_id,
            'title' => $request->title,
            'post' => $request->post,
            'event_at' => now()
        ]);

        return redirect()->route('postView',compact('post'));
    }
}
