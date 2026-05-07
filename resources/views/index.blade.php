@extends ('layouts.header')

@section('content')
<div class="m-10">
  <p class="text-2xl font-bold"> {{ $user->name }} さん、こんにちは</p>

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

  <section class="m-10 grid">
    <div class="flex justify-between items-center">
      <h1 class="text-left text-2xl font-bold text-gray-500">予約一覧</h1>
      <p class="text-red-400 text-right">※お支払後はキャンセルできません</p>
    </div>
    {{-- list --}}
    <table class="w-full border border-gray-300 border-collapse">
      <tr class="border border-gray-300 h-12 text-lg">
        <th>開催日時</th>
        <th>イベント名</th>
        <th>講師名</th>
        <th>定員</th>
        <th>予約人数</th>
        <th>支払ステータス</th>
        <th></th>
        <th></th>
      </tr>
      @foreach ($reservations as $reservation)
        <tr class="text-center h-12">
          <td>{{ $reservation->schedule->start_at->format('Y-m-d H:i') }}</td>
          <td>{{ $reservation->schedule->event->title }}</td>
          <td>{{ $reservation->schedule->event->instructor_name }}</td>
          <td>{{ $reservation->schedule->event->capacity }}</td>
          <td>{{ $reservation->participants }}</td>
          <td>{{ $reservation->payment_status }}</td>
          <td>
            @if($reservation->schedule->start_at < now())
              <span class="text-gray-400">終了</span>
            @elseif(!$reservation->is_canceled && $reservation->payment_status === "未払い")
              <form action="/canceled/{{ $reservation->id }}" method="post">
                @csrf
                @method('patch')
                <button
                  onclick="return confirm('本当にキャンセルしますか？')"
                  class="bg-red-500 text-white px-4 py-2 rounded">
                    キャンセル
                  </button>
              </form>
            @elseif($reservation->is_canceled)
              <span class="text-gray-400">キャンセル済み</span>
            @else
              <span class="text-gray-400">キャンセル不可</span>
            @endif
          </td>
          <td>
            <a href="/event/{{ $reservation->schedule->id }}" class="bg-blue-500 text-white px-4 py-2 rounded">
              詳細
            </a>
          </td>
        </tr>
      @endforeach
    </table>
  </section>
</div>








@endsection