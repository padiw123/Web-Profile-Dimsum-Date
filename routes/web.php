<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\ReservationController;

// Register routes
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.submit');

Route::get('/', function () {
    return view('welcome');
});
Route::get('/', [HomeController::class, 'index'])->name('dashboard');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', function () {
    Auth::logout();
    return redirect()->route('dashboard')->with('success', 'Logout berhasil!');
})->name('logout');

Route::post('/reserve', [ReservationController::class, 'reserve'])->name('reserve');
Route::post('/newsletter', [NewsletterController::class, 'subscribe'])->name('newsletter.subscribe');
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

    Route::get('/history', [HistoryController::class, 'index'])->name('listhistory');
    Route::get('/history/{order}', [HistoryController::class, 'show'])->name('detailhistory');
});

//History routes
// Route::get('/history', function () {
//     return view('history.list');
// })->name('listhistory');

// Route::get('/history/{id}', function ($id) {
//     return view('history.detail');
// })->name('detailhistory');
