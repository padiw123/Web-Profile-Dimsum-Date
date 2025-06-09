<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lupa Password - Dimsum Date</title>
    {{-- Menggunakan style yang sama dengan halaman login/register --}}
    <link rel="stylesheet" href="{{ asset('./assets/css/dimsum.css') }}">
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f9f5eb;
        }
        .auth-container {
            background-color: white;
            padding: 2.5rem;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            width: 100%;
            max-width: 400px;
        }
        .auth-title {
            text-align: center;
            color: var(--primary-color);
            margin-bottom: 1.5rem;
        }
        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
        }
        .form-group input {
            width: 100%;
            padding: 0.8rem;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        .submit-btn {
            width: 100%;
            padding: 0.8rem;
            background-color: var(--primary-color);
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1rem;
            margin-top: 1rem;
        }
        .auth-link {
            text-align: center;
            margin-top: 1rem;
            display: block;
        }
    </style>
</head>
<body>
    <div class="auth-container">
        <h2 class="auth-title">Lupa Password</h2>

        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}">
            @csrf
            <div class="form-group">
                <label for="email">Alamat E-Mail</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                @error('email')
                    <span style="color: red; font-size: 0.9rem;">{{ $message }}</span>
                @enderror
            </div>
            <button type="submit" class="submit-btn">Kirim Link Reset Password</button>
        </form>
    </div>
</body>
</html>
