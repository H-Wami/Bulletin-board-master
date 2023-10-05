@extends('layouts.login')

@section('title')

<h2>New Category</h2>

@endsection

@section('content')
<div class="category_form">
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

  <!-- メインカテゴリー作成 -->
  <div>
    <form action="{{ route('mainCategoryCreate') }}" method="POST">
      {{ csrf_field() }}<!-- CSRF対策 -->
      <label>新規メインカテゴリー</label>
      <input type="text" name="main_category" value="{{ old('main_category') }}" class="form-control">
      <input type="submit" value="登録" class="btn btn-danger">
    </form>
  </div>

  <!-- サブカテゴリー作成 -->
  <div>
    <form action="{{ route('subCategoryCreate') }}" method="POST">
      {{ csrf_field() }}<!-- CSRF対策 -->
      <!-- メインカテゴリー選択 -->
      <label>メインカテゴリー</label>
      <select name="post_main_category_id" class="form-select">
        <option value="none"></option>
        @foreach($main_categories as $main_category)
        <option value="{{ $main_category->id }}">{{ $main_category->main_category }}</option>
        @endforeach
      </select>
      <!-- サブカテゴリー入力 -->
      <label>新規サブカテゴリー</label>
      <input type="text" name="sub_category" value="{{ old('sub_category') }}" class="form-control">
      <input type="submit" value="登録" class="btn btn-danger">
    </form>
  </div>
</div>

<!-- カテゴリー一覧 -->
<div class="category_list">
  <p class="category_list_title">Category List</p>
  <!-- カテゴリーひとまとめ -->
  <ul>
    <!-- メインカテゴリー表示 -->
    @foreach($main_categories as $main_category)
    <li category_id="{{ $main_category->id }}">
      <span class="main_category_item">{{ $main_category->main_category }}</span>
      <!-- メインカテゴリーの中にサブカテゴリーがなければ削除ボタン表示
      post_main_categoriesテーブルのidカラムの値が
      post_sub_categoriesテーブルのpost_main_category_idカラムの値に存在しない時削除ボ タンを表示-->
      @if(empty($main_category->postSubCategories->first()))
      <a href="{{ route('mainCategoryDelete',['id' => $main_category->id]) }}" onclick="return confirm('メインカテゴリーを削除してもよろしいでしょうか？')" class="btn btn-danger btn-sm">Delete</a>
      @endif
      <!-- サブカテゴリー表示 -->
      <!-- メインカテゴリーに紐付いているサブカテゴリーを持ってくる $紐付いている元->リレーションメソッド -->
      @foreach($main_category->postSubCategories as $sub_category)
      <div class="sub_category_group">
        <span class="sub_category_item">{{ $sub_category->sub_category }}</span>
        <!-- もし対象のサブカテゴリーの投稿(リレーション先postsメソッド)を取得し、その値がなければ削除ボタン表示
        post_sub_categoriesテーブルのidカラムの値が
        postsテーブルのpost_sub_category_idカラムの値に存在しない時削除ボタンを表示 -->
        @if(empty($sub_category->posts->first()))
        <a href="{{ route('subCategoryDelete',['id' => $sub_category->id]) }}" onclick="return confirm('サブカテゴリーを削除してもよろしいでしょうか？')" class="badge text-bg-danger">Delete</a>
        @endif
      </div>
      @endforeach <!-- サブカテゴリーのend -->
    </li>
    @endforeach <!-- メインカテゴリーのend -->
  </ul>
</div>


@endsection
