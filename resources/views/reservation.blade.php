@extends ('layouts.header')

@section('content')
<div class="w-[700px] mx-auto mt-20">
    <h1 class="text-3xl font-bold text-center">ご予約</h1>

    <form action="/event/reservation/{{ $schedule->id }}/confirm" method="post">
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
                    <input 
                        type="number"
                        name="participants"
                        min="1"
                        max="{{ $remainingCapacity }}"
                        value="1"
                        class="border p-2 h-8 text-sm w-60">
                </td>
                <td class="text-sm text-red-500">残り{{ $remainingCapacity }}人</td>
            </tr>
            <tr class="text-xl h-16">
                <th>支払方法</th>
                <td>
                    <select name="payment_method_id" class="border p-2 h-10 text-sm w-60">
                        <option value="">選択してください</option>
                        @foreach($paymentMethods as $paymentMethod)
                            <option value="{{ $paymentMethod->id }}">
                                {{ $paymentMethod->payment_method }}
                            </option>
                        @endforeach
                    </select>
                    <div class="text-sm text-red-500">
                        @error('payment_method_id')
                        {{ $message }}
                        @enderror
                    </div>
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
                class="bg-blue-500 text-white px-4 py-2 rounded">
                予約する
            </button>
        </div>
    </form>
</div>
@endsection