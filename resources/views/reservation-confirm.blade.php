@extends ('layouts.header')

@section('content')
<div class="w-[700px] mx-auto mt-20">
    <h1 class="text-3xl font-bold text-center">ご予約確認</h1>

    <form action="/event/reservation/{{ $schedule->id }}/complete" method="post">
    @csrf
        <table class="w-full my-12 border border-gray-300 border-collapse">
            <tr class="text-xl h-16">
                <th>イベント名</th>
                <td>{{ $schedule->event->title }}</td>
            </tr>
            <tr class="text-xl h-16">
                <th>開催日</th>
                <td>{{ $schedule->start_at->format('Y-m-d H:i') }}</td>
            </tr>
            <tr class="text-xl h-16">
                <th>講師名</th>
                <td>{{ $schedule->event->instructor_name }}</td>
            </tr>
            <tr class="text-xl h-16">
                <th>金額</th>
                <td>¥ {{ number_format($schedule->event->price) }}</td>
            </tr>
            <tr class="text-xl h-16">
                <th>参加人数</th>
                <td>
                    <input type="number"
                        value="{{ $reserve['participants'] }}"
                        name="participants"
                        class=""
                        readonly>

                </td>
            </tr>
            <tr class="text-xl h-16">
                <th>支払方法</th>
                <td>
                    {{-- 表示用 --}}
                    <input type="text"
                        value="{{ $paymentMethod->payment_method }}"
                        class=""
                        readonly>

                    {{-- 送信用 --}}
                    <input type="hidden"
                        name="payment_method_id"
                        value="{{ $paymentMethod->id }}">
                </td>
            </tr>
            <tr class="text-xl h-16">
                <th>合計金額</th>
                <td>¥0000000 jsで</td>
            </tr>
        </table>
        <div class="flex justify-center">
            <button
                type="submit"
                class="flex justify-center">
                確定
            </button>
        </div>
    </form>
</div>
@endsection