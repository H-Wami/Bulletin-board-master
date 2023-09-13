@extends('layouts.login')

@section('title')

<h2>掲示板投稿一覧</h2>

@endsection

@section('content')

<!-- もしログインユーザーが管理者だったら -->
<a href="{{ route('categoryView') }}">カテゴリーを追加</a>

<a href="{{ route('postInput') }}">投稿</a>

@endsection
