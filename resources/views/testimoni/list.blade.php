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

    <div id="loginPromptModal" class="auth-modal" style="display: none;">
        <div class="auth-modal-content">
            <span class="auth-modal-close-btn">&times;</span>
            <h3>Login Diperlukan</h3>
            <p>Anda harus login terlebih dahulu untuk melakukan tindakan ini.</p>
            <div class="auth-modal-actions">
                <a href="{{ route('login') }}" class="btn btn-primary">Login</a>
                <button type="button" class="btn btn-secondary" id="cancelLoginBtnModal">Batal</button>
            </div>
        </div>
    </div>

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

    <script>
        // --- Global Variables and Helper Functions ---
        const isAuthenticated = {{ auth()->check() ? 'true' : 'false' }};
        const loginUrl = "{{ route('login') }}";
        let loginPromptModal = null; // Will be assigned in DOMContentLoaded

        function showLoginPrompt() {
            if (loginPromptModal) {
                loginPromptModal.style.display = 'flex';
            }
        }

        function hideLoginPrompt() {
            if (loginPromptModal) {
                loginPromptModal.style.display = 'none';
            }
        }

        // --- DOMContentLoaded Event Listener for other initializations ---
        document.addEventListener("DOMContentLoaded", function () {
            // Initialize Modal Elements
            loginPromptModal = document.getElementById('loginPromptModal');
            const cancelLoginBtnModal = document.getElementById('cancelLoginBtnModal');
            const closeModalIcon = loginPromptModal ? loginPromptModal.querySelector('.auth-modal-close-btn') : null;

            if (cancelLoginBtnModal) {
                cancelLoginBtnModal.addEventListener('click', hideLoginPrompt);
            }
            if (closeModalIcon) {
                closeModalIcon.addEventListener('click', hideLoginPrompt);
            }
            window.addEventListener('click', function(event) {
                if (event.target === loginPromptModal) {
                    hideLoginPrompt();
                }
            });

            // "Tulis Testimoni" Button Validation
            const tulisTestimoniBtn = document.querySelector('a.btn-review[href="{{ route('review') }}"]');
            if (tulisTestimoniBtn) {
                tulisTestimoniBtn.addEventListener('click', function(event) {
                    if (!isAuthenticated) {
                        event.preventDefault();
                        showLoginPrompt();
                    }
                });
            }
        });
    </script>
</body>
</html>
