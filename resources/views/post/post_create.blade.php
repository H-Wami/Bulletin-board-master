@extends('layouts.login')

@section('title')

<h2>New Post</h2>

@endsection

@section('content')

<div class="common_container">
  <form action="{{ route('postCreate') }}" method="POST">
    {{ csrf_field() }} <!-- CSRF対策 -->
    @if($errors->has('post_sub_category_id'))
    @foreach($errors->get('post_sub_category_id') as $message)
    <span class="error_message">{{ $message }}</span><br>
    @endforeach
    @endif
    <label>サブカテゴリー</label>
    <select name="post_sub_category_id" class="form-select">
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
    @if($errors->has('title'))
    @foreach($errors->get('title') as $message)
    <span class="error_message">{{ $message }}</span><br>
    @endforeach
    @endif
    <label>タイトル</label>
    <input type="text" name="title" value="{{ old('title') }}" class="form-control">
    @if($errors->has('post'))
    @foreach($errors->get('post') as $message)
    <span class="error_message">{{ $message }}</span><br>
    @endforeach
    @endif
    <label>投稿内容</label>
    <textarea name="post" class="form-control">{{ old('post') }}</textarea>
    <input type="submit" value="投稿" class="btn btn-primary">
  </form>
</div>

@endsection
