<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Rental Space</title>

  @vite('resources/css/app.css')
</head>
<body>
  <div class="min-h-screen flex justify-center items-center bg-gray-100">
    <div class="bg-white px-8 py-2 rounded-lg shadow-md w-96">
      
      {{-- ロゴ --}}
      <div class="flex justify-center">
          <img
            src="{{ asset('images/logo.png') }}"
            alt="Logo"
            class="w-48"
          >
      </div>
      <form method="POST" action="{{ route('login') }}" novalidate>
      @csrf

        {{-- メールアドレス＆パスワード --}}
        <div class="text-center">
          <div>
            <label for="email" class="text-sm block text-left">メールアドレス</label>
            <input
              id="email"
              type="email"
              name="email"
              class="w-full border border-gray-300 rounded px-3 py-2 h-8"
              value="{{ old('email') }}">
            {{-- 修正予定 --}}
            {{-- <p class="block text-left text-red-500 text-[10px]">メールアドレスを入力してください</p> --}}
            <div class="text-sm text-red-500">
                @error('email')
                {{ $message }}
                @enderror
            </div>
          </div>

          <div class="mt-4 mb-12">
            <label for="password" class="text-sm block text-left">パスワード</label>
            <input
              id="password"
              type="password"
              name="password"
              class="w-full border border-gray-300 rounded px-3 py-2 h-8"
              >
            {{-- 修正予定 --}}
            {{-- <p class="block text-left text-red-500 text-[10px]">パスワードを入力してください</p> --}}
            <div class="text-sm text-red-500">
                @error('password')
                {{ $message }}
                @enderror
            </div>
          </div>
        
          <button type="submit" class="w-full bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 transition">
              ログイン
          </button>
        </div>
      </form>
    </div>
  </div>
</body>
</html>