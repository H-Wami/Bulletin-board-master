<?php

namespace App\Http\Controllers\User\Post;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Posts\PostFavorite;
use Auth;

class PostFavoritesController extends Controller
{
    // 投稿いいね作成機能
    public function postLike(Request $request)
    {
        $user_id = Auth::id(); // ログインユーザーID格納
        $post_id = $request->post_id; // 投稿ID格納
        $favorite = new PostFavorite; // PostFavoriteモデルインスタンス化

        $favorite->user_id = $user_id; // post_favoritesテーブルのuser_idカラムは$user_id同じ
        $favorite->post_id = $post_id; //post_favoritesテーブルのpost_idカラムは$post_id同じ
        $favorite->save(); // いいね作成実行

        return response()->json(); // response(返事)をjson(JavaScriptのオブジェクトの書き方を元にしたデータ定義方法)で取得
    }

    // 投稿いいね削除機能
    public function postUnlike(Request $request)
    {
        $user_id = Auth::id(); // ログインユーザーID格納
        $post_id = $request->post_id; // 投稿ID格納
        $favorite = new PostFavorite; // PostFavoriteモデルインスタンス化

        $favorite->where('user_id', $user_id)->where('post_id', $post_id)->delete();  // post_favoritesテーブルのuser_idカラムと$user_idが同じ->post_idカラムと$post_idが同じ->いいね削除実行

        return response()->json(); // response(返事)をjson(JavaScriptのオブジェクトの書き方を元にしたデータ定義方法)で取得
    }
}
