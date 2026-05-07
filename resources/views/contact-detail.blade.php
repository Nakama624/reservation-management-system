@extends ('layouts.header')

@section('content')
<div class="w-[500px] mx-auto mt-20">
  <h1 class="text-3xl mb-4 py-auto font-bold text-gray-500 text-center">
    お問合せ確認
  </h1>

  <div class="border p-4">
    {{-- 件名 --}}
    <div class="flex items-start mb-4">
      <p class="w-24 pt-2">件名</p>
      <div class="w-4/5">
        <div class="p-1 w-full">{{ $contact->title }}</div>
      </div>
    </div>
    {{-- 詳細 --}}
    <div class="flex items-start mb-4">
      <p class="w-24 pt-2">詳細</p>
      <div class="w-4/5">
        <div class="p-1 w-full h-32">{{ $contact->detail }}</div>
      </div>
    </div>
    {{-- 画像 --}}
    <div class="flex items-start mb-4">
      <p class="w-24 pt-2">画像</p>
      <div class="w-4/5">
        <img src="{{ asset('storage/' . $contact->img) }}" class="w-40">
      </div>
    </div>
    {{-- ボタン --}}
    <div>
      <a href="/contact/list" class="bg-blue-500 text-white p-2 rounded m-4">
        一覧へ戻る
      </a>
    </div>
  </div>
</div>
@endsection