<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\ContactController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::middleware('auth')->group(function () {
    // // 個人の予約一覧
    // Route::get('/index', [ReservationController::class, 'index'])->name('reservation.index');
    // キャンセル
    // Route::patch('/canceled/{reservation_id}', [ReservationController::class, 'canceled']);
    // イベント一覧
    // Route::get('/event/list', [EventController::class, 'eventIndex']);
    // // 過去のイベント一覧
    // Route::get('/past-event/list', [EventController::class, 'PastEventIndex']);

    // // イベント詳細
    // Route::get('/event/{reservation_id}', [EventController::class, 'eventDetail']);
    // イベント検索

    // // 予約
    // Route::get('/event/reservation/{schedule_id}', [ReservationController::class, 'reserveIndex']);
    // Route::post('/event/reservation/{event_id}', [ReservationController::class, 'reserve']);

    // 予約確認
    // Route::post('/event/reservation/{event_id}/confirm', [ReservationController::class, 'confirm']);
    // Route::post('/event/reservation/{event_id}/complete', [ReservationController::class, 'store']);

    // お問合せ一覧
    // Route::get('/contact/list', [ContactController::class, 'contactList']);
    // お問合せ詳細
    // Route::get('/contact/{contact_id}', [ContactController::class, 'contactDetail']);
    // お問合せ削除
    // Route::delete('/contact/{contact_id}', [ContactController::class, 'Destroy']);
    // お問合せ新規作成
    // Route::get('/contact', [ContactController::class, 'contact']);
    // // 確認
    // Route::post('/contact/confirm', [ContactController::class, 'confirm']);
    // お問い合わせ完了
    // Route::post('/contact/complete', [ContactController::class, 'complete']);
});



