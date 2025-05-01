<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\ReservationController;

Route::get('/', function () {
    return view('welcome');
});
Route::post('/send-reservation', [ReservationController::class, 'sendReservation'])->name('send.reservation');
Route::post('/newsletter', [NewsletterController::class, 'subscribe'])->name('newsletter.subscribe');
