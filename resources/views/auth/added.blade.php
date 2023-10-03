@extends('layouts.logout')

@section('content')

<div class="added_container">
  <div class="added_contents">
    <p>登録ありがとうございます</p>

    <a href="{{ route('login') }}">ログイン画面へ</a>
  </div>
</div>
@endsection
