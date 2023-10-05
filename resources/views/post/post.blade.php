@extends('layouts.login')

@section('title')

<h2>Post List</h2>

@endsection

@section('content')
<!-- 左側:投稿一覧 -->
<div class="post_list">
  @foreach($posts as $post)
  <!-- 投稿ひとまとめ -->
  <div class="post_unit">
    <!-- 上端コンテンツまとめ -->
    <div class="post_head">
      <!-- postsテーブルの値->リレーションメソッド->リレーションテーブルの値取得->取得したいカラム名 -->
      <p>{{ $post->user->username }}さん</p>
      <p>{{ $post->event_at->format('Y年n月j日') }}</p>
      <!-- 閲覧数 -->
      <p>{{ $post->actionLogs($post->id)->count() }}Views</p>
    </div>
    <!-- 投稿タイトル -->
    <div class="post_detail_link">
      <a href="{{ route('postDetail',['id' => $post->id]) }}">{{ $post->title }}</a>
    </div>
    <!-- 下端コンテンツまとめ -->
    <div class="post_foot">
      <p class="btn btn-primary btn-sm">{{ $post->postSubCategory->sub_category }}</p>
      <!-- コメント数 -->
      <p>コメント数　{{ $post->postComments($post->id)->count() }}</p>
      <!-- いいね -->
      <!-- ログインユーザーがいいねをしていたらいいね削除アイコン表示 -->
      @if(Auth::user()->isLike($post->id))
      <div class="like_unit">
        <i class="bi bi-heart-fill unlike_btn" post_id="{{ $post->id }}"></i>
        <p class="like_counts{{ $post->id }}">{{ $favorite->likeCounts($post->id) }}</p>
      </div>
      @else
      <!-- いいねをしていなければいいね登録アイコン表示 -->
      <div class="like_unit">
        <i class="bi bi-heart like_btn" post_id="{{ $post->id }}"></i>
        <p class="like_counts{{ $post->id }}">{{ $favorite->likeCounts($post->id) }}</p>
      </div>
      @endif
    </div>
  </div>
  @endforeach
</div>

<!-- 右側 -->
<div class="post_side">
  <!-- もしログインユーザーが管理者だったらボタン表示 -->
  <div class="side_content">
    @if(Auth::user()->admin_role === 1)
    <a href="{{ route('categoryView') }}" class="btn btn-danger">New Category</a>
    @endif
  </div>
  <!-- 新規投稿ボタン -->
  <div class="side_content">
    <a href="{{ route('postInput') }}" class="btn btn-primary">New Post</a>
  </div>
  <!-- 検索フォーム -->
  <div class="search_form">
    <form action="{{ route('postView') }}" method="GET" id="postSearchRequest"></form>
    <input type="text" name="keyword" form="postSearchRequest" class="form-control">
    <input type="submit" value="Search" form="postSearchRequest" class="btn btn-primary">
  </div>
  <!-- いいねした投稿ボタン -->
  <input type="submit" name="like_posts" value="Like Posts" form="postSearchRequest" class="btn btn-primary">
  <!-- 自分の投稿ボタン -->
  <input type="submit" name="my_posts" value="My Posts" form="postSearchRequest" class="btn btn-primary">
  <!-- カテゴリー検索 -->
  <div class="category_search">
    <p class="category_title">Category</p>
    <!-- カテゴリーひとまとめ -->
    <ul>
      <!-- メインカテゴリー表示 -->
      @foreach($main_categories as $main_category)
      <li category_id="{{ $main_category->id }}">
        <span>{{ $main_category->main_category }}</span>
        <!-- サブカテゴリー表示 -->
        <!-- メインカテゴリーに紐付いているサブカテゴリーを持ってくる $紐付いている元->リレーションメソッド -->
        @foreach($main_category->postSubCategories as $sub_category)
        <input type="submit" name="category_posts" value="{{ $sub_category->sub_category }}" form="postSearchRequest" class="search_sub_category">
        @endforeach <!-- サブカテゴリーのend -->
      </li>
      @endforeach <!-- メインカテゴリーのend -->
    </ul>
  </div>
</div>
@endsection
