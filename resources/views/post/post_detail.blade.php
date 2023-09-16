@extends('layouts.login')

@section('title')

<h2>投稿詳細画面</h2>

@endsection

@section('content')
<!-- 投稿詳細 -->
<div class="">
  <!-- 上端コンテンツまとめ -->
  <div class="">
    <!-- postsテーブルの値->リレーションメソッド->リレーションテーブルの値取得->取得したいカラム名 -->
    <p>{{ $post->user->username }}さん</p>
    <p>{{ $post->event_at->format('Y年m月d日') }}</p>
    <!-- 閲覧数 -->
  </div>
  <!-- 2段目コンテンツまとめ -->
  <div class="">
    <!-- 投稿タイトル -->
    <div class="">
      <p>{{ $post->title }}</p>
    </div>
    <!-- もしログインユーザーならば編集ボタンを表示する -->
    @if($post->user_id === Auth::user()->id)
    <div>
      <a class="post_edit_btn" href="{{ route('postEdit', ['id' => $post->id]) }}">編集</a>
    </div>
    @endif
  </div>
  <!-- 投稿内容 -->
  <div>
    <p>{{ $post->post }}</p>
  </div>
  <!-- 下端コンテンツまとめ -->
  <div>
    <p>{{ $post->postSubCategory->sub_category }}</p>
    <!-- コメント数 -->
    <!-- いいね -->
  </div>
</div>
@endsection
