<?php

namespace App\Models\Posts;

use Illuminate\Database\Eloquent\Model;

class PostCommentFavorite extends Model
{
    protected $table = 'post_comment_favorites';

    protected $fillable = [
        'user_id',
        'post_comment_id',
    ];

    // post_commentsテーブルとリレーション　リレーション定義　1×多
    // 1側と結合 メソッド単数 belongsTo(対象先のモデル)
    public function postComment()
    {
        return $this->belongsTo('App\Models\Posts\PostComment');
    }

    // いいねの数表示
    public function commentLikeCounts($post_comment_id)
    {
        return $this->where('post_comment_id', $post_comment_id)->get()->count(); // post_comments_favoritesテーブルのpost_idと$post_comment_idが一致している投稿を取得して数を表示する。
    }
}
