@extends ('layouts.header')

@section('content')
<div class="m-10">
  {{-- 検索 --}}
  <section class="mt-10">
    <form action="index" method="get" class="mx-10">
      <input
        type="text"
        name="keyword"
        value="{{ request('keyword') }}"
        placeholder="イベント名または講師名を入力してください"
        class="border w-96 h-10 rounded p-1">
      <input
        type="date"
        name="date"
        value="{{ request('date') }}"
        class="border h-10 rounded p-1">
      <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">
        検索
      </button>
      <a href="/index" class="bg-gray-300 px-4 py-2 rounded">クリア</a>
    </form>
  </section>

  {{-- 進行中のイベント --}}
  <section class="m-10 grid gap-4">
    <h1 class="block text-left text-2xl font-bold text-gray-500">
      ≪イベント一覧≫
    </h1>
    <table class="w-full border border-gray-300 border-collapse">
      <tr class="border border-gray-300 h-12 text-lg">
        <th></th>
        <th>開催日時</th>
        <th>イベント名</th>
        <th>講師</th>
        <th>定員</th>
        <th>金額</th>
        <th></th>
      </tr>
      @foreach ($currentEvents as $currentEvent)
        <tr class="text-center h-12">
          <td class="h-16">
            <img 
              src="{{ asset('storage/event-images/' . $currentEvent->event->lesson_img1) }}" 
              alt="イベントイメージ"
              class="h-12 mx-auto">
          </td>
          <td>{{ $currentEvent->start_at->format('Y-m-d H:i') }}</td>
          <td>{{ $currentEvent->event->title }}</td>
          <td>{{ $currentEvent->event->instructor_name }}</td>
          <td>{{ $currentEvent->event->capacity }}</td>
          <td>¥{{ number_format($currentEvent->event->price) }}</td>
          <td>
            <a href="/event/{{ $currentEvent->id }}" class="bg-blue-500 text-white px-4 py-2 rounded">
              詳細
            </a>
          </td>
        </tr>
      @endforeach
    </table>
  </section>

</div>
@endsection