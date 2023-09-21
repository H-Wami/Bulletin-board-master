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
    <p>{{ $post->event_at->format('Y年n月j日') }}</p>
    <!-- 閲覧数 -->
    <p>{{ $post->actionLogs($post->id)->count() }}Views</p>
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
    <p>コメント数 {{ $post->postComments($post->id)->count() }}</p>
    <!-- いいね -->
  </div>

  <!-- コメント一覧 -->
  <div>
    <!-- メインカテゴリーに紐付いているサブカテゴリーを持ってくる $紐付いている元->リレーションメソッド -->
    @foreach($post->postComments as $comment)
    <!-- コメントひとまとめ -->
    <div>
      <!-- 上端コンテンツまとめ -->
      <div>
        <!-- post_commentsテーブルの値->リレーションメソッド->リレーションテーブルの値取得->取得したいカラム名 -->
        <p>{{ $comment->commentUser($comment->user_id)->username }}さん</p>
        <p>{{ $comment->event_at->format('Y年n月j日') }}</p>
        <!-- もしログインユーザーならば編集ボタンを表示する -->
        @if($comment->user_id === Auth::user()->id)
        <div>
          <a href="{{ route('commentEdit', ['id' => $comment->id]) }}">編集</a>
        </div>
        @endif
      </div>
      <!-- 下端コンテンツまとめ -->
      <div>
        <p>{{ $comment->comment }}</p>
        <!-- いいね -->
      </div>
    </div>
    @endforeach
  </div>

  <!-- コメントフォーム -->
  <div>
    <!-- コメントバリデーションメッセージ -->
    @if($errors->first('comment'))
    <span class="error_message">{{ $errors->first('comment') }}</span><br>
    @endif
    <form action="{{ route('commentCreate') }}" method="POST">
      {{ csrf_field() }} <!-- CSRF対策 -->
      <textarea name="comment" placeholder="こちらからコメントできます">{{ old('comment') }}</textarea>
      <input type="hidden" name="post_id" value="{{ $post->id }} ">
      <input type="submit" value="コメント">
    </form>
  </div>

</div>
@endsection
