<?php

namespace App\Models\Posts;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = 'posts';

    protected $fillable = [
        'user_id',
        'post_sub_category_id',
        'delete_user_id',
        'update_user_id',
        'title',
        'post',
        'event_at',
    ];

    protected $dates = [
        'event_at',
    ];

    // usersテーブルとリレーション　リレーション定義　1×多
    // 1側と結合 メソッド単数 belongsTo(対象先のモデル)
    public function user()
    {
        return $this->belongsTo('App\Models\Users\User');
    }

    // post_sub_categoriesテーブルとリレーション　リレーション定義　1×多
    // 1側と結合 メソッド単数 belongsTo(対象先のモデル)
    public function postSubCategory()
    {
        return $this->belongsTo('App\Models\Posts\PostSubCategory');
    }

    // post_commentsテーブルとリレーション　リレーション定義　1×多
    // 多側と結合 メソッド複数形 hasMany(対象先のモデル)
    public function postComments()
    {
        return $this->hasMany('App\Models\Posts\PostComment');
    }

    // action_logsテーブルとリレーション　リレーション定義　1×多
    // 多側と結合 メソッド複数形 hasMany(対象先のモデル)
    public function actionLogs()
    {
        return $this->hasMany('App\Models\ActionLogs\ActionLog');
    }
}
