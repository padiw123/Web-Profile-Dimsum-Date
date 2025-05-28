<?php

use App\Models\Menu;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\ReservationController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [AdminAuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AdminAuthController::class, 'login']);
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
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile');
    Route::get('/profile/update', [ProfileController::class, 'edit'])->name('profileupdate');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profileupdate.put');
});

// Register routes
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.submit');
