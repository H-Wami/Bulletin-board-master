@extends('layouts.login')

@section('title')

<h2>Comment Edit</h2>

@endsection

@section('content')

<div class="common_container">
  <form action="{{ route('commentUpdate') }}" method="POST">
    {{ csrf_field() }} <!-- CSRF対策 -->
    @if($errors->has('comment'))
    @foreach($errors->get('comment') as $message)
    <span class="error_message">{{ $message }}</span><br>
    @endforeach
    @endif
    <label>Comment</label>
    <textarea class="form-control" name="comment" value="{{ $comment->comment }}">{{ $comment->comment }}</textarea>
    <input type="hidden" name="comment_id" value="{{ $comment->id }}">
    <input type="submit" value="Edit" class="btn btn-primary">
  </form>
  <!-- 削除ボタン -->
  <div>
    <a href="{{ route('commentDelete', ['id' => $comment->id ]) }}" onclick="return confirm('コメントを削除してもよろしいでしょうか？')" class="btn btn-danger">Delete</a>
  </div>
</div>

@endsection
