@extends('layouts.logout')

@section('content')

<div class="register_container">
    <h1>New User</h1>
    <div class="register_form">
        <form action="{{ route('register') }}" method="POST">
            {{ csrf_field() }} <!-- CSRF対策 -->
            <div class="register_content">
                @if($errors->has('username'))
                @foreach($errors->get('username') as $message)
                <span class="error_message">{{ $message }}</span><br>
                @endforeach
                @endif
                <label>User Name</label>
                <input type="text" name="username" class="form-control">
            </div>
            <div class="register_content">
                @if($errors->has('email'))
                @foreach($errors->get('email') as $message)
                <span class="error_message">{{ $message }}</span><br>
                @endforeach
                @endif
                <label>Mail Address</label>
                <input type="text" name="email" class="form-control">
            </div>
            <div class="register_content">
                @if($errors->has('password'))
                @foreach($errors->get('password') as $message)
                <span class="error_message">{{ $message }}</span><br>
                @endforeach
                @endif
                <label>Password</label>
                <input type="password" name="password" class="form-control">
            </div>
            <div class="register_content">
                @if($errors->has('password_confirmation'))
                @foreach($errors->get('password_confirmation') as $message)
                <span class="error_message">{{ $message }}</span><br>
                @endforeach
                @endif
                <label>Password Confirmation</label>
                <input type="password" name="password_confirmation" class="form-control">
            </div>
            <div class="register_btn">
                <input type="submit" value="Register" onclick="return confirm('登録してよろしいですか？')" class="btn btn-primary">
            </div>
        </form>
    </div>
</div>

@endsection
