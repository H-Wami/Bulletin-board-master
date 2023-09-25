<?php

namespace App\Http\Controllers\User\Post;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Users\User;
use App\Models\Posts\PostSubCategory;
use App\Models\Posts\PostMainCategory;
use App\Models\Posts\Post;
use App\Models\Posts\PostComment;
use App\Models\ActionLogs\ActionLog;
use App\Models\Posts\PostFavorite;
use App\Http\Requests\PostFormRequest; // フォームリクエスト使用
use App\Models\Posts\PostCommentFavorite;
use Auth;
use Illuminate\Foundation\Http\FormRequest;

class PostsController extends Controller
{

    // 投稿一覧ページ表示・投稿検索機能
    public function postView(Request $request)
    {
        // 投稿一覧表示
        $posts = Post::with('user', 'postComments')->latest()->get(); // Postモデルと関連するusersを取得->新しい順に全て取得
        $main_categories = PostMainCategory::get(); // メインカテゴリー取得
        $sub_categories = PostSubCategory::get(); // サブカテゴリー取得
        // コメントの数表示
        $favorite = new PostFavorite; // PostFavoriteモデルインスタンス化 (いいねの数表示)
        // 投稿検索機能
        if (!empty($request->keyword)) {
            // もし検索ワードが入力されたら
            $posts = Post::with('user', 'postComments')
            ->where('title', 'like', '%'.$request->keyword.'%') // タイトルであいまい検索
            ->orWhereHas('postSubCategory', function ($q) use ($request){
                $q->where('sub_category', $request->keyword);
            }) // サブカテゴリー完全一致検索
            ->orWhere('post', 'like', '%' . $request->keyword . '%') // 投稿内容であいまい検索
            ->latest()->get(); // 新しい順に全て取得
        }else if($request->my_posts) { // 自分の投稿ボタンが押されたら
            $posts = Post::with('user', 'postComments')
            ->where('user_id', Auth::id())
            ->latest()->get(); // postsテーブルのuser_idカラムとログインユーザーIDが同じ投稿を新しい順に全て取得
        }else if($request->category_posts) { // サブカテゴリーが押されたら
            $posts = Post::with('user', 'postComments')
            ->whereHas('postSubCategory', function ($q) use ($request) {
                $q->where('sub_category', $request->category_posts);
            })->latest()->get(); // post_sub_categoriesテーブルのsub_categoryカラムと押したサブカテゴリーが同じ投稿を新しい順に全て取得
        }else if($request->like_posts) { // いいねした投稿ボタンが押されたら
            $likes = Auth::user()->likePostId()->get('post_id'); // ログインユーザーの情報->post_favoritesテーブルのuser_idカラムとログインユーザーIDが一致している->post_idカラムを取得
            $posts = Post::with('user', 'postComments')
            ->whereIn('id', $likes)->latest()->get(); // postsテーブルのidカラムと押した$likesが同じ投稿を新しい順に全て取得
        }
        return view('post.post',compact('posts', 'main_categories', 'sub_categories', 'favorite'));
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

    // 投稿詳細ページ表示
    public function postDetail($post_id)
    {
        $post = Post::with('user', 'postComments')->findOrFail($post_id); // Postモデルと関連するusersを取得->$post_idの投稿を取得
        $favorite = new PostFavorite; // PostFavoriteモデルインスタンス化 (投稿いいねの数表示)
        $comment_favorite =new PostCommentFavorite(); // PostCommentFavoriteモデルインスタンス化 (コメントいいねの数表示)
        ActionLog::create([
            'user_id' => Auth::id(),
            'post_id' => $post_id,
            'event_at' => now()
        ]); // action_logsテーブルに閲覧した情報を保存する
        return view('post.post_detail', compact('post','favorite','comment_favorite'));
    }

    // 投稿編集ページ表示
    public function postEdit($post_id)
    {
        $post = Post::with('user', 'postComments')->findOrFail($post_id); // Postモデルと関連するリレーションメソッドを取得->$post_idの投稿を取得
        $main_categories = PostMainCategory::get(); // メインカテゴリー取得
        $sub_categories = PostSubCategory::get(); // サブカテゴリー取得
        return view('post.post_edit', compact('post', 'main_categories', 'sub_categories'));
    }

    // 投稿編集機能
    public function postUpdate(PostFormRequest $request) // フォームリクエスト使用・バリデーションメッセージ
    {
        Post::where('id', $request->post_id)->update([ //(カラム名,$requestのpost_id)と一致している投稿を探す
            'update_user_id' => Auth::id(),
            'post_sub_category_id' => $request->post_sub_category_id,
            'title' => $request->title,
            'post' => $request->post
        ]); // 入力された値に編集して保存する。
        return redirect()->route('postDetail', ['id' => $request->post_id]);
    }

    // 投稿削除機能
    public function postDelete($id)
    {
        $post = Post::findOrFail($id); //削除したい投稿(postsテーブル)を取得する。なければエラー文を出す。
        $post->delete(); // 削除実行

        return redirect()->route('postView');
    }
}
