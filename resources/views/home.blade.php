@php
    use Illuminate\Support\Str;
@endphp

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Dimsum Date</title>
    <link rel="icon" href="/assets/img/logo-dimsum.svg" type="image/svg">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Poppins:wght@300;400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar" id="navbar">
        <div class="container">
            <div class="navbar-brand">
                <a href="#home">
                    <img src="/assets/img/logo-dimsum.svg" alt="Dimsum Date" class="logo-img">
                    <span>Dimsum Date</span>
                </a>
            </div>
            <div class="navbar-menu" id="navbarMenu">
                <ul class="navbar-nav">
                    <li class="nav-item"><a href="#home" class="nav-link">Beranda</a></li>
                    <li class="nav-item"><a href="#promo" class="nav-link">Promo</a></li>
                    <li class="nav-item"><a href="#menu" class="nav-link">Menu</a></li>
                    <li class="nav-item"><a href="#edukasi" class="nav-link">Edukasi</a></li>
                    <li class="nav-item"><a href="#testimoni" class="nav-link">Testimoni</a></li>
                    <li class="nav-item"><a href="#contact" class="nav-link">Kontak</a></li>
                    <li class="nav-item">
                        @guest
                            <a href="{{ route('login') }}" class="btn-secondary" style="padding: 0.5rem 1rem; border-radius: 10px;">Login</a>
                        @endguest

                        @auth
                            <div class="dropdown profile-dropdown">
                                <button class="dropdown-toggle" type="button" id="userDropdown">
                                    @if (auth()->user()->profile_photo_path)
                                        <img src="{{ asset('storage/' . auth()->user()->profile_photo_path) }}" alt="Profile Picture" class="profile-img">
                                    @else
                                        <i class="fas fa-user placeholder-icon" class="profile-img"></i>
                                    @endif
                                    <span>{{ auth()->user()->name }}</span>
                                    <i class="fas fa-chevron-down"></i>
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a href="{{ route('profile') }}" class="dropdown-item">Profile</a></li>
<<<<<<< HEAD
                                    <li><a href="{{ route('favorit') }}" class="dropdown-item">Favorit</a></li>
=======
                                    <li><a href="{{ route('profile.favorites') }}" class="dropdown-item">Menu Favorit</a></li>
