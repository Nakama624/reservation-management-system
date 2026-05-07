<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Schedule;
use App\Models\Event;


class EventController extends Controller
{
    public function eventIndex(){
        // 未来日付で開催予定があるイベントの場合
        $currentEvents = Schedule::with('event')
            ->where('start_at', '>', now())
            ->get();

        return view('event-list', [
            "currentEvents" => $currentEvents,
        ]);
    }

    public function pastEventIndex(){
        // 全ての開催が終了しているイベントの場合
        $pastEvents = Event::with('schedules')
            ->whereDoesntHave('schedules', function ($query) {
                $query->where('start_at', '>', now());
            })
            ->get();

        return view('past-event-list', [
            "pastEvents" => $pastEvents,
        ]);
    }

    public function eventDetail($schedule_id){
        // 【開催日の表示】
        // イベントの全工程を終了した場合は、すべての開催日を表示
        // まだ終了していない場合は、各scheduleの開催日を表示
        $schedule = Schedule::with('event.schedules', 'reservations')
            ->findOrFail($schedule_id);

        $totalParticipants = $schedule
            ->reservations
            ->sum("participants");

        $remainingCapacity = $schedule->event->capacity - $totalParticipants;
        $isBookable = $remainingCapacity > 0;

        $isPastEvent = $schedule->start_at < now();

        return view('event-detail', [
            "schedule" => $schedule,
            "remainingCapacity" => $remainingCapacity,
            "isBookable" => $isBookable,
            "isPastEvent" => $isPastEvent,
        ]);
    }
}
