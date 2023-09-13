@extends('layouts.login')

@section('title')

<h2>カテゴリー追加画面</h2>

@endsection

@section('content')

<!-- バリデーションメッセージ -->
@if ($errors->any())
<div class="category_error">
  <ul>
    @foreach ($errors->all() as $error)
    <li>{{ $error }}</li>
    @endforeach
  </ul>
</div>
@endif

<!-- メインカテゴリー追加 -->
<form method="POST">
  {{ csrf_field() }}<!-- CSRF対策 -->
  <label>新規メインカテゴリー</label>
  <input type="text" name="main_category" value="{{ old('main_category') }}">
  <input type="submit" value="登録">
</form>

<!-- サブカテゴリー追加 -->
<form method="POST">
  {{ csrf_field() }}<!-- CSRF対策 -->
  <!-- メインカテゴリー選択 -->
  <label>メインカテゴリー</label>
  <select name="post_main_category_id">
    <option value="none"></option>
    @foreach($main_categories as $main_category)
    <option value="{{ $main_category->id }}">{{ $main_category->main_category }}</option>
    @endforeach
  </select>
  <!-- サブカテゴリー入力 -->
  <label>新規サブカテゴリー</label>
  <input type="text" name="sub_category" value="{{ old('sub_category') }}">
  <input type="submit" value="登録">
</form>

<!-- カテゴリー一覧 -->
<p>カテゴリー一覧</p>
<!-- カテゴリーひとまとめ -->
<ul>
  <!-- メインカテゴリー表示 -->
  @foreach($main_categories as $main_category)
  <li category_id="{{ $main_category->id }}"></li>
  <span>{{ $main_category->main_category }}</span>
  <!-- 対象のサブカテゴリーがなければ削除ボタン表示 -->
  <a>削除</a>
  <!-- サブカテゴリー表示 -->
  <!-- メインカテゴリーに紐付いているサブカテゴリーを持ってくる $紐付いている元->リレーションメソッド -->
  @foreach($main_category->postSubCategories as $sub_category)
  <span>{{ $sub_category->sub_category }}</span>
  <!-- 対象のサブカテゴリーの投稿がなければ削除ボタン表示 -->
  <a>削除</a>
  @endforeach <!-- サブカテゴリーのend -->
  </li>
  @endforeach <!-- メインカテゴリーのend -->
</ul>



@endsection
