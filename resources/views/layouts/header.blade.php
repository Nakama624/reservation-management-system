<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Rental Space</title>
  
  @vite('resources/css/app.css')
</head>
<body>
  <header class="h-20 bg-gray-100 border-b border-gray-300 flex items-center">
    <a href="/index">
      <img
        src="{{ asset('images/logo.png') }}"
        alt="Logo"
        class="w-48">
    </a>

    <a href="/events">イベント一覧</a>
    <a href="/past-events">過去のイベント一覧</a>
    <a href="/index">マイページ</a>
    <a href="/reservation">新規予約</a>
    <a href="/contact/list">お問合せ</a>


    <form method="POST" action="{{ route('logout') }}">
    @csrf
      <button type="submit">ログアウト</button>
    </form>
  </header>
  <main>
    {{-- <div class="min-h-screen flex justify-center items-center"> --}}
      @yield('content')
    {{-- </div> --}}
  </main>
</body>
</html>