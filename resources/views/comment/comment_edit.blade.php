@extends('layouts.login')

@section('title')

<h2>コメント編集画面</h2>

@endsection

@section('content')

<!-- バリデーションメッセージ -->
@if($errors->first('comment'))
<span class="error_message">{{ $errors->first('comment') }}</span><br>
@endif

<div class="">
  <form action="{{ route('commentUpdate') }}" method="POST">
    {{ csrf_field() }} <!-- CSRF対策 -->
    <label>コメント</label>
    <textarea class="" name="comment" value="{{ $comment->comment }}">{{ $comment->comment }}</textarea>
    <input type="hidden" name="comment_id" value="{{ $comment->id }}">
    <input type="submit" value="編集">
  </form>
  <!-- 削除ボタン -->
  <div>
    <a href="{{ route('commentDelete', ['id' => $comment->id ]) }}" onclick="return confirm('コメントを削除してもよろしいでしょうか？')">削除</a>
  </div>
</div>

@endsection
