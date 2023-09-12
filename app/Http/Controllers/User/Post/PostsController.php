<?php

namespace App\Http\Controllers\User\Post;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Users\User;
use App\Models\Posts\PostSubCategory;
use App\Models\Posts\PostMainCategory;
use Auth;

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
}
