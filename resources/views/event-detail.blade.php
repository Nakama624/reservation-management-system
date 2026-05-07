@extends ('layouts.header')

@section('content')
<div class="m-20">
  <h1 class="block text-left text-3xl mb-4 font-bold text-gray-500">
    ≪{{ $schedule->event->title }}≫
  </h1>
  <div class="w-98 mb-20">
    <img src="{{ asset('storage/event-images/' . $schedule->event->lesson_img1) }}"  alt="イベントイメージ">
  </div>

  <div class="mb-10 justify-center">
    <p class="flex justify-center text-4xl">
      {{ $schedule->event->catch_copy }}</p>
  </div>

  <div class="mb-20 justify-center">
    <table class="mx-auto mb-10 text-xl">
      <tr class="h-16">
        <th>日時</th>
        @if ($isPastEvent)
          @foreach ($schedule->event->schedules as $schedules)
            <td>{{$schedules->start_at->format('Y-m-d H:i')}}</td>
          @endforeach
        @else
          <td>{{$schedule->start_at->format('Y-m-d H:i')}}</td>
        @endif
      </tr>
      <tr class="h-16">
        <th>講師</th>
        <td>{{ $schedule->event->instructor_name }}</td>
      </tr>
      <tr class="h-16">
        <th>定員</th>
        <td>{{ $schedule->event->capacity }}</td>
      </tr>
    </table>
  </div>

  @if( $isPastEvent )
    <p>終了しました</p>
  @elseif( $isBookable )
    <div class="mb-8 justify-center">
      <p class="flex justify-center">残り{{ $remainingCapacity }}名</p>
    </div>

    <div class="flex justify-center">
      <a href="/event/reservation/{{ $schedule->id }}" class="bg-red-500 text-white px-20 py-2 rounded mx-auto">
        予約する
      </a>
    </div>
  @else
    <p>満席です</p>
  @endif

</div>
@endsection