<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ReservationRequest;
use App\Models\Schedule;
use App\Models\Reservation;
use App\Models\PaymentMethod;

class ReservationController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();

        $keyword = $request->input("keyword");
        $date = $request->input("date");

        $reservations = Reservation::query()
            ->where('user_id', $user->id)
            // タイトルまたは講師名で検索
            ->whereHas('schedule.event', function ($query) use ($keyword) {
                if (!empty($keyword)){
                    $query->where('title', 'like', '%' . $keyword . '%')
                    ->orWhere('instructor_name', 'like', '%' . $keyword . '%');
                }
            })

            // 開催日で検索
            ->whereHas('schedule', function ($query) use ($date) {
                if (!empty($date)){
                    $query->whereDate('start_at', $date);
                }
            })
            ->join('schedules', 'reservations.schedule_id', '=', 'schedules.id')
            ->with('schedule.event')
            ->orderBy('schedules.start_at', 'desc')
            ->select('reservations.*')
            ->get();

        return view('index', [
            'user' => $request->user(),
            'reservations' => $reservations,
            // 'pastReservations' => $pastReservations,
        ]);
    }
    // お支払が未払いの場合のみ一覧からキャンセルが可能
    public function canceled($reservation_id, Request $request){
        $canceledReservation = Reservation::where('id', $reservation_id)
            ->where('user_id', $request->user()->id)
            ->firstOrFail();

        $canceledReservation->update([
            'is_canceled' => true,
        ]);

        return redirect()->route('reservation.index');
    }


    // 予約画面を表示
    public function reserveIndex($schedule_id){
        $schedule = Schedule::with('event','reservations')
            ->findOrFail($schedule_id);

        // 既存予約の人数を総計
        $totalParticipants = $schedule
            ->reservations
            ->sum("participants");

        $remainingCapacity = $schedule->event->capacity - $totalParticipants;

        $paymentMethods = PaymentMethod::all();

        return view('reservation', [
            'schedule' => $schedule,
            'paymentMethods' => $paymentMethods,
            "remainingCapacity" => $remainingCapacity,
        ]);
    }

    // 確認画面を表示
    public function confirm(ReservationRequest $request, $schedule_id)
    {
        $schedule = Schedule::with('event')->findOrFail($schedule_id);

        $reserve = $request->only([
            'participants',
            'payment_method_id'
        ]);


        $paymentMethod = PaymentMethod::findOrFail($reserve['payment_method_id']);

        return view('reservation-confirm', [
            'schedule' => $schedule,
            'reserve' => $reserve,
            'paymentMethod' => $paymentMethod,
        ]);
    }
    // 予約確定
    public function store(Request $request, $schedule_id){

        $user = auth()->user();

        $schedule = Schedule::with('event')->findOrFail($schedule_id);

        Reservation::create([
            'user_id' => $user->id,
            'schedule_id' => $schedule->id,
            'participants' => $request->participants,
            'amount' => "1000",
            'payment_status' => "未払い",
            'payment_method_id' => $request->payment_method_id,
        ]);


        return view('reservation-complete', [
            'schedule' => $schedule,
        ]);
    }
}