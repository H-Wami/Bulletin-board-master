<?php

namespace App\Http\Controllers\User\Post;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Users\User;
use Auth;

class PostsController extends Controller
{

    // 投稿一覧ページ表示
    public function postView()
    {
        $id = Auth::id();
        return view('/post', ['id' => $id]);
    }
}
