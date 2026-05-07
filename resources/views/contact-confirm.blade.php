@extends ('layouts.header')

@section('content')
<div class="w-[500px] mx-auto mt-20">
  <h1 class="text-3xl mb-4 py-auto font-bold text-gray-500 text-center">
    お問合せ確認
  </h1>

  <form
    action="/contact/complete"
    method="post"
    class="border p-4">
  @csrf
    {{-- 件名 --}}
    <div class="flex items-start mb-4">
      <p class="w-24 pt-2">件名</p>
      <div class="w-4/5">
        <div class="p-1 w-full">{{ $contact['title'] }}</div>
      </div>
      <input type="hidden" name="title" value="{{ $contact['title'] }}">
    </div>
    {{-- 詳細 --}}
    <div class="flex items-start mb-4">
      <p class="w-24 pt-2">詳細</p>
      <div class="w-4/5">
        <div class="p-1 w-full h-32">{{ $contact['detail'] }}</div>
      </div>
      <input type="hidden" name="detail" value="{{ $contact['detail'] }}">
    </div>
    {{-- 画像 --}}
    <div class="flex items-start mb-4">
      <p class="w-24 pt-2">画像</p>
      <div class="w-4/5">
        @if (!empty($contact['img']))
            <img src="{{ asset('storage/' . $contact['img']) }}" class="w-40">
            <input type="hidden" name="img" value="{{ $contact['img'] }}">
        @else
            <p>画像なし</p>
        @endif
      </div>
    </div>
    {{-- ボタン --}}
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