@extends('layouts.login')

@section('title')

<h2>新規投稿画面</h2>

@endsection

@section('content')

<!-- バリデーションメッセージ -->
@if ($errors->any())
<div class="post_error">
  <ul>
    @foreach ($errors->all() as $error)
    <li>{{ $error }}</li>
    @endforeach
  </ul>
</div>
@endif

<form action="{{ route('postCreate') }}" method="POST">
  {{ csrf_field() }} <!-- CSRF対策 -->
  <label>サブカテゴリー</label>
  <select name="post_sub_category_id">
    <option value="none"></option>
    <!-- メインカテゴリー表示 -->
    @foreach($main_categories as $main_category)
    <optgroup label="{{ $main_category->main_category }}">
      <!-- サブカテゴリー表示 -->
      <!-- メインカテゴリーに紐付いているサブカテゴリーを持ってくる $紐付いている元->リレーションメソッド -->
      @foreach($main_category->postSubCategories as $sub_category)
      <option value="{{ $sub_category->id }}">{{ $sub_category->sub_category }}</option>
      @endforeach <!-- サブカテゴリーのend -->
    </optgroup>
    @endforeach <!-- メインカテゴリーのend -->
  </select>
  <label>タイトル</label>
  <input type="text" name="title" value="{{ old('title') }}">
  <label>投稿内容</label>
  <textarea name="post">{{ old('post') }}</textarea>
  <input type="submit" value="投稿">
</form>

@endsection
