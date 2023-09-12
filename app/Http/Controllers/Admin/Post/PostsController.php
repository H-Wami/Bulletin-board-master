<?php

namespace App\Http\Controllers\Admin\Post;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    // カテゴリー追加ページ表示
    public function categoryView()
    {
        return view('category');
    }
}
