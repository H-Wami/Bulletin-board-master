@extends('layouts.logout')

@section('content')

<div class="login_container">
    <h1>Login</h1>
    <div class="login_form">
        <form action="{{ route('loginUser') }}" method="POST">
            {{ csrf_field() }} <!-- CSRF対策 -->
            <div class="login_content">
                <label>Mail Address</label>
                <input type="text" name="email" class="form-control">
            </div>
            <div class="login_content">
                <label>Password</label>
                <input type="password" name="password" class="form-control">
            </div>
            <div class="login_btn">
                <input type="submit" value="Login" class="btn btn-primary">
            </div>
        </form>
        <div class="register_link">
            <p>新規ユーザー登録は<a href="{{ route('registerView') }}">こちら</a></p>
        </div>
    </div>
</div>


@endsection
