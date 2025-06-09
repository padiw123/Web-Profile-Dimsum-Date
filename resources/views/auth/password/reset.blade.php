<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password - Dimsum Date</title>
    {{-- Menggunakan style yang sama dengan halaman login/register --}}
    <link rel="stylesheet" href="{{ asset('./assets/css/dimsum.css') }}">
    <style>
        /* Anda bisa menggunakan style yang sama persis dengan email.blade.php */
        body { display: flex; justify-content: center; align-items: center; height: 100vh; background-color: #f9f5eb; }
        .auth-container { background-color: white; padding: 2.5rem; border-radius: 10px; box-shadow: 0 4px 12px rgba(0,0,0,0.1); width: 100%; max-width: 400px; }
        .auth-title { text-align: center; color: var(--primary-color); margin-bottom: 1.5rem; }
        .form-group { margin-bottom: 1rem; }
        .form-group label { display: block; margin-bottom: 0.5rem; font-weight: 500; }
        .form-group input { width: 100%; padding: 0.8rem; border: 1px solid #ddd; border-radius: 5px; }
        .submit-btn { width: 100%; padding: 0.8rem; background-color: var(--primary-color); color: white; border: none; border-radius: 5px; cursor: pointer; font-size: 1rem; margin-top: 1rem; }
    </style>
</head>
<body>
    <div class="auth-container">
        <h2 class="auth-title">Reset Password</h2>
        <form method="POST" action="{{ route('password.update') }}">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">
            <div class="form-group">
                <label for="email">Alamat E-Mail</label>
                <input id="email" type="email" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>
                @error('email')
                    <span style="color: red; font-size: 0.9rem;">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="password">Password Baru</label>
                <input id="password" type="password" name="password" required autocomplete="new-password">
                @error('password')
                    <span style="color: red; font-size: 0.9rem;">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="password-confirm">Konfirmasi Password</label>
                <input id="password-confirm" type="password" name="password_confirmation" required autocomplete="new-password">
            </div>
            <button type="submit" class="submit-btn">Reset Password</button>
        </form>
    </div>
</body>
</html>
