<?php

use App\Models\Menu;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\ReservationController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [AdminAuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AdminAuthController::class, 'login'])->name('login.submit');
Route::post('/send-reservation', [ReservationController::class, 'sendReservation'])->name('send.reservation');
Route::post('/newsletter', [NewsletterController::class, 'subscribe'])->name('newsletter.subscribe');
Route::get('/', [HomeController::class, 'index']);
Route::get('/testimoni/create', function () {
    return view('testimoni.review');
})->name('review');
Route::get('/testimoni/list', function () {
    return view('testimoni.list');
})->name('alltestimoni');

// Profile routes
Route::get('/profile', function () {
    return view('user.profile');
})->name('profile');

Route::get('/profile/update', function () {
    return view('user.update');
})->name('profileupdate');

Route::put('/profile', function () {
    // Add profile update logic here
    return redirect()->route('profile')->with('success', 'Profile updated successfully!');
})->name('profileupdate');
