@extends('layouts.logout')

@section('title')

<h1>ユーザー登録</h1>

@endsection

@section('content')

<!-- バリデーションメッセージ -->
@if ($errors->any())
<div class="register_error">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<form action="{{ route('register') }}" method="POST">
    {{ csrf_field() }} <!-- CSRF対策 -->
    <label>ユーザー名</label>
    <input type="text" name="username">
    <label>メールアドレス</label>
    <input type="text" name="email">
    <label>パスワード</label>
    <input type="password" name="password">
    <label>パスワード確認</label>
    <input type="password" name="password_confirmation">
    <input type="submit" value="確認" onclick="return confirm('登録してよろしいですか？')">
</form>

@endsection
