<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <!-- スマホタブレット対応 -->
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Bulletin_Board</title>
  <!-- CSRFトークン取得 -->
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <!-- CSS -->
  <!-- <link href="{{ asset('css/reset.css') }}" rel="stylesheet">
  <link href="{{ asset('css/style.css') }}" rel="stylesheet"> -->
</head>

<body>
  <div class="logout_container">
    <!-- タイトル -->
    <header>
      @yield('title')
    </header>
    <!-- 中身 -->
    <div class="register_container">
      @yield('content')
    </div>
  </div>

  <script src="JavaScriptファイルのURL"></script>
  <script src="JavaScriptファイルのURL"></script>
</body>

</html>
