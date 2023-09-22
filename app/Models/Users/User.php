<?php

namespace App\Models\Users;

use App\Models\Posts\PostFavorite;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Auth;

class User extends Authenticatable
{
    use Notifiable;

    // 更新可能なカラム
    protected $fillable = [
        'username',
        'email',
        'password',
        'admin_role',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    // postsテーブルとリレーション　リレーション定義　1×多
    // 多側と結合 メソッド複数形 hasMany(対象先のモデル)
    public function posts()
    {
        return $this->hasMany('App\Models\Posts\Post');
    }

    // post_favoritesテーブルとリレーション　リレーション定義　1×多
    // 多側と結合 メソッド複数形 hasMany(対象先のモデル)
    public function postFavorites()
    {
        return $this->hasMany('App\Models\Posts\PostFavorite');
    }

    // いいねしているかどうか
    public function isLike($post_id)
    {
        return PostFavorite::where('user_id', Auth::id())->where('post_id', $post_id)->first(['post_favorites.id']);  // post_favoritesテーブルのuser_idカラムとログインユーザーIDが同じ->post_idカラムと$post_idが同じ->post_favoritesテーブルのIDを取得する
    }
}
