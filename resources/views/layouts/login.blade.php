<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <!-- スマホタブレット対応 -->
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Bulletin_Board</title>
  <!-- CSS -->
  <!-- <link href="{{ asset('css/reset.css') }}" rel="stylesheet">
  <link href="{{ asset('css/style.css') }}" rel="stylesheet"> -->
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

  <script src="JavaScriptファイルのURL"></script>
  <script src="JavaScriptファイルのURL"></script>
</body>

</html>
