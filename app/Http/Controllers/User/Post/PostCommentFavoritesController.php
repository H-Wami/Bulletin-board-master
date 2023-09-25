<?php

namespace App\Http\Controllers\User\Post;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Posts\PostCommentFavorite;
use Auth;

class PostCommentFavoritesController extends Controller
{
    // 投稿いいね作成機能
    public function commentLike(Request $request)
    {
        $user_id = Auth::id(); // ログインユーザーID格納
        $post_comment_id = $request->post_comment_id; // コメントID格納
        $comment_favorite = new PostCommentFavorite; // PostCommentFavoriteモデルインスタンス化

        $comment_favorite->user_id = $user_id; // post_comment_favoritesテーブルのuser_idカラムは$user_id同じ
        $comment_favorite->post_comment_id = $post_comment_id; //post_comment_favoritesテーブルのpost_comment_idカラムは$post_comment_id同じ
        $comment_favorite->save(); // いいね作成実行

        return response()->json(); // response(返事)をjson(JavaScriptのオブジェクトの書き方を元にしたデータ定義方法)で取得
    }

    // 投稿いいね削除機能
    public function commentUnlike(Request $request)
    {
        $user_id = Auth::id(); // ログインユーザーID格納
        $post_comment_id = $request->post_comment_id; // コメントID格納
        $comment_favorite = new PostCommentFavorite; // PostCommentFavoriteモデルインスタンス化

        $comment_favorite->where('user_id', $user_id)->where('post_comment_id', $post_comment_id)->delete();  // post_comment_favoritesテーブルのuser_idカラムと$user_idが同じ->post_comment_idカラムと$post_comment_idが同じ->いいね削除実行

        return response()->json(); // response(返事)をjson(JavaScriptのオブジェクトの書き方を元にしたデータ定義方法)で取得
    }
}
