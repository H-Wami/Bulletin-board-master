@extends('layouts.login')

@section('title')

<h2>Post Edit</h2>

@endsection

@section('content')

<div class="common_container">
  <form action="{{ route('postUpdate') }}" method="POST">
    {{ csrf_field() }} <!-- CSRF対策 -->
    @if($errors->has('post_sub_category_id'))
    @foreach($errors->get('post_sub_category_id') as $message)
    <span class="error_message">{{ $message }}</span><br>
    @endforeach
    @endif
    <label>サブカテゴリー</label>
    <select class="form-select" name="post_sub_category_id" value="{{ $post->post_sub_category_id }}">
      <option value="none"></option>
      <!-- メインカテゴリー表示 -->
      @foreach($main_categories as $main_category)
      <optgroup label="{{ $main_category->main_category }}">
        <!-- サブカテゴリー表示 -->
        <!-- メインカテゴリーに紐付いているサブカテゴリーを持ってくる $紐付いている元->リレーションメソッド -->
        @foreach($main_category->postSubCategories as $sub_category)
        <!-- 編集する投稿のサブカテゴリーと同じサブカテゴリーを選択する -->
        @if($sub_category->id === $post->post_sub_category_id)
        <option value="{{ $sub_category->id }}" selected>{{ $sub_category->sub_category }}</option>
        @else
        <option value="{{ $sub_category->id }}">{{ $sub_category->sub_category }}</option>
        @endif
        @endforeach <!-- サブカテゴリーのend -->
      </optgroup>
      @endforeach <!-- メインカテゴリーのend -->
    </select>
    @if($errors->has('title'))
    @foreach($errors->get('title') as $message)
    <span class="error_message">{{ $message }}</span><br>
    @endforeach
    @endif
    <label>タイトル</label>
    <input class="form-control" type="text" name="title" value="{{ $post->title }}">
    @if($errors->has('post'))
    @foreach($errors->get('post') as $message)
    <span class="error_message">{{ $message }}</span><br>
    @endforeach
    @endif
    <label>投稿内容</label>
    <textarea class="form-control" name="post" value="{{ $post->post }}">{{ $post->post }}</textarea>
    <input type="hidden" name="post_id" value="{{ $post->id }}">
    <input type="submit" value="編集" class="btn btn-primary">
  </form>
  <!-- 削除ボタン -->
  <div>
    <a href="{{ route('postDelete',['id' => $post->id]) }}" onclick="return confirm('投稿を削除してもよろしいでしょうか？')" class="btn btn-danger">削除</a>
  </div>
</div>

@endsection
