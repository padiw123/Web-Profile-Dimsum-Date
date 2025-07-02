<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class ForgotPasswordController extends Controller
{
    /**
     * Menampilkan form untuk meminta link reset.
     * (Sama seperti kode Anda, hanya nama view-nya harus cocok dengan file Anda)
     *
     * @return \Illuminate\View\View
     */
    public function showLinkRequestForm()
    {
        // Pastikan Anda punya file di: resources/views/auth/password/email.blade.php
        return view('auth.password.email');
    }

    /**
     * Mengirim link reset password ke email pengguna.
     * (Ini adalah logika baru untuk menggantikan trait yang hilang)
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function sendResetLinkEmail(Request $request)
    {
        // 1. Validasi input email dari form
        $request->validate(['email' => 'required|email']);

        // 2. Mengirim link reset menggunakan 'engine' bawaan Laravel
        $status = Password::broker()->sendResetLink(
            $request->only('email')
        );

        // 3. Kembali ke halaman sebelumnya dengan pesan status
        // Jika berhasil, statusnya adalah 'We have emailed your password reset link!'
        // Jika gagal (email tidak ditemukan), akan kembali dengan pesan error.
        return $status == Password::RESET_LINK_SENT
                    ? back()->with('status', __($status))
                    : back()->withInput($request->only('email'))
                            ->withErrors(['email' => __($status)]);
    }
}
