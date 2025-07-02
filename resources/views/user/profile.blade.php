<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile - Dimsum Date</title>
    <link rel="icon" href="/assets/img/logo-dimsum.svg" type="image/svg">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Poppins:wght@300;400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        :root {
            --primary-color: #B22222;
            --secondary-color: #D4AF37;
            --dark-color: #121212;
            --light-color: #FFFFFF;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background-color: #FFFFFF;
        }

        .profile-container {
            max-width: 800px;
            margin: 6rem auto;
            padding: 0 1rem;
        }

        .profile-card {
            background: #D9D9D9;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            overflow: hidden;
        }

        .profile-header {
            padding: 1.5rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .profile-header h2 {
            color: var(--primary-color);
            font-family: 'Poppins', sans-serif;
            margin: 0;
        }

        .edit-icon {
            background: none;
            border: none;
            color: var(--primary-color);
            cursor: pointer;
            font-size: 1.2rem;
        }

        .profile-content {
            display: flex;
            gap: 2rem;
            align-items: flex-start;
            padding: 2rem;
            border-radius: 12px;
            border: 5px solid #D9D9D9;
            background-color: white;
        }

        .profile-image {
            width: 250px;
            height: 250px;
            background: #d9d9d9;
            border-radius: 10px;
            overflow: hidden;
            position: relative;
            border: 1px solid #dee2e6;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .profile-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .profile-image .placeholder-icon {
            font-size: 10rem;
            color: #000000;
        }

        .profile-info {
            flex: 1;
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
        }

        .info-group {
            display: grid;
            gap: 0.5rem;
        }

        .info-label {
            color: #666;
            font-size: 0.9rem;
            border-bottom: 1px solid #D9D9D9;
        }

        .info-value {
            color: #333;
            font-size: 1rem;
            padding-bottom: 0.5rem;
        }

        @media (max-width: 768px) {
            .profile-container {
                margin: 1rem;
            }
        }
    </style>
</head>
<body>
    <nav class="navbar">
        <div class="container">
            <div class="navbar-brand">
                <a href="../#home">
                    <img src="/assets/img/logo-dimsum.svg" alt="Dimsum Date" class="logo-img">
                    <span>Dimsum Date</span>
                </a>
            </div>
        </div>
    </nav>

    <div class="profile-container">
        <div class="profile-card">
            <div class="profile-header">
                <h2 style="font-family: 'Poppins', sans-serif">Profile</h2>
                <a href="{{ route('profileupdate') }}" class="edit-btn">
                    <i class="fas fa-pencil-alt edit-icon"></i>
                </a>
            </div>
            <div class="profile-content">
                <div class="profile-image">
                    @if ($user->profile_photo_path)
                        <img src="{{ asset('storage/' . $user->profile_photo_path) }}" alt="Profile Picture">
                    @else
                        <i class="fas fa-user placeholder-icon"></i>
                    @endif
                </div>
                <div class="profile-info">
                    <div class="info-group">
                        <div class="info-label">Nama</div>
                        <div class="info-value">{{ $user->name }}</div>
                    </div>
                    <div class="info-group">
                        <div class="info-label">Alamat</div>
                        <div class="info-value">{{ $user->address }}</div>
                    </div>
                    <div class="info-group">
                        <div class="info-label">No. Hp</div>
                        <div class="info-value">{{ $user->phone }}</div>
                    </div>
                    <div class="info-group">
                        <div class="info-label">Email</div>
                        <div class="info-value">{{ $user->email }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
