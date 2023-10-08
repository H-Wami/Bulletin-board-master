@extends('layouts.login')

@section('title')

<h2>Post Detail</h2>

@endsection

@section('content')
<!-- 投稿詳細 -->
<div class="common_container">
  <div class="post_detail">
    <!-- 上端コンテンツまとめ -->
    <div class="post_head">
      <!-- postsテーブルの値->リレーションメソッド->リレーションテーブルの値取得->取得したいカラム名 -->
      <div class="post_head_inner">
        <p>{{ $post->user->username }}さん</p>
        <p>{{ $post->event_at->format('Y年n月j日') }}</p>
      </div>
      <!-- 閲覧数 -->
      <p>{{ $post->actionLogs($post->id)->count() }}Views</p>
    </div>
    <!-- 2段目コンテンツまとめ -->
    <div class="post_heading">
      <!-- 投稿タイトル -->
      <div class="post_title">
        <p>{{ $post->title }}</p>
      </div>
      <!-- もしログインユーザーならば編集ボタンを表示する -->
      @if($post->user_id === Auth::user()->id)
      <div>
        <a class="btn btn-primary btn-sm" href="{{ route('postEdit', ['id' => $post->id]) }}">Edit</a>
      </div>
      @endif
    </div>
    <!-- 投稿内容 -->
    <div>
      <p>{{ $post->post }}</p>
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

  <!-- コメント一覧 -->
  <div>
    <!-- メインカテゴリーに紐付いているサブカテゴリーを持ってくる $紐付いている元->リレーションメソッド -->
    @foreach($post->postComments as $comment)
    <!-- コメントひとまとめ -->
    <div class="comment_unit">
      <!-- 上端コンテンツまとめ -->
      <div class="comment_head">
        <!-- post_commentsテーブルの値->リレーションメソッド->リレーションテーブルの値取得->取得したいカラム名 -->
        <div class="comment_head_inner">
          <p>{{ $comment->commentUser($comment->user_id)->username }}さん</p>
          <p>{{ $comment->event_at->format('Y年n月j日') }}</p>
        </div>
        <!-- もしログインユーザーならば編集ボタンを表示する -->
        @if($comment->user_id === Auth::user()->id)
        <div>
          <a href="{{ route('commentEdit', ['id' => $comment->id]) }}" class="btn btn-primary btn-sm">Edit</a>
        </div>
        @endif
      </div>
      <!-- 下端コンテンツまとめ -->
      <div class="comment_foot">
        <p>{{ $comment->comment }}</p>
        <!-- いいね -->
        <!-- ログインユーザーがいいねをしていたらいいね削除アイコン表示 -->
        @if(Auth::user()->isCommentLike($comment->id))
        <div class="like_unit">
          <i class="bi bi-heart-fill unlike_btn" post_comment_id="{{ $comment->id }}"></i>
          <p class="comment_like_counts{{ $comment->id }}">{{ $comment_favorite->commentLikeCounts($comment->id) }}</p>
        </div>
        @else
        <!-- いいねをしていなければいいね登録アイコン表示 -->
        <div class="like_unit">
          <i class="bi bi-heart like_btn" post_comment_id="{{ $comment->id }}"></i>
          <p class="comment_like_counts{{ $comment->id }}">{{ $comment_favorite->commentLikeCounts($comment->id) }}</p>
        </div>
        @endif
      </div>
    </div>
    @endforeach
  </div>

  <!-- コメントフォーム -->
  <div>
    <!-- コメントバリデーションメッセージ -->
    @if($errors->has('comment'))
    @foreach($errors->get('comment') as $message)
    <span class="error_message">{{ $message }}</span><br>
    @endforeach
    @endif
    <form action="{{ route('commentCreate') }}" method="POST">
    {{ csrf_field() }} <!-- CSRF対策 -->
      <textarea name="comment" placeholder="こちらからコメントできます" class="form-control">{{ old('comment') }}</textarea>
      <input type="hidden" name="post_id" value="{{ $post->id }} ">
      <input type="submit" value="Comment" class="btn btn-primary">
    </form>
  </div>

</div>
@endsection
