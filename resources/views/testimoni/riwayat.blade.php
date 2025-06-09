<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Testimoni - Dimsum Date</title>
    <link rel="icon" href="/assets/img/logo-dimsum.svg" type="image/svg">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Poppins:wght@300;400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('./assets/css/dimsum.css') }}">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body { font-family: 'Poppins', sans-serif; background-color: #f5f5f5; }
        .card { background-color: #fff; border: 1px solid #ddd; border-radius: 8px; margin-bottom: 1.5rem; }
        .card-body { padding: 1.5rem; }
        .card-title .fa-star { color: #D4AF37; }
        .container { max-width: 800px; }
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

    <div class="container" style="margin-top: 6rem;">
        <h2 class="text-center mb-4">Riwayat Testimoni Anda</h2>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @forelse ($testimonials as $testimonial)
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">
                        @for ($i = 0; $i < $testimonial->rating; $i++)
                            <i class="fas fa-star"></i>
                        @endfor
                    </h5>
                    <p class="card-text">{{ $testimonial->comment }}</p>
                    <small class="text-muted">Dikirim pada: {{ $testimonial->created_at->format('d F Y') }}</small>
                </div>
            </div>
        @empty
            <p class="text-center">Anda belum pernah memberikan testimoni.</p>
        @endforelse
    </div>

</body>
</html>
