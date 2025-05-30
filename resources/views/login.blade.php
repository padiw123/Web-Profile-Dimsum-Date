<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Poppins:wght@300;400;500&display=swap" rel="stylesheet">
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
            height: 500px;
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

        .login-form {
            border-color: ;
            flex: 1;
            padding: 50px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .login-form h1 {
            text-align: center;
            font-family: 'Poppins', sans-serif;
            font-size: 2.5rem;
            margin-bottom: 30px;
            color: var(--dark-color);
        }

        .form-group {
            margin-bottom: 20px;
            position: relative;
        }

        .form-group input {
            width: 100%;
            padding: 12px 40px;
            border: 1px solid var(--primary-color);
            border-radius: 15px;
            font-size: 1rem;
            transition: border-color 0.3s ease;
        }

        .form-group input:focus {
            outline: none;
            border-color: var(--accent-color);
        }

        .form-group i {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #666;
        }

        .login-btn {
            background-color: var(--primary-color);
            color: var(--light-color);
            padding: 15px;
            width: 150px;
            border: none;
            border-radius: 25px;
            font-size: 1rem;
            cursor: pointer;
            transition: background-color 0.3s ease;
            margin-top: 10px;
        }

        .login-btn:hover {
            background-color: var(--accent-color);
        }

        @media (max-width: 768px) {
            .login-container {
                flex-direction: column;
                height: auto;
                margin: 20px;
            }

            .login-image {
                padding: 20px;
            }

            .login-form {
                padding: 30px;
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-image">
            <img src="/assets/img/logo-dimsum.png" alt="Dimsum Logo">
        </div>
        <div class="login-form">
            <h1>Login</h1>
            <form action="{{ route('login') }}" method="POST">
                <center>
                    @csrf
                    <div class="form-group">
                        <i class="fas fa-user"></i>
                        <input type="email" name="email" placeholder="E-mail" required>
                    </div>
                    <div class="form-group">
                        <i class="fas fa-lock"></i>
                        <input type="password" name="password" placeholder="Password" required>
                    </div>
                    <p style="margin-top: 10px; font-size: 0.9rem;">
                        Belum punya akun? <a href="{{ route('register') }}" style="color: #980300; text-decoration: none;">Register</a>
                    </p>
                    <button type="submit" class="login-btn">Login</button>
                </form>
            </center>
        </div>
    </div>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</body>
</html>
