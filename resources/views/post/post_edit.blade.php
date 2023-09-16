@extends('layouts.login')

@section('title')

<h2>投稿編集画面</h2>

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

<div class="post_edit_container">
  <form method="POST">
    {{ csrf_field() }} <!-- CSRF対策 -->
    <label>サブカテゴリー</label>
    <select class="post_sub_category_id_edit" name="post_sub_category_id" value="{{ $post->post_sub_category_id }}">
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
    <label>タイトル</label>
    <input class="title_edit" type="text" name="title" value="{{ $post->title }}">
    <label>投稿内容</label>
    <textarea class="post_edit" name="post" value="{{ $post->post }}">{{ $post->post }}</textarea>
    <input type="submit" value="編集">
  </form>
  <!-- 削除ボタン -->
  <div>
    <a>削除</a>
  </div>
</div>

@endsection
