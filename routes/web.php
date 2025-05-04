<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\ReservationController;
use App\Models\Menu;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/menu', function () {
    $menus = Menu::all();
    return view('menu-full', compact('menus'));
})->name('menu.full');

Route::post('/send-reservation', [ReservationController::class, 'sendReservation'])->name('send.reservation');
Route::post('/newsletter', [NewsletterController::class, 'subscribe'])->name('newsletter.subscribe');
Route::get('/', [HomeController::class, 'index']);
