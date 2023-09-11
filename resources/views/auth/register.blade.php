@extends('layouts.logout')

@section('title')

<h1>ユーザー登録</h1>

@endsection

@section('content')

<form>
    <label>ユーザー名</label>
    <input type="text" name="username">
    <label>メールアドレス</label>
    <input type="text" name="email">
    <label>パスワード</label>
    <input type="password" name="password">
    <label>パスワード確認</label>
    <input type="password" name="password_confirm">
    <input type="submit" value="確認">

</form>

@endsection
