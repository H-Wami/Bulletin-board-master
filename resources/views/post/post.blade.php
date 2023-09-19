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
    <p>{{ $post->event_at->format('Y年n月j日') }}</p>
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
  <!-- 新規投稿ボタン -->
  <a href="{{ route('postInput') }}">投稿</a>
  <!-- 検索フォーム -->
  <div>
    <form action="{{ route('postView') }}" method="GET" id="postSearchRequest"></form>
    <input type="text" form="postSearchRequest">
    <input type="submit" name="" value="検索" form="postSearchRequest">
  </div>
  <!-- いいねした投稿ボタン -->
  <input type="submit" name="" value="いいねした投稿" form="postSearchRequest">
  <!-- 自分の投稿ボタン -->
  <input type="submit" name="" value="自分の投稿" id="postSearchRequest">
  <!-- カテゴリー検索 -->
  <div>
    <p>カテゴリー</p>
    <!-- カテゴリーひとまとめ -->
    <ul>
      <!-- メインカテゴリー表示 -->
      @foreach($main_categories as $main_category)
      <li category_id="{{ $main_category->id }}"></li>
      <span>{{ $main_category->main_category }}</span>
      <!-- サブカテゴリー表示 -->
      <!-- メインカテゴリーに紐付いているサブカテゴリーを持ってくる $紐付いている元->リレーションメソッド -->
      @foreach($main_category->postSubCategories as $sub_category)
      <input type="submit" name="" value="{{ $sub_category->sub_category }}" id="postSearchRequest">
      @endforeach <!-- サブカテゴリーのend -->
      </li>
      @endforeach <!-- メインカテゴリーのend -->
    </ul>
  </div>

</div>
@endsection
