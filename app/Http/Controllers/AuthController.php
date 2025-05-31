<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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

        User::create([
            'name' => $request->name,
            'address' => $request->address,
            'phone' => $request->phone,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('login')->with('success', 'Register berhasil!');
    }

    public function login(Request $request)
    {
        // 1. UBAH VALIDASI DI SINI:
        $request->validate([
            'email' => 'required|string', // Diubah dari ['required', 'email'] menjadi 'required|string'
            'password' => 'required|string',
        ]);

        $loginInput = $request->input('email'); // Ini bisa email atau nomor telepon dari form
        $password = $request->input('password');

        $isEmail = filter_var($loginInput, FILTER_VALIDATE_EMAIL);
        $remember = $request->filled('remember');
        $credentials = [];

        if ($isEmail) {
            $credentials = [
                'email' => $loginInput,
                'password' => $password,
            ];
            Log::info('[LoginAttempt] (Custom Controller) Mencoba login dengan EMAIL: ' . $loginInput);
        } else {
            // Asumsikan nomor telepon, lakukan normalisasi
            // Pastikan method normalizePhone() ada di controller ini
            $normalizedPhone = $this->normalizePhone($loginInput);

            // GANTI 'phone' dengan nama kolom di DB Anda jika berbeda
            $credentials = [
                'phone' => $normalizedPhone,
                'password' => $password,
            ];
            Log::info('[LoginAttempt] (Custom Controller) Mencoba login dengan PHONE (setelah normalisasi): ' . $normalizedPhone . ' (input asli: ' . $loginInput . ')');
        }

        // Coba login menggunakan guard 'web' (atau guard default Anda)
        if (Auth::guard('web')->attempt($credentials, $remember)) {
            $request->session()->regenerate();
            Log::info('[LoginAttempt] (Custom Controller) Login BERHASIL untuk: ' . ($isEmail ? $loginInput : $normalizedPhone ?? $loginInput));
            return redirect()->intended('/'); // atau ke dashboard Anda
        }

        // Jika login gagal
        Log::warning('[LoginAttempt] (Custom Controller) Login GAGAL untuk input: ' . $loginInput);
        return back()->withErrors([
            // Pesan error akan ditampilkan di bawah field input 'email' di form Anda
            'email' => 'E-mail atau nomor telepon tidak ditemukan atau password salah.',
        ])->withInput($request->only('email', 'remember')); // Mengembalikan input 'email' dan 'remember'
    }

    // Pastikan Anda memiliki method normalizePhone seperti ini juga:
    private function normalizePhone($phone)
    {
        // 1. Hapus semua karakter selain digit
        $normalized = preg_replace('/\D/', '', $phone);

        return $normalized;
    }
}
