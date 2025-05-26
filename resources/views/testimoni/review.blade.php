<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tulis Testimoni - Dimsum Date</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Poppins:wght@300;400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('./assets/css/dimsum.css') }}">
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
            font-family: 'Poppins', sans-serif;
            background-color: #f5f5f5;
        }

        .review-container {
            max-width: 600px;
            margin: 6rem auto 2rem;
            padding: 2rem;
            background-color: #e0e0e0;
            border-radius: 10px;
        }

        .review-title {
            color: var(--primary-color);
            text-align: center;
            margin-bottom: 2rem;
            font-family: 'Poppins', sans-serif;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-group input {
            border-radius: 10px;
        }

        input, textarea {
            width: 100%;
            padding: 0.8rem;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-family: 'Poppins', sans-serif;
        }

        textarea {
            min-height: 150px;
            resize: vertical;
        }

        .star-rating {
            text-align: center;
            margin: 1rem 0;
        }

        .star-rating i {
            color: #FFFFFF;
            font-size: 2rem;
            cursor: pointer;
            margin: 0 5px;
        }

        .star-rating i.hovered {
            color: #d8c996;
        }

        .star-rating i.active {
            color: var(--secondary-color);
        }

        .submit-btn {
            width: 100%;
            padding: 1rem;
            background-color: var(--primary-color);
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1rem;
            transition: background-color 0.3s;
        }

        .submit-btn:hover {
            background-color: #8B0000;
        }
    </style>
</head>
<body>
    <nav class="navbar" id="navbar">
        <div class="container">
            <div class="navbar-brand">
                <a href="../#home">
                    <img src="/assets/img/logo-dimsum.svg" alt="Dimsum Date" class="logo-img">
                    <span>Dimsum Date</span>
                </a>
            </div>
        </div>
    </nav>

    <a href="javascript:history.back()" class="back-button">
        <i class="fas fa-arrow-left"></i>
        <span class="back-text">Kembali</span>
    </a>

    <div class="review-container">
        <h2 class="review-title">Beri Ulasan</h2>
        <form action="/submit-review" method="POST">
            @csrf
            <div class="form-group">
                <input type="text" placeholder="Masukkan Nama" required>
            </div>
            <div class="form-group">
                <input type="email" placeholder="Masukkan Email" required>
            </div>
            <div class="form-group">
                <input type="tel" placeholder="Masukkan No Telp" required>
            </div>
            <div class="star-rating">
                <i class="fas fa-star" data-rating="1"></i>
                <i class="fas fa-star" data-rating="2"></i>
                <i class="fas fa-star" data-rating="3"></i>
                <i class="fas fa-star" data-rating="4"></i>
                <i class="fas fa-star" data-rating="5"></i>
            </div>
            <div class="form-group">
                <textarea placeholder="Tulis disini..." required></textarea>
            </div>
            <button type="submit" class="submit-btn">Send</button>
        </form>
    </div>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <script>
        const stars = document.querySelectorAll('.star-rating i');

        stars.forEach((star, idx) => {
            star.addEventListener('mouseover', () => {
                stars.forEach((s, i) => {
                    if (i <= idx) {
                        s.classList.add('hovered');
                    } else {
                        s.classList.remove('hovered');
                    }
                });
            });

            star.addEventListener('mouseout', () => {
                stars.forEach(s => s.classList.remove('hovered'));
            });
        });

        // Script klik aktif tetap dipakai:
        stars.forEach(star => {
            star.addEventListener('click', function () {
                const rating = this.dataset.rating;
                stars.forEach(s => {
                    s.classList.remove('active');
                    if (s.dataset.rating <= rating) {
                        s.classList.add('active');
                    }
                });
            });
        });
    </script>

    <script src="{{ asset('./assets/js/dimsum.js') }}"></script>
</body>
</html>
