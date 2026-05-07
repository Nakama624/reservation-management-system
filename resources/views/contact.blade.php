@extends ('layouts.header')

@section('content')
<div class="w-[500px] mx-auto mt-20">
  <h1 class="text-3xl mb-4 py-auto font-bold text-gray-500 text-center">
    お問い合わせ
  </h1>

  <form action="/contact/confirm" method="post" enctype="multipart/form-data">
  @csrf
    <div class="flex items-start mb-4">
      <label for="title" class="w-24 pt-2">件名</label>

      <div class="w-4/5">
        <input
          id="title"
          type="text"
          name="title"
          value="{{ old('title') }}"
          class="border p-1 w-full">
        <div class="text-sm text-red-500">
            @error('title')
            {{ $message }}
            @enderror
        </div>
      </div>
    </div>

    <div class="flex items-start mb-4">
      <label for="detail" class="w-24 pt-2">
          詳細
      </label>
      <div class="w-4/5">
        <textarea
          name="detail"
          id="detail"
          class="border p-1 w-full h-32"
          >{{ old('detail') }}</textarea>
        <div class="text-sm text-red-500">
          @error('detail')
          {{ $message }}
          @enderror
        </div>
      </div>
    </div>
    <div class="flex items-start mb-4">
      <label for="img" class="w-24 pt-2">
        画像
      </label>
      <div class="w-4/5">
        <input
          id="img"
          type="file"
          name="img"
          value="{{ old('img') }}"
          class="border p-1 w-full">
        <div class="text-sm text-red-500">
            @error('img')
            {{ $message }}
            @enderror
        </div>
      </div>
    </div>
    <div class="flex justify-center">
        <button
            type="submit"
            class="bg-blue-500 text-white px-4 py-2 rounded">
            確認する
        </button>
    </div>
  </form>
</div>
@endsection