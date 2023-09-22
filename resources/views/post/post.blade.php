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
    <p>{{ $post->actionLogs($post->id)->count() }}Views</p>
  </div>
  <!-- 投稿タイトル -->
  <div class="">
    <a href="{{ route('postDetail',['id' => $post->id]) }}">{{ $post->title }}</a>
  </div>
  <!-- 下端コンテンツまとめ -->
  <div>
    <p>{{ $post->postSubCategory->sub_category }}</p>
    <!-- コメント数 -->
    <p>コメント数 {{ $post->postComments($post->id)->count() }}</p>
    <!-- いいね -->
    <!-- ログインユーザーがいいねをしていたらいいね削除アイコン表示 -->
    @if(Auth::user()->isLike($post->id))
    <i class="bi bi-heart-fill" post_id="{{ $post->id }}"></i>
    <p></p>
    @else
    <!-- いいねをしていなければいいね登録アイコン表示 -->
    <i class="bi bi-heart" post_id="{{ $post->id }}"></i>
    <p></p>
    @endif
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
    <input type="text" name="keyword" form="postSearchRequest">
    <input type="submit" value="検索" form="postSearchRequest">
  </div>
  <!-- いいねした投稿ボタン -->
  <input type="submit" name="like_posts" value="いいねした投稿" form="postSearchRequest">
  <!-- 自分の投稿ボタン -->
  <input type="submit" name="my_posts" value="自分の投稿" form="postSearchRequest">
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
      <input type="submit" name="category_posts" value="{{ $sub_category->sub_category }}" form="postSearchRequest">
      @endforeach <!-- サブカテゴリーのend -->
      </li>
      @endforeach <!-- メインカテゴリーのend -->
    </ul>
  </div>

</div>
@endsection
