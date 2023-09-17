<?php

namespace App\Http\Controllers\User\Post;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Posts\PostComment;
use Auth;

class PostCommentsController extends Controller
{
    // 新規コメント機能
    public function commentCreate(Request $request)
    {
        // バリデーション定義・メッセージ
        $request->validate([
            'comment' => 'required|string|max:2500'
        ],
        [
            'comment.required' => 'コメントは入力必須です。',
            'comment.max' => 'コメントは2500文字以下で入力して下さい。'
        ]);

        PostComment::create([ // post_commentsテーブルに入力された値を保存する
            'user_id' => Auth::id(),
            'post_id' => $request->post_id,
            'comment' => $request->comment,
            'event_at' => now()
        ]);

        return redirect()->route('postDetail', ['id' => $request->post_id]);
    }
}
