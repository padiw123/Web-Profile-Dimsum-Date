<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi Email - Dimsum Date</title>
    <link rel="stylesheet" href="{{ asset('./assets/css/dimsum.css') }}">
    <style>
        body { display: flex; justify-content: center; align-items: center; height: 100vh; background-color: #f9f5eb; text-align: center; font-family: 'Poppins', sans-serif; }
        .notice-container { background-color: white; padding: 2.5rem; border-radius: 10px; box-shadow: 0 4px 12px rgba(0,0,0,0.1); width: 100%; max-width: 550px; }
        .notice-title { color: var(--primary-color); margin-bottom: 1rem; }
        .notice-message { margin-bottom: 1.5rem; line-height: 1.6; color: #555; }
        .submit-btn { padding: 0.8rem 1.5rem; background-color: var(--primary-color); color: white; border: none; border-radius: 5px; cursor: pointer; text-decoration: none; font-size: 0.9rem; }
        .submit-btn:hover { background-color: var(--accent-color); }
        .alert-success { color: #155724; background-color: #d4edda; border-color: #c3e6cb; padding: .75rem 1.25rem; margin-bottom: 1rem; border: 1px solid transparent; border-radius: .25rem; }
    </style>
</head>
<body>
    <div class="notice-container">
        <h2 class="notice-title">Satu Langkah Lagi!</h2>

        @if (session('message'))
            <div class="alert-success">
                {{ session('message') }}
            </div>
        @endif

        <p class="notice-message">
            Terima kasih telah mendaftar! Kami telah mengirimkan link ke email Anda. Silakan klik link tersebut untuk memverifikasi akun Anda.
        </p>

        <p class="notice-message">
            Jika Anda tidak menerima email, klik tombol di bawah untuk mengirim ulang.
        </p>

        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <button type="submit" class="submit-btn">Kirim Ulang Email Verifikasi</button>
        </form>
    </div>
</body>
</html>
