@extends('layouts.logout')

@section('title')

<h1>ログイン</h1>

@endsection

@section('content')

<form action="{{ route('loginUser') }}" method="POST">
    {{ csrf_field() }} <!-- CSRF対策 -->
    <label>メールアドレス</label>
    <input type="text" name="email">
    <label>パスワード</label>
    <input type="password" name="password">
    <input type="submit" value="ログイン">
</form>

<p>新規ユーザー登録は<a href="{{ route('registerView') }}">こちら</a></p>

@endsection
