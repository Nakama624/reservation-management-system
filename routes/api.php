<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ContactController;
use App\Http\Controllers\Api\ReservationController;
use App\Http\Controllers\Api\EventController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// 予約一覧へ
Route::get('/reservation/list', [ReservationController::class, 'index']);
// 予約入力へ
Route::get('/event/{schedule_id}/reservation', [ReservationController::class, 'reserveIndex']);
// 予約確認・完了へ(入力値は検索と同じようにパラメータで保持するためGet)
Route::get('/event/{schedule_id}/reservation/confirm', [ReservationController::class, 'confirm']);
Route::post('/event/{schedule_id}/reservation/complete', [ReservationController::class, 'store']);
// 予約キャンセル
Route::patch('/reservation/{reservation_id}/canceled', [ReservationController::class, 'canceled']);
// 予約詳細
Route::get('/reservation/{reservation_id}', [ReservationController::class, 'detail']);

// イベント一覧
Route::get('/event/list', [EventController::class, 'eventIndex']);
// 過去のイベント一覧
Route::get('/past-event/list', [EventController::class, 'PastEventIndex']);
// イベント詳細
Route::get('/event/{reservation_id}', [EventController::class, 'eventDetail']);

// お問合せ　新規作成・一覧・詳細
Route::get('/contact', [ContactController::class, 'contact']);
Route::get('/contact/list', [ContactController::class, 'contactList']);
Route::get('/contact/{contact_id}', [ContactController::class, 'contactDetail']);
// 確認
Route::post('/contact/confirm', [ContactController::class, 'confirm']);
// お問い合わせ完了
Route::post('/contact/complete', [ContactController::class, 'complete']);


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
