<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('login'); // buat view ini nanti
    }
    public function showRegisterForm()
    {
        return view('Register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string',
            'phone' => 'required|string|max:15|unique:users,phone',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
        ]);

        $user = User::create([
            'name' => $request->name,
            'address' => $request->address,
            'phone' => $request->phone,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

    // Langsung loginkan user yang baru mendaftar
        Auth::login($user);

        // Alihkan ke halaman pemberitahuan verifikasi, bukan ke halaman login lagi
        return redirect()->route('verification.notice');
    }

        public function login(Request $request)
    {
        // 1. Validasi input tetap sama
        $request->validate([
            'email' => 'required|string',
            'password' => 'required|string',
        ]);

        $loginInput = $request->input('email');
        $password = $request->input('password');
        $remember = $request->filled('remember');

        // 2. Tentukan field yang akan dicari (email atau phone)
        $isEmail = filter_var($loginInput, FILTER_VALIDATE_EMAIL);
        $field = $isEmail ? 'email' : 'phone';
        $value = $isEmail ? $loginInput : $this->normalizePhone($loginInput);

        // 3. Cari user berdasarkan email atau nomor telepon
        $user = User::where($field, $value)->first();

        // 4. Cek jika user tidak ada ATAU password salah
        if (!$user || !Hash::check($password, $user->password)) {
            Log::warning('[LoginAttempt] Login GAGAL (Kredensial Salah) untuk input: ' . $loginInput);
            return back()->withErrors([
                'email' => 'E-mail atau nomor telepon tidak ditemukan atau password salah.',
            ])->withInput($request->only('email', 'remember'));
        }

        // 5. PENERAPAN: Cek apakah user sudah verifikasi email
        if (!$user->hasVerifiedEmail()) {
            Log::warning('[LoginAttempt] Login GAGAL (Belum Verifikasi) untuk user: ' . $user->email);
            // Kirim ulang email verifikasi agar pengguna bisa mencoba lagi
            $user->sendEmailVerificationNotification();

            return back()->withErrors([
                'email' => 'Akun Anda belum terverifikasi. Kami telah mengirim ulang link verifikasi ke email Anda, silakan periksa.',
            ])->withInput($request->only('email', 'remember'));
        }

        // 6. Jika semua pengecekan lolos, loginkan user
        Auth::login($user, $remember);
        $request->session()->regenerate();
        Log::info('[LoginAttempt] Login BERHASIL untuk: ' . $user->email);

        return redirect()->intended('/');
    }

    private function normalizePhone($phone)
    {
        return preg_replace('/\D/', '', $phone);
    }
}
