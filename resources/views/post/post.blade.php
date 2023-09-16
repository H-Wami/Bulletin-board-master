@extends('layouts.login')

@section('title')

<h2>掲示板投稿一覧</h2>

@endsection

@section('content')
<!-- 左側:投稿一覧 -->
<div class="">
  @foreach($posts as $post)
  <!-- 投稿ひとまとめ -->
  <!-- 上端コンテンツまとめ -->
  <div class="">
    <!-- postsテーブルの値->リレーションメソッド->リレーションテーブルの値取得->取得したいカラム名 -->
    <p>{{ $post->user->username }}さん</p>
    <p>{{ $post->event_at->format('Y年m月d日') }}</p>
    <!-- 閲覧数 -->
  </div>
  <!-- 投稿タイトル -->
  <div class="">
    <a href="{{ route('postDetail',['id' => $post->id]) }}">{{ $post->title }}</a>
  </div>
  <!-- 下端コンテンツまとめ -->
  <div>
    <p>{{ $post->postSubCategory->sub_category }}</p>
    <!-- コメント数 -->
    <!-- いいね -->
  </div>
  @endforeach
</div>

<!-- 右側 -->
<div class="">
  <!-- もしログインユーザーが管理者だったらボタン表示 -->
  @if(Auth::user()->admin_role === 1)
  <a href="{{ route('categoryView') }}">カテゴリーを追加</a>
  @endif

  <a href="{{ route('postInput') }}">投稿</a>
</div>
@endsection
