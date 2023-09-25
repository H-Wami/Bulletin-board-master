<?php

namespace App\Models\Posts;

use Illuminate\Database\Eloquent\Model;

class PostFavorite extends Model
{
    protected $table = 'post_favorites';

    protected $fillable = [
        'user_id',
        'post_id',
    ];

    // usersテーブルとリレーション　リレーション定義　1×多
    // 1側と結合 メソッド単数 belongsTo(対象先のモデル)
    public function user()
    {
        return $this->belongsTo('App\Models\Users\User');
    }

    // いいねの数表示
    public function likeCounts($post_id)
    {
        return $this->where('post_id', $post_id)->get()->count(); // post_favoritesテーブルのpost_idと$post_idが一致している投稿を取得して数を表示する。
    }

}
