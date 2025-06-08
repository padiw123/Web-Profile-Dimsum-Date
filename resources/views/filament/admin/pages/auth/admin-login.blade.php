<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ $this->getTitle() }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body class="min-h-screen flex items-center justify-center bg-gradient-to-r from-[#980300] to-[#320100]">
    <div class="login-wrapper">
        <div class="login-container">
            <div class="login-image">
                <img src="{{ asset('assets/img/logo-dimsum.png') }}" alt="Dimsum Logo">
            </div>
            <div class="login-form w-full max-w-xl p-6 bg-white rounded-xl shadow-lg">
                <h1 style="font-size: 2rem; font-weight: bold;">{{ $this->getHeading() }}</h1>

                <form wire:submit.prevent="authenticate">
                    {{ $this->form }}

                    <button type="submit" class="login-btn">
                        Login
                    </button>
                </form>
            </div>
        </div>
    </div>

    @push('styles')
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
            display:flex;
            align-items: center !important;
            justify-content: center !important;
            background: linear-gradient(to right, #a00000, #3a0000);
            padding: 20px;
            min-height: 100vh;
        }

        .fi-simple-layout,
        .fi-simple-main,
        .fi-simple-ctn,
        .fi-auth-card,
        .fi-section,
        .fi-login-page {
            max-width: 800px !important;
            width: 100% !important;
            background-color: transparent !important;
            box-shadow: none !important;
            border: none !important;
        }

        .login-container {
            max-width: 800px;
            width: 100%;
            background: var(--light-color);
            border-radius: 20px;
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.2);
            display: flex;
            overflow: hidden;
        }

        .login-image {
            flex: 1;
            background: var(--light-color);
            display: none;
            align-items: center;
            justify-content: center;
            padding: 30px;
        }

        @media (min-width: 769px) {
            .login-image { display: flex; }
        }

        .login-image img {
            max-width: 100%;
            height: auto;
            max-height: 280px;
        }

        .login-form {
            flex: 1;
            padding: 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .login-form h1 {
            text-align: center;
            font-family: 'Poppins', sans-serif;
            font-size: 1.8rem;
            margin-bottom: 25px;
            color: var(--dark-color);
        }

        .login-form .fi-fo-field-wrp {
            margin-bottom: 18px;
        }

        .login-form .fi-fo-field-wrp > label.fi-label {
            font-size: 0.875rem;
            font-weight: 500;
            color: var(--dark-color);
            margin-bottom: 6px;
            display: inline-block;
        }

        .login-form .fi-input-wrp .fi-input {
            width: 100%;
            padding: 10px 15px !important;
            border: 1px solid var(--primary-color) !important;
            border-radius: 8px !important;
            font-size: 0.9rem !important;
            background-color: var(--light-color) !important;
            color: var(--dark-color) !important;
            line-height: 1.5 !important;
        }

        .login-form .fi-input-wrp .fi-input:focus {
            outline: none !important;
            border-color: var(--accent-color) !important;
            box-shadow: 0 0 0 3px rgba(152, 3, 0, 0.25) !important;
        }

        .login-form .fi-fo-checkbox {
            display: flex;
            align-items: center;
            margin-top: 10px;
            margin-bottom: 20px;
        }

        .login-form .fi-fo-checkbox .fi-checkbox-input {
            margin-right: 8px;
            border-radius: 4px !important;
            border-color: var(--primary-color) !important;
        }

        .login-form .fi-fo-checkbox .fi-checkbox-input:checked {
            background-color: var(--primary-color) !important;
            border-color: var(--primary-color) !important;
        }

        .login-form .fi-fo-checkbox .fi-checkbox-input:checked:after {
            border-color: var(--light-color) !important;
        }

        .login-form .fi-fo-checkbox span.fi-label {
            font-size: 0.875rem;
            color: var(--dark-color);
        }

        .login-form .fi-fo-field-wrp ul {
            list-style-type: none;
            padding: 0;
            margin-top: 5px;
        }

        .login-form .fi-fo-field-wrp ul li {
            font-size: 0.75rem;
            color: var(--error-color);
            text-align: left;
        }

        .login-form .login-btn {
            background-color: var(--primary-color);
            color: var(--light-color);
            padding: 10px 20px;
            width: 100%;
            border: none;
            border-radius: 8px;
            font-size: 0.95rem;
            font-weight: 500;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.1s ease;
            margin-top: 15px;
        }

        .login-form .login-btn:hover {
            background-color: var(--accent-color);
            transform: translateY(-1px);
        }

        .login-form .login-btn:active {
            transform: translateY(0px);
        }

        @media (max-width: 768px) {
            .fi-simple-page {
                align-items: flex-start !important;
                padding-top: 30px !important;
                padding-bottom: 30px !important;
            }

            .login-wrapper {
                display: flex;
                align-items: center;
                justify-content: center;
            }

            .login-container {
                width: 100%;
                background: var(--light-color);
                border-radius: 20px;
                box-shadow: 0 15px 30px rgba(0, 0, 0, 0.2);
                display: flex;
                overflow: hidden;
                flex-direction: row;
                flex-wrap: nowrap;
            }

            .login-image {
                flex: 1 1 50%;
                min-width: 0;
                background: var(--light-color);
                display: none;
                align-items: center;
                justify-content: center;
                padding: 30px;
            }

            .login-image img {
                max-width: 80px;
            }

            .login-form {
                flex: 1 1 50%;
                min-width: 0;
                padding: 40px;
                display: flex;
                flex-direction: column;
                justify-content: center;
                max-width: 100%;
                overflow: hidden;
            }

            .login-form h1 {
                font-size: 1.6rem;
                margin-bottom: 20px;
            }

            .login-form .fi-input-wrp .fi-input {
                font-size: 0.85rem !important;
                padding: 8px 12px !important;
            }

            .login-form .login-btn {
                font-size: 0.9rem;
                padding: 10px 15px;
            }

            .login-form .fi-fo-field-wrp > label.fi-label {
                font-size: 0.8rem;
            }

            .login-form .fi-fo-checkbox span.fi-label {
                font-size: 0.8rem;
            }
        }
    </style>
    @endpush
</body>
</html>
