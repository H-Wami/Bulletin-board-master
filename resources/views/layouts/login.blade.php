<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <!-- スマホタブレット対応 -->
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- CSRFトークン取得 -->
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Bulletin_Board</title>
  <!-- bootstrap icon-->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
  <!-- CSS -->
  <!-- <link href="{{ asset('css/reset.css') }}" rel="stylesheet"> -->
  <link href="{{ asset('css/style.css') }}" rel="stylesheet">
</head>

<body>
  <div class="login_container">
    <!-- タイトル -->
    <header class="login_header">
      @yield('title')
      <a href="{{ route('postView') }}">投稿一覧</a>
      <a href="{{ route('logout') }}">ログアウト</a>
    </header>
    <!-- 中身 -->
    <div>
      @yield('content')
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
  <script src="{{ asset('js/script.js') }}" rel="stylesheet"></script>
</body>

</html>
