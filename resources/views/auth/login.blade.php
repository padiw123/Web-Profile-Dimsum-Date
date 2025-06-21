<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="icon" href="/assets/img/logo-dimsum.svg" type="image/svg">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Poppins:wght@300;400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"> {{-- Cukup satu kali di head --}}
    <style>
        :root {
            --primary-color: #980300;
            --secondary-color: #D4AF37;
            --dark-color: #121212;
            --light-color: #FFFFFF;
            --accent-color: #320100;
            --error-color: #FF0000;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(90deg, #980300 0%, #320100 50%);
        }

        .login-container {
            width: 100%;
            max-width: 900px;
            min-height: 500px;
            background: var(--light-color);
            border-radius: 20px;
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.3);
            display: flex;
            overflow: hidden;
        }

        .login-image {
            flex: 1;
            background: #f5f5f5;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px;
        }

        .login-image img {
            max-width: 80%;
            height: auto;
        }

        .login-form-container {
            flex: 1;
            padding: 40px 50px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .login-form-container h1 {
            text-align: center;
            font-family: 'Poppins', sans-serif;
            font-size: 2.2rem;
            margin-bottom: 25px;
            color: var(--dark-color);
        }

        .login-form-container form {
            width: 100%;
        }

        .form-group {
            margin-bottom: 20px;
            position: relative;
        }

        .form-group input {
            width: 100%;
            padding: 12px 12px 12px 40px;
            border: 1px solid var(--primary-color);
            border-radius: 15px;
            font-size: 0.95rem;
            transition: border-color 0.3s ease;
        }

        .form-group input:focus {
            outline: none;
            border-color: var(--accent-color);
        }

        .form-group i.fas {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #888;
        }
        .form-actions {
            text-align: center;
            margin-top: 20px;
        }

        .login-btn {
            background-color: var(--primary-color);
            color: var(--light-color);
            padding: 12px;
            width: 180px;
            border: none;
            border-radius: 25px;
            font-size: 1rem;
            cursor: pointer;
            transition: background-color 0.3s ease;
            display: block;
            margin: 0 auto 15px auto;
        }

        .login-btn:hover {
            background-color: var(--accent-color);
        }

        .register-link {
             font-size: 0.9rem;
        }
        .register-link a {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 500;
        }
        .register-link a:hover {
            text-decoration: underline;
        }


        @media (max-width: 768px) {
            .login-container {
                flex-direction: column;
                height: auto;
                margin: 20px;
                min-height: 0;
            }

            .login-image {
                padding: 30px 20px;
                max-height: 200px;
            }
            .login-image img {
                max-width: 60%;
            }

            .login-form-container {
                padding: 30px;
            }
            .login-form-container h1 {
                font-size: 2rem;
                margin-bottom: 20px;
            }
            .login-btn {
                width: 100%; /* Tombol full width di mobile */
                padding: 14px;
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-image">
            <img src="/assets/img/logo-dimsum.png" alt="Dimsum Logo">
        </div>
        <div class="login-form-container">
            <h1>Login</h1>
            <form action="{{ route('login') }}" method="POST">
                @csrf
                <div class="form-group">
                    <i class="fas fa-user"></i>
                    <input type="text" name="email" placeholder="E-mail atau Nomor Telepon" value="{{ old('email') }}" required autofocus>
                </div>
                <div class="form-group">
                    <i class="fas fa-lock"></i>
                    <input type="password" name="password" id="password" placeholder="Password" required>
                    <i class="fas fa-eye" id="togglePassword" style="right: 15px; left: auto; cursor: pointer;"></i>
                </div>
                <div class="register-link" style="text-align: right">
                    <a href="{{ route('password.request') }}">
                        Lupa Password Anda?
                    </a>
                </div>

                @if ($errors->has('email'))
                    <p style="color: var(--error-color); font-size: 0.85rem; text-align: center; margin-bottom: 10px;">{{ $errors->first('email') }}</p>
                @elseif ($errors->has('phone'))
                     <p style="color: var(--error-color); font-size: 0.85rem; text-align: center; margin-bottom: 10px;">{{ $errors->first('phone') }}</p>
                @endif
                 @if ($errors->has('password'))
                    <p style="color: var(--error-color); font-size: 0.85rem; text-align: center; margin-bottom: 10px;">{{ $errors->first('password') }}</p>
                @endif

                <div class="form-actions">
                    <button type="submit" class="login-btn">Login</button>
                    <p class="register-link">
                        Belum punya akun? <a href="{{ route('register') }}">Register</a>
                    </p>
                </div>
            </form>
        </div>
    </div>

    <script>
        const togglePassword = document.querySelector('#togglePassword');
        const password = document.querySelector('#password');

        // Set ikon awal menjadi mata tercoret karena password disamarkan
        togglePassword.classList.remove('fa-eye');
        togglePassword.classList.add('fa-eye-slash');

        togglePassword.addEventListener('click', function (e) {
            // Ubah tipe input password menjadi teks atau sebaliknya
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);

            // Ganti ikon berdasarkan kondisi
            if (type === 'password') {
                // Jika password disamarkan, ikonnya mata tercoret
                this.classList.remove('fa-eye');
                this.classList.add('fa-eye-slash');
            } else {
                // Jika password terlihat, ikonnya mata terbuka
                this.classList.remove('fa-eye-slash');
                this.classList.add('fa-eye');
            }
        });
    </script>
</body>
</html>
