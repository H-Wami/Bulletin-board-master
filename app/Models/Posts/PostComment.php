<?php

namespace App\Models\Posts;

use Illuminate\Database\Eloquent\Model;
use App\Models\Users\User;

class PostComment extends Model
{
    protected $table = 'post_comments';

    protected $fillable = [
        'user_id',
        'post_id',
        'delete_user_id',
        'update_user_id',
        'comment',
        'event_at',
    ];

    protected $dates = [
        'event_at',
    ];

    // postsテーブルとリレーション　リレーション定義　1×多
    // 1側と結合 メソッド単数 belongsTo(対象先のモデル)
    public function post()
    {
        return $this->belongsTo('App\Models\Posts\Post');
    }

    // post_comment_favoritesテーブルとリレーション　リレーション定義　1×多
    // 多側と結合 メソッド複数形 hasMany(対象先のモデル)
    public function postCommentFavorites()
    {
        return $this->hasMany
        ('App\Models\Posts\PostCommentFavorite');
    }

    // コメントしているかどうか
    public function commentUser($user_id)
    {
        return User::where('id', $user_id)->first(); // usersテーブルのidカラムと$user_idが一致している->値を取得
    }
}
