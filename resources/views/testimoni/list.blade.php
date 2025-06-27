<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Testimonials - Dimsum Date</title>
    <link rel="icon" href="/assets/img/logo-dimsum.svg" type="image/svg">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Poppins:wght@300;400;500&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #B22222;
            --secondary-color: #D4AF37;
            --dark-color: #121212;
            --light-color: #FFFFFF;
        }
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Poppins', sans-serif; background-color: #000; color: white; }
        .testimonials-container { max-width: 1200px; margin: 2rem auto; padding: 0 1rem; }
        .section-header { text-align: center; margin-top: 6rem; margin-bottom: 3rem; }
        .section-header h1 { font-family: 'Playfair Display', serif; font-size: 2.5rem; color: var(--primary-color); margin-bottom: 1rem; }
        .review-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 2rem; margin-bottom: 2rem; }
        .review-card { transition: transform 0.3s ease; }
        .review-card:hover { transform: translateY(-5px); }
        .review-stars i { color: var(--secondary-color); }
    </style>
</head>
<body>
    <nav class="navbar">
        <div class="container">
            <div class="navbar-brand">
                <a href="{{ url('/') }}">
                    <img src="/assets/img/logo-dimsum.svg" alt="Dimsum Date" class="logo-img">
                    <span>Dimsum Date</span>
                </a>
            </div>
        </div>
    </nav>

    <div class="testimonials-container">
        <div class="section-header">
            <h1>Apa Kata Pelanggan Kami?</h1>
        </div>

        <div class="review-grid">
            @forelse ($testimonials as $testimonial)
                <div class="review-card">
                    <div class="reviewer-info">
                        <div>
                            <div class="reviewer-name">{{ $testimonial->user->name }}</div>
                            <div class="review-date">{{ $testimonial->created_at->diffForHumans() }}</div>
                        </div>
                    </div>
                    <div class="review-stars">
                        @for ($star = 0; $star < $testimonial->rating; $star++)
                            <i class="fas fa-star"></i>
                        @endfor
                    </div>
                    <p class="review-text">{{ $testimonial->comment }}</p>
                </div>
            @empty
                <p>Belum ada testimoni.</p>
            @endforelse
        </div>

        <center><a href="{{ route('testimonial.create') }}" class="btn-review">Tulis Testimoni</a></center>
    </div>

    </body>
</html>
