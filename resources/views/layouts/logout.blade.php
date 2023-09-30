<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <!-- スマホタブレット対応 -->
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- CSRFトークン取得 -->
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Bulletin_Board</title>
  <!-- bootstrap-->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <!-- bootstrap icon -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
  <!-- Google icon -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Noto+Serif+JP:wght@200&family=Prata&display=swap" rel="stylesheet">
  <!-- CSS -->
  <link href="{{ asset('css/reset.css') }}" rel="stylesheet">
  <link href="{{ asset('css/style.css') }}" rel="stylesheet">
</head>

<body>

  <!-- 中身 -->
    @yield('content')

  <script src="JavaScriptファイルのURL"></script>
  <script src="JavaScriptファイルのURL"></script>
</body>

</html>
