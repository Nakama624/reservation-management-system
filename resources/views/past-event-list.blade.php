@extends ('layouts.header')

@section('content')
<div class="m-10">
  {{-- 過去のイベント --}}
  <section class="m-10 grid gap-4">
    <h1 class="block text-left text-2xl font-bold text-gray-500">
      ≪過去のイベント≫
    </h1>

    <table class="w-full border border-gray-300 border-collapse">
      <tr class="border border-gray-300 h-12 text-lg">
        <th></th>
        <th>イベント名</th>
        <th>講師</th>
        <th>金額</th>
        <th></th>
      </tr>
      @foreach ($pastEvents as $pastEvent)
        <tr class="text-center h-12">
          <td class="h-16">
            <img 
              src="{{ asset('storage/event-images/' . $pastEvent->lesson_img1) }}" 
              alt="イベントイメージ"
              class="h-12 mx-auto">
          </td>
          <td>{{ $pastEvent->title }}</td>
          <td>{{ $pastEvent->instructor_name }}</td>
          <td>¥{{ number_format($pastEvent->price) }}</td>
          <td>
            <a href="/event/{{ $pastEvent->id }}" class="bg-blue-500 text-white px-4 py-2 rounded">
              詳細
            </a>
          </td>
        </tr>
      @endforeach
    </table>
  </section>
</div>
@endsection