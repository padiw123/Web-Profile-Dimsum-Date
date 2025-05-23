<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Testimonials - Dimsum Date</title>
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
            background-color: #000;
            color: white;
        }

        .testimonials-container {
            max-width: 1200px;
            margin: 2rem auto;
            padding: 0 1rem;
        }

        .section-header {
            text-align: center;
            margin-top: 6rem;
            margin-bottom: 3rem;
        }

        .section-header h1 {
            font-family: 'Playfair Display', serif;
            font-size: 2.5rem;
            color: var(--primary-color);
            margin-bottom: 1rem;
        }

        .review-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 2rem;
            margin-bottom: 2rem;
        }

        .review-card:hover {
            transform: translateY(-5px);
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

    <div class="testimonials-container">
        <div class="section-header">
            <h1>Apa Sih yang Dibicarain Pelanggan?</h1>
        </div>

        <div class="review-grid">
            @for ($i = 0; $i < 80; $i++)
                <div class="review-card">
                    <div class="reviewer-info">
                        <div>
                            <div class="reviewer-name">Reviewer Name</div>
                            <div class="review-date">2 days ago</div>
                        </div>
                    </div>
                    <div class="review-stars">
                        @for ($star = 0; $star < 5; $star++)
                            <i class="fas fa-star"></i>
                        @endfor
                    </div>
                    <h4 class="review-title">Amazing Dimsum!</h4>
                    <p class="review-text">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Incidunt ipsum voluptatum officia, eum necessitatibus inventore voluptatem earum consequatur a ad perspiciatis voluptas reiciendis quod perferendis praesentium sunt velit harum laboriosam.</p>
                </div>
            @endfor
        </div>

        <center><a href="{{ route('review') }}" class="btn-review">Tulis Testimoni</a></center>
    </div>

    <button class="scroll-to-top" title="Scroll to top">
        <i class="fas fa-arrow-up"></i>
    </button>

    <a href="javascript:history.back()" class="back-button">
        <i class="fas fa-arrow-left"></i>
        <span class="back-text">Kembali</span>
    </a>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script>
        // Scroll to Top functionality
        const scrollToTopBtn = document.querySelector('.scroll-to-top');

        window.addEventListener('scroll', () => {
            if (window.pageYOffset > 300) {
                scrollToTopBtn.classList.add('visible');
            } else {
                scrollToTopBtn.classList.remove('visible');
            }
        });

        scrollToTopBtn.addEventListener('click', () => {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });
    </script>
</body>
</html>
