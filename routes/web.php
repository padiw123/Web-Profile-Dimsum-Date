<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MenuLikeController;
use App\Http\Controllers\TestimoniController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

// Register routes
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.submit');

Route::get('/', [HomeController::class, 'index'])->name('dashboard')->middleware('track.visitors');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', function () {
    Auth::logout();
    return redirect()->route('dashboard')->with('success', 'Logout berhasil!');
})->name('logout');

// Password Reset Routes
Route::get('forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('reset-password', [ResetPasswordController::class, 'reset'])->name('password.update');

Route::get('/testimoni', [TestimoniController::class, 'index'])->name('testimonial.index');

// Profile routes
Route::middleware(['auth'])->group(function () {
    // Routes untuk proses verifikasi email
    Route::get('/email/verify', function () {
        return view('auth.verify-email');
    })->name('verification.notice');

    Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
        $request->fulfill();
        return redirect('/'); // Arahkan ke beranda setelah sukses verifikasi
    })->middleware('signed')->name('verification.verify');

    Route::post('/email/verification-notification', function (Request $request) {
        $request->user()->sendEmailVerificationNotification();
        return back()->with('message', 'Link verifikasi baru telah dikirim ke email Anda!');
    })->middleware('throttle:6,1')->name('verification.send');

    Route::post('/menu/{menu}/toggle-like', [MenuLikeController::class, 'toggleLike'])->name('menu.toggle-like');
});

Route::middleware(['auth', 'verified'])->group(function () {
    //Profile routes
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile');
    Route::get('/profile/update', [ProfileController::class, 'edit'])->name('profileupdate');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');

    Route::post('/reserve', [ReservationController::class, 'reserve'])->name('reserve');

    //History routes
    Route::get('/history', [HistoryController::class, 'index'])->name('listhistory');
    Route::get('/history/{order}', [HistoryController::class, 'show'])->name('detailhistory');

    // Testimoni routes
    Route::get('/testimoni/review', [TestimoniController::class, 'create'])->name('testimonial.create');
    Route::post('/testimoni/submit-review', [TestimoniController::class, 'store'])->name('testimonial.store');
    Route::get('/testimoni/history', [TestimoniController::class, 'history'])->name('testimonial.history');

    Route::get('/profile/favorites', [ProfileController::class, 'favorites'])->name('profile.favorites');
});
