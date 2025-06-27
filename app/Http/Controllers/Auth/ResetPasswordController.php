<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;

class ResetPasswordController extends Controller
{
    /**
     * Tentukan ke mana pengguna akan diarahkan setelah password direset.
     *
     * @var string
     */
    protected $redirectTo = '/'; // Arahkan ke halaman utama setelah berhasil

    /**
     * Menampilkan form untuk reset password.
     * (Metode ini sudah benar dan tidak perlu diubah)
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showResetForm(Request $request, $token = null)
    {
        return view('auth.password.reset')->with(
            ['token' => $token, 'email' => $request->email]
        );
    }

    /**
     * Menangani permintaan untuk mereset password pengguna.
     * (Ini adalah metode baru yang kita tambahkan untuk menggantikan logika trait)
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    public function reset(Request $request)
    {
        // 1. Validasi semua input dari form
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // 2. Memanggil 'engine' reset password bawaan Laravel
        // Parameter pertama adalah kredensial, parameter kedua adalah 'callback'
        // yang akan dieksekusi jika reset berhasil.
        $status = Password::broker()->reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                // 3. Callback ini hanya akan berjalan jika token dan email valid
                // Kita update password user secara manual di sini.
                $user->forceFill([
                    'password' => Hash::make($password),
                    'remember_token' => Str::random(60), // Update remember_token untuk keamanan
                ])->save();

                // Menembakkan event bahwa password telah direset
                event(new PasswordReset($user));
            }
        );

        // 4. Periksa status hasil reset. Jika berhasil, redirect. Jika gagal, kembali dengan error.
        return $status == Password::PASSWORD_RESET
                    ? redirect($this->redirectTo)->with('status', __($status))
                    : back()->withInput($request->only('email'))
                            ->withErrors(['email' => __($status)]);
    }
}
