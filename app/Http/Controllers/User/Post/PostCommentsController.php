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

    // コメント編集ページ表示
    public function commentEdit($comment_id)
    {
        $comment = PostComment::with('post')->findOrFail($comment_id); // PostCommentモデルと関連するリレーションメソッドを取得->$comment_idの投稿を取得
        return view('comment.comment_edit', compact('comment'));
    }

    // コメント編集機能
    public function commentUpdate(Request $request)
    {
        // バリデーション定義・メッセージ
        $request->validate(
            [
                'comment' => 'required|string|max:2500'
            ],
            [
                'comment.required' => 'コメントは入力必須です。',
                'comment.max' => 'コメントは2500文字以下で入力して下さい。'
            ]
        );

        PostComment::where('id', $request->comment_id)->update([ //(カラム名,$requestのcomment_id)と一致している投稿を探す
            'update_user_id' => Auth::id(),
            'comment' => $request->comment
        ]); // 入力された値に編集して保存する。

        return redirect()->route('postDetail', ['id' => $request->comment_id]);
    }

    // コメント削除機能
    public function commentDelete($id)
    {
        $comment = PostComment::findOrFail($id); //削除したい投稿(post_commentsテーブル)を取得する。なければエラー文を出す。
        $comment->delete(); // 削除実行

        return redirect()->route('postView');
    }
}