>>>>>>> 5626a3260b67958f190755272fdc4bb4971435c0
                                    <li><a href="{{ route('testimonial.history') }}" class="dropdown-item">Riwayat Testimoni</a></li>
                                    <li><a href="{{ route('listhistory') }}" class="dropdown-item">Riwayat Pembelian</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li>
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <button type="submit" class="dropdown-item-btn" >Logout</button>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        @endauth
                    </li>
                </ul>
            </div>
            <div class="navbar-toggle" id="navbarToggle">
                <span class="bar"></span>
                <span class="bar"></span>
                <span class="bar"></span>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section id="home" class="hero">
        <div class="hero-content">
            <h1 class="hero-title">Experience Authentic Dimsum</h1>
            <p class="hero-subtitle">Handcrafted with tradition, served with passion</p>
            <div class="hero-buttons">
                <a href="#menu" class="btn btn-primary">View Menu</a>
                <a href="#contact" class="btn btn-secondary">Reserve` Table</a>
            </div>
        </div>
    </section>

    <button class="scroll-to-top" title="Scroll to top">
        <i class="fas fa-arrow-up"></i>
    </button>

    <!-- Promotions Section -->
    <section id="promo" class="promotions">
        <div class="container">
            <div class="section-header">
                <h2>Promo Tersedia</h2>
                <p>Exclusive deals for an extraordinary dining experience</p>
            </div>

            <div class="promo-slider">
                <div class="promo-arrow prev">
                    <i class="fas fa-chevron-left"></i>
                </div>

                <div class="promo-container">
                    @foreach($promos as $promo)
                        <div class="promo-slide">
                            <div class="promo-card">
                                <h3>{{ $promo->title }}</h3>
                                <div class="description">
                                    <p>{{ $promo->description }}</p>
                                    @if($promo->price)
                                        <p class="price">${{ number_format($promo->price, 2) }} <span>{{ $promo->price_note }}</span></p>
                                    @endif
                                    @if($promo->features)
                                        <ul>
                                            @foreach(json_decode($promo->features) as $feature)
                                                <li>{{ $feature }}</li>
                                            @endforeach
                                        </ul>
                                    @endif
                                </div>
                                <a href="{{ $promo->cta_link ?? '#contact' }}" class="btn btn-secondary">Book Now</a>
                            </div>
                        </div>
                        @endforeach
                </div>

                <div class="promo-arrow next">
                    <i class="fas fa-chevron-right"></i>
                </div>
            </div>

            <div class="promo-navigation">
                @foreach($promos as $index => $promo)
                    <div class="promo-dot {{ $index === 0 ? 'active' : '' }}" data-index="{{ $index }}"></div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Menu Section -->
    <section id="menu" class="menu">
        <div class="container">
            <div class="section-header">
                <h2>Menu Kami</h2>
                <p>Discover our handcrafted selection of authentic dimsum</p>
            </div>

            <div class="menu-categories">
                <button class="menu-category" data-category="favorit">Favorit</button> 
                <button class="menu-category active" data-category="all">Semua</button>
                <button class="menu-category" data-category="dimsum ayam">Dimsum Ayam</button>
                <button class="menu-category" data-category="dimsum ayam udang">Dimsum Ayam Udang</button>
                <button class="menu-category" data-category="mie">Mie</button>
                <button class="menu-category" data-category="camilan">Camilan</button>
                <button class="menu-category" data-category="paket hemat">Paket Hemat</button>
                <button class="menu-category" data-category="minuman">Minuman</button>
            </div>

<<<<<<< HEAD
            <div class="menu-grid">
                @foreach ($menus as $index => $menu)
                            <div class="menu-item ..." data-id="{{ $menu->id }}">
                            ...
                            <div class="menu-content">
                                <h3>{{ $menu->name }}</h3>

                                {{-- Tombol Favorit --}}
                                @auth
                                    <form action="{{ route('favorit.toggle', $menu->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="favorite-btn">
                                            @if(in_array($menu->id, $favoritMenuIds))
                                                <i class="fas fa-heart text-red-500"></i> {{-- Sudah difavoritkan --}}
                                            @else
                                                <i class="far fa-heart text-gray-500"></i> {{-- Belum difavoritkan --}}
                                            @endif
                                        </button>
                                    </form>
                                @endauth
                            </div>
                        </div>

                    <div class="menu-item {{ $index >= 6 ? 'hidden extra-menu' : '' }}" data-category="{{ $menu->category }}" data-id="{{ $menu->id }}">
=======
            <div id="favorite-menu-grid" class="menu-grid" style="display: none;">
                @forelse ($topFavoriteMenus as $menu)
                    {{-- ... Konten menu favorit Anda ... --}}
                    <div class="menu-item" data-category="favorit" data-id="{{ $menu->id }}">
>>>>>>> 5626a3260b67958f190755272fdc4bb4971435c0
                        <div class="menu-image">
                            @if ($menu->image_url && file_exists(public_path('assets/img/menu/' . $menu->image_url)))
                                <img src="{{ asset('assets/img/menu/' . $menu->image_url) }}" alt="{{ $menu->name }}">
                            @elseif ($menu->image_url && file_exists(storage_path('app/public/' . $menu->image_url)))
                                <img src="{{ asset('storage/' . $menu->image_url) }}" alt="{{ $menu->name }}">
                            @endif
                        </div>
                        <div class="menu-content">
                            <h3>{{ $menu->name }}</h3>
                            <span class="price">Rp {{ number_format($menu->price, 0, ',', '.') }}</span>
                            <p>{{ $menu->description }}</p>
                            <div class="menu-actions">
                                <div class="quantity-control">
                                    <button class="quantity-btn minus" onclick="updateQuantity(this, -1)"><i class="fas fa-minus"></i></button>
                                    <div class="quantity-display">0</div>
                                    <button class="quantity-btn plus" onclick="updateQuantity(this, 1)"><i class="fas fa-plus"></i></button>
                                </div>
                                <button class="like-btn" data-menu-id="{{ $menu->id }}">
                                    <i class="{{ (auth()->check() && auth()->user()->menuLikes()->where('menu_id', $menu->id)->exists()) ? 'fas' : 'far' }} fa-heart"></i>
                                    <span class="likes-count">{{ $menu->likes_count }}</span>
                                </button>
                            </div>
                        </div>
                    </div>
                @empty
                    <p>Belum ada menu favorit.</p>
                @endforelse
            </div>

            <div id="main-menu-grid" class="menu-grid">
                @foreach ($menus as $index => $menu)
                    {{-- ... Konten loop menu utama Anda ... --}}
                    <div class="menu-item {{ $index >= 6 ? 'hidden extra-menu' : '' }}" data-category="{{ $menu->category }}" data-id="{{ $menu->id }}">
                        <div class="menu-image">
                            @if ($menu->image_url && file_exists(public_path('assets/img/menu/' . $menu->image_url)))
                                <img src="{{ asset('assets/img/menu/' . $menu->image_url) }}" alt="{{ $menu->name }}">
                            @elseif ($menu->image_url && file_exists(storage_path('app/public/' . $menu->image_url)))
                                <img src="{{ asset('storage/' . $menu->image_url) }}" alt="{{ $menu->name }}">
                            @endif
                        </div>
                        <div class="menu-content">
                            <h3>{{ $menu->name }}</h3>
                            <span class="price">Rp {{ number_format($menu->price, 0, ',', '.') }}</span>
                            <p>{{ $menu->description }}</p>
                            <div class="menu-actions">
                                <div class="quantity-control">
                                    <button class="quantity-btn minus" onclick="updateQuantity(this, -1)"><i class="fas fa-minus"></i></button>
                                    <div class="quantity-display">0</div>
                                    <button class="quantity-btn plus" onclick="updateQuantity(this, 1)"><i class="fas fa-plus"></i></button>
                                </div>
                                <button class="like-btn" data-menu-id="{{ $menu->id }}">
                                    @auth
                                        <i class="{{ (auth()->user()->menuLikes()->where('menu_id', $menu->id)->exists()) ? 'fas' : 'far' }} fa-heart"></i>
                                    @else
                                        <i class="far fa-heart"></i>
                                    @endauth
                                    <span class="likes-count">{{ $menu->likes()->count() }}</span>
                                </button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="menu-cta" style="display: flex; justify-content: center; margin-top: 1.5rem;">
                <button id="toggleMenuBtn" class="btn btn-primary">View Full Menu</button>
            </div>

        </div>
    </section>

    <!-- Edukasi Section -->
    <section id="edukasi" class="info-section" style="padding: 4rem 2rem; background-color: #f9f9f9;">
        <div class="container" style="max-width: 1140px; margin: 0 auto;">
            <div class="section-header">
                <h2>Edukasi</h2>
            </div>
            <div style="display: flex; flex-wrap: wrap; align-items: center; gap: 2rem;">
                <div style="flex: 1; min-width: 300px;">
                    <img src="/assets/img/menu/ekkado2.png" alt="Apa Itu Dimsum" style="width: 100%; border-radius: 12px; box-shadow: 0 4px 12px rgba(0,0,0,0.1);">
                </div>
                <div style="flex: 1; min-width: 300px;">
                    <h2 style="color: #B22222; font-size: 2rem; margin-bottom: 1rem;">Apa Itu Dimsum?</h2>
                    <p style="font-size: 1rem; line-height: 1.6;">
                        Dimsum adalah makanan tradisional khas Tiongkok yang disajikan dalam porsi kecil dan biasanya dikukus atau digoreng ringan.
                        Hidangan ini populer karena keberagamannya dan cara penyajiannya yang sering menjadi bagian dari budaya minum teh bersama.
                    </p>
                    <h2 style="color: #B22222; font-size: 2rem; margin-top: 3rem;">Tentang Dimsum</h2>
                    <p style="max-width: 800px; margin: 1rem auto 0; font-size: 1rem;">
                        Dimsum bukan hanya makanan tradisional yang lezat, tetapi juga memiliki berbagai manfaat kesehatan. Karena umumnya dimasak dengan cara dikukus, dimsum mengandung lebih sedikit minyak dan lemak dibandingkan makanan cepat saji yang digoreng.
                    </p>
                    <p style="max-width: 800px; margin: 1rem auto 0; font-size: 1rem;">
                        Selain itu, dimsum sering kali berisi bahan-bahan bergizi seperti ayam tanpa lemak, udang kaya protein, serta sayuran yang mengandung serat. Ini membuatnya menjadi pilihan makanan yang lebih seimbang dan mendukung gaya hidup sehat.
                    </p>
                    <p style="max-width: 800px; margin: 1rem auto 0; font-size: 1rem;">
                        Karena disajikan dalam porsi kecil, dimsum juga mendorong pola makan yang moderat dan momen kebersamaan saat berbagi hidangan bersama orang lain, menjadikannya bukan hanya bermanfaat untuk tubuh, tetapi juga mempererat hubungan sosial.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section id="testimoni" class="testimonials">
        <div class="container">
            <div class="section-header">
                <h2 style="color:#B22222;">Apa Sih yang Dibicarain Pelanggan?</h2>
            </div>

            <div class="review-container">
                <div class="review-grid">
                    @forelse ($testimonials as $testimonial)
                    <div class="review-card">
                        <div class="review-stars">
                            @for ($star = 0; $star < $testimonial->rating; $star++)
                                <i class="fas fa-star"></i>
                            @endfor
                        </div>
                        <h4 class="review-text">{{ Str::words($testimonial->comment, 15, '...') }}</h4>
                        <div class="reviewer-info">
                            <div class="reviewer-name">{{ $testimonial->user->name }}</div>
                            <div class="review-date">{{ $testimonial->created_at->diffForHumans() }}</div>
                        </div>
                    </div>
                    @empty
                        <center><p>Belum ada testimoni.</p></center>
                    @endforelse
                </div>
            </div>

            <div class="review-button">
                <a href="{{ route('testimonial.create') }}" class="btn-review">Tulis Testimoni</a>
                <a href="{{ route('testimonial.index') }}" class="btn-review">Semua Testimoni</a>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="contact">
        <div class="container">
            <div class="section-header">
                <h2>Visit Us</h2>
                <p>Make a reservation or drop by for an unforgettable dimsum experience</p>
            </div>

            <div class="contact-content">
                <div class="contact-info">
                    <!-- Order Summary -->
                    <div class="order-summary">
                        <h3>Rincian Pesanan</h3>
                        <div id="orderItems" class="order-items">
                            <!-- Order items will be dynamically added here -->
                        </div>
                        <div class="order-total">
                            <h4>Total Pembayaran</h4>
                            <span id="totalAmount">Rp 0</span>
                        </div>

                    </div>

                    <div class="contact-form">
                        <h3>Detail Pemesanan</h3>
                        <form action="{{ route('reserve') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <input type="text" name="name" placeholder="Nama Lengkap" value="{{ old('name', optional(auth()->user())->name) }}" required>
                            </div>
                            <div class="form-group">
                                <input type="email" name="email" placeholder="E-Mail" value="{{ old('email', optional(auth()->user())->email) }}" required>
                            </div>
                            <div class="form-group">
                                <input type="tel" name="phone" placeholder="Nomor Telepon" value="{{ old('phone', optional(auth()->user())->phone) }}" required>
                            </div>
                            <div class="form-row">
                                <div class="form-group">
                                    <input type="date" name="date" value="{{ old('date') }}" required>
                                </div>
                                <div class="form-group">
                                    <input type="time" name="time" value="{{ old('time') }}" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <select name="guests" required>
                                    <option value="" disabled {{ old('guests') ? '' : 'selected' }}>Jumlah Orang</option>
                                    @foreach (['1' => '1 Orang', '2' => '2 Orang', '3' => '3 Orang', '4' => '4 Orang', '5' => '5 Orang', '6+' => '6+ Orang'] as $value => $label)
                                        <option value="{{ $value }}" {{ old('guests') == $value ? 'selected' : '' }}>{{ $label }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="payment-method" style="margin-bottom: 1.5rem;">
                                <select id="paymentSelect" name="payment_method" onchange="togglePaymentDetails()" required>
                                    <option value="">Pilih metode pembayaran</option>
                                    <option value="cash">Tunai di tempat</option>
                                    <option value="qris">QRIS</option>
                                    <option value="cimb">Transfer Bank - CIMB Niaga</option>
                                    <option value="mandiri">Transfer Bank - Mandiri</option>
                                </select>

                                <div id="qrisDetails" class="payment-details" style="display: none;">
                                    <img src="/assets/img/qriscode.jpg" alt="QRIS Code" class="payment-qr">
                                    <p style="color: red"><em>Setelah dibayar silahkan kirim buktinya lewat WhatsApp.</em></p>
                                </div>

                                <div id="cimbDetails" class="payment-details" style="display: none;">
                                    <p>Bank: CIMB Niaga</p>
                                    <p>No. Rekening: 123456789</p>
                                    <p>Atas Nama: Dimsum Date</p>
                                    <p style="color: red"><em>Setelah dibayar silahkan kirim buktinya lewat WhatsApp.</em></p>
                                </div>

                                <div id="mandiriDetails" class="payment-details" style="display: none;">
                                    <p>Bank: Mandiri</p>
                                    <p>No. Rekening: 987654321</p>
                                    <p>Atas Nama: Dimsum Date</p>
                                    <p style="color: red"><em>Setelah dibayar silahkan kirim buktinya lewat WhatsApp.</em></p>
                                </div>
                            </div>

                            <div class="form-group">
                                <textarea name="message" placeholder="Catatan Khusus">{{ old('message') }}</textarea>
                            </div>
                            <input type="hidden" name="ordered_items_summary" id="orderedItemsSummaryInput">
                            <input type="hidden" name="total_payment" id="totalPaymentInput">
                            <input type="hidden" name="order_items" id="orderItemsInput">
                            <button type="submit" class="btn btn-primary">Checkout</button>
                        </form>
                    </div>
                </div>

                <div class="contact-info">
                    <div class="contact-item">
                        <i class="fas fa-map-marker-alt"></i>
                        <div>
                            <h3>Find Us On Map</h3>
                            <div class="h-64 rounded-lg overflow-hidden">
                                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3967.1068223302327!2d106.15163951038814!3d-6.1163198599535535!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e418ba2eee04c2f%3A0x503397c55389611d!2sDimsum%20Date%20Ramayana%20Serang!5e0!3m2!1sid!2sid!4v1750401361264!5m2!1sid!2sid" width="400" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                            </div>
                            <p>Ruko R5 Ramayana, Kotabaru, Kec. Serang,<br> Kota Serang, Banten 42112</p>
                        </div>
                    </div>

                    <div class="contact-item">
                        <i class="fas fa-clock"></i>
                        <div>
                            <h3>Opening Hours</h3>
                            <p>Monday to Friday: 10:00 - 21:00<br>
                            Saturday & Sunday: 10:00 - 22:00</p>
                        </div>
                    </div>

                    <div class="contact-item">
                        <i class="fas fa-phone-alt"></i>
                        <div>
                            <h3>Reservations</h3>
                            <p>+62 851-7966-9785<br>dimsumdate@gmail.com</p>
                        </div>
                    </div>

                    <div class="social-links">
                        <a href="https://linktr.ee/dimsumdate?utm_source=linktree_profile_share&ltsid=c76934ad-601e-47db-ae8c-73a3d4287aa4" class="social-link" target="_blank"><img src="/assets/img/Linktree.png" alt="Linktree" style="color: #FFFFFF; width: 16px;"></a>
                        <a href="https://tiktok.com/@dimsum_date" class="social-link" target="_blank"><i class="fab fa-tiktok"></i></a>
                        <a href="https://www.instagram.com/dimsum_date?utm_source=ig_web_button_share_sheet&igsh=ZDNlZDc0MzIxNw==" class="social-link" target="_blank"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="footer-content">
                <div class="footer-logo">
                    <h2>Dimsum Date</h2>
                </div>

                <div class="footer-links">
                    <h3>Quick Links</h3>
                    <ul>
                        <li><a href="#home">Home</a></li>
                        <li><a href="#promo">Promo</a></li>
                        <li><a href="#menu">Menu</a></li>
                        <li><a href="#about">Edukasi</a></li>
                        <li><a href="#testimoni">Testimoni</a></li>
                        <li><a href="#contact">Contact</a></li>
                    </ul>
                </div>
            </div>

            <div class="footer-bottom">
                <p>&copy; 2025 Dimsum Date. All rights reserved.</p>
            </div>
        </div>
    </footer>

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

        // --- Functions for Inline Event Handlers (must be global) ---

        window.updateQuantity = function(button, change) {
            if (!isAuthenticated) {
                showLoginPrompt();
                return;
            }

            const display = button.parentElement.querySelector('.quantity-display');
            const currentValue = parseInt(display.textContent);
            const newValue = Math.max(0, currentValue + change);
            display.textContent = newValue;

            const menuItem = button.closest('.menu-item');
            const menuId = menuItem.getAttribute('data-id'); // Ambil ID menu
            const name = menuItem.querySelector('h3').textContent;
            const priceText = menuItem.querySelector('.price').textContent;
            const price = parseInt(priceText.replace(/[^0-9]/g, ''));

            updateOrderSummary(name, newValue, price, menuId); // Kirim menuId
        }

        window.updateOrderSummary = function(itemName, quantity, price, menuId) {
            const orderItems = document.getElementById('orderItems');
            const totalAmountDisplay = document.getElementById('totalAmount');
            if (!orderItems || !totalAmountDisplay) return;

            // Cari item di ringkasan pesanan berdasarkan data-id
            let itemElement = orderItems.querySelector(`[data-id="${menuId}"]`);

            if (quantity > 0) {
                if (!itemElement) {
                    itemElement = document.createElement('div');
                    itemElement.className = 'order-item';
                    itemElement.setAttribute('data-item', itemName);
                    itemElement.setAttribute('data-price', price);
                    itemElement.setAttribute('data-id', menuId); // Set data-id di sini
                    orderItems.appendChild(itemElement);
                }
                itemElement.innerHTML = `
                    <span>${itemName} x <span class="item-quantity">${quantity}</span></span>
                    <span class="item-total">Rp ${(price * quantity).toLocaleString('id-ID')}</span>
                `;
            } else if (itemElement) {
                itemElement.remove();
            }

            let total = 0;
            orderItems.querySelectorAll('.order-item').forEach(item => {
                const itemPrice = parseInt(item.getAttribute('data-price'));
                const itemQuantity = parseInt(item.querySelector('.item-quantity').textContent);
                total += itemPrice * itemQuantity;
            });
            totalAmountDisplay.textContent = `Rp ${total.toLocaleString('id-ID')}`;
        }

        window.togglePaymentDetails = function() {
            const paymentSelect = document.getElementById('paymentSelect');
            const qrisDetails = document.getElementById('qrisDetails');
            const cimbDetails = document.getElementById('cimbDetails');
            const mandiriDetails = document.getElementById('mandiriDetails');

            if(qrisDetails) qrisDetails.style.display = 'none';
            if(cimbDetails) cimbDetails.style.display = 'none';
            if(mandiriDetails) mandiriDetails.style.display = 'none';

            if(paymentSelect){
                switch(paymentSelect.value) {
                    case 'qris':
                        if(qrisDetails) qrisDetails.style.display = 'block';
                        break;
                    case 'cimb':
                        if(cimbDetails) cimbDetails.style.display = 'block';
                        break;
                    case 'mandiri':
                        if(mandiriDetails) mandiriDetails.style.display = 'block';
                        break;
                }
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

            document.querySelectorAll('.like-btn').forEach(button => {
                button.addEventListener('click', function() {
                    if (!isAuthenticated) {
                        showLoginPrompt();
                        return;
                    }

                    const menuId = this.dataset.menuId;
                    const icon = this.querySelector('i');
                    const countSpan = this.querySelector('.likes-count');
                    const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content'); // Pastikan ada meta tag CSRF

                    fetch(`/menu/${menuId}/toggle-like`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': token
                        },
                    })
                    .then(response => response.json())
                    .then(data => {
                        // Update jumlah suka
                        countSpan.textContent = data.likes_count;

                        // Update ikon hati
                        if (data.is_liked) {
                            icon.classList.remove('far'); // Hapus ikon kosong
                            icon.classList.add('fas');    // Tambah ikon penuh
                        } else {
                            icon.classList.remove('fas'); // Hapus ikon penuh
                            icon.classList.add('far');    // Tambah ikon kosong
                        }
                    })
                    .catch(error => console.error('Error:', error));
                });
            });

            const reservationForm = document.querySelector('.contact-form form');
            if (reservationForm) {
                reservationForm.addEventListener('submit', function(event) {
                    if (!isAuthenticated) {
                        event.preventDefault();
                        showLoginPrompt();
                    } else {
                        const orderItemsDiv = document.getElementById('orderItems');

                        // Isi input untuk summary teks (untuk pesan WA)
                        const summaryText = Array.from(orderItemsDiv.querySelectorAll('.order-item'))
                            .map(item => item.innerText.replace('\t', ' '))
                            .join('\n');
                        document.getElementById('orderedItemsSummaryInput').value = summaryText.trim();

                        // Isi input untuk total pembayaran
                        document.getElementById('totalPaymentInput').value = document.getElementById('totalAmount').textContent;

                        // Isi input BARU untuk data JSON (untuk disimpan ke database)
                        const structuredItems = [];
                        orderItemsDiv.querySelectorAll('.order-item').forEach(item => {
                            structuredItems.push({
                                menu_id: item.getAttribute('data-id'),
                                quantity: parseInt(item.querySelector('.item-quantity').textContent)
                            });
                        });
                        document.getElementById('orderItemsInput').value = JSON.stringify(structuredItems);
                    }
                });
            }

            // "Tulis Testimoni" Button Validation
            const tulisTestimoniBtn = document.querySelector('a.btn-review[href="{{ route('testimonial.index') }}"]');
            if (tulisTestimoniBtn) {
                tulisTestimoniBtn.addEventListener('click', function(event) {
                    if (!isAuthenticated) {
                        event.preventDefault();
                        showLoginPrompt();
                    }
                });
            }

            // Profile Dropdown Logic (only if elements exist - user is authenticated)
            const dropdownToggle = document.getElementById("userDropdown");
            const profileDropdown = document.querySelector(".profile-dropdown");

            if (dropdownToggle && profileDropdown) {
                dropdownToggle.addEventListener("click", function (e) {
                    e.stopPropagation();
                    profileDropdown.classList.toggle("show");
                });

                document.addEventListener("click", function (e) {
                    if (profileDropdown.classList.contains('show') &&
                        !profileDropdown.contains(e.target) &&
                        !dropdownToggle.contains(e.target)) {
                        profileDropdown.classList.remove("show");
                    }
                });
            }
        });
    </script>
</body>
</html>
