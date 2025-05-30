@php
    use Illuminate\Support\Str;
@endphp

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dimsum Date</title>
    <link rel="icon" href="/assets/img/logo-dimsum.svg" type="image/svg">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Poppins:wght@300;400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('./assets/css/dimsum.css') }}">
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
                    <li class="nav-item"><a href="#about" class="nav-link">Edukasi</a></li>
                    <li class="nav-item"><a href="#testimoni" class="nav-link">Testimoni</a></li>
                    <li class="nav-item"><a href="#contact" class="nav-link">Kontak</a></li>
                    <li class="nav-item nav-item-login">
                        @guest
                            <a href="{{ route('login') }}" class="btn-secondary" style="padding: 0.5rem 1rem; border-radius: 10px;">Login</a>
                        @endguest

                        @auth
                            <div class="dropdown profile-dropdown">
                                <button class="dropdown-toggle" type="button" id="userDropdown">
                                    <img src="{{ asset('./assets/img/logo-dimsum.jpg') }}" alt="Profile" class="profile-img">
                                    <span>{{ auth()->user()->name }}</span>
                                    <i class="fas fa-chevron-down"></i>
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a href="{{ route('profile') }}" class="dropdown-item">Profile</a></li>
                                    <li><a href="{{ route('listhistory') }}" class="dropdown-item">History</a></li>
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
                <a href="#contact" class="btn btn-secondary">Reserve Table</a>
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
                <button class="menu-category active" data-category="all">Semua</button>
                <button class="menu-category" data-category="dimsum ayam">Dimsum Ayam</button>
                <button class="menu-category" data-category="dimsum ayam udang">Dimsum Ayam Udang</button>
                <button class="menu-category" data-category="mie">Mie</button>
                <button class="menu-category" data-category="camilan">Camilan</button>
                <button class="menu-category" data-category="paket hemat">Paket Hemat</button>
                <button class="menu-category" data-category="minuman">Minuman</button>
            </div>

            <div class="menu-grid">
                @foreach ($menus as $index => $menu)
                    <div class="menu-item {{ $index >= 6 ? 'hidden extra-menu' : '' }}" data-category="{{ $menu->category }}">
                        <div class="menu-image">
                            <img src="{{ $menu->image_url }}" alt="{{ $menu->name }}">
                        </div>
                        <div class="menu-content">
                            <h3>{{ $menu->name }}</h3>
                            <span class="price">Rp {{ number_format($menu->price, 0, ',', '.') }}</span>
                            <p>{{ $menu->description }}</p>
                            <div class="quantity-control">
                                <button class="quantity-btn minus" onclick="updateQuantity(this, -1)">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <div class="quantity-display">0</div>
                                <button class="quantity-btn plus" onclick="updateQuantity(this, 1)">
                                    <i class="fas fa-plus"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="menu-cta text-center mt-4">
                <button id="toggleMenuBtn" class="btn btn-primary">View Full Menu</button>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="about">
        <div class="container">
            <div class="about-content">
                <div class="about-image">
                    <img src="" alt="About Dimsum Date">
                </div>
                <div class="about-text">
                    <div class="section-header">
                        <h2>Our Story</h2>
                    </div>
                    <p>Founded in 1985 by Master Chef Liu, Dimsum Date has been serving authentic dimsum for over three decades. Our recipes have been passed down through generations, preserving the art and tradition of handcrafted dimsum.</p>
                    <p>Each dimsum is meticulously prepared by our team of skilled chefs who have trained for years to perfect their craft. We source only the freshest ingredients daily to ensure exceptional quality and flavor in every bite.</p>
                    <p>Our restaurant combines traditional Chinese aesthetics with modern comfort, creating a warm and inviting atmosphere for an unforgettable dining experience.</p>
                    <a href="#contact" class="btn btn-secondary">Contact Us</a>
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
                    @for ($i = 0; $i < 8; $i++)
                    <div class="review-card">
                        <div class="review-stars">
                            @for ($star = 0; $star < 5; $star++)
                                <i class="fas fa-star"></i>
                            @endfor
                        </div>
                        <h4 class="review-text">{{ Str::words('Lorem ipsum dolor, sit amet consectetur adipisicing elit. Quasi ex perferendis minima quibusdam, pariatur et animi voluptates accusantium harum ipsa atque repellendus qui totam nam, voluptate sit iusto impedit dignissimos.', 15, '...') }}</h4>
                            {{-- <img src="" alt="Reviewer" class="reviewer-image"> --}}
                            <div class="reviewer-info">
                                <div class="reviewer-name">Reviewer Name</div>
                                <div class="review-date">2 days ago</div>
                            </div>
                    </div>
                    @endfor
                </div>
            </div>

            <div class="review-button">
                <a href="{{ route('review') }}" class="btn-review">Tulis Testimoni</a>
                <a href="{{ route('alltestimoni') }}" class="btn-review">Semua Testimoni</a>
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

                        <div class="payment-method">
                            <h4>Metode Pembayaran</h4>
                            <select id="paymentSelect" onchange="togglePaymentDetails()">
                                <option value="">Pilih metode pembayaran</option>
                                <option value="qris">QRIS</option>
                                <option value="cimb">Transfer Bank - CIMB Niaga</option>
                                <option value="mandiri">Transfer Bank - Mandiri</option>
                            </select>

                            <div id="qrisDetails" class="payment-details" style="display: none;">
                                <img src="path/to/qris-code.png" alt="QRIS Code" class="payment-qr">
                            </div>

                            <div id="cimbDetails" class="payment-details" style="display: none;">
                                <p>Bank: CIMB Niaga</p>
                                <p>No. Rekening: 123456789</p>
                                <p>Atas Nama: Dimsum Date</p>
                            </div>

                            <div id="mandiriDetails" class="payment-details" style="display: none;">
                                <p>Bank: Mandiri</p>
                                <p>No. Rekening: 987654321</p>
                                <p>Atas Nama: Dimsum Date</p>
                            </div>
                        </div>
                    </div>

                    <div class="contact-form">
                        <h3>Detail Pemesanan</h3>
                        <form action="{{ route('send.reservation') }}" method="POST" target="_blank">
                            @csrf
                            <div class="form-group">
                                <input type="text" name="name" placeholder="Nama Lengkap" value="{{ old('name') }}" required>
                            </div>
                            <div class="form-group">
                                <input type="email" name="email" placeholder="E-Mail" value="{{ old('email') }}" required>
                            </div>
                            <div class="form-group">
                                <input type="tel" name="phone" placeholder="Nomor Telepon" value="{{ old('phone') }}" required>
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
                            <div class="form-group">
                                <textarea name="message" placeholder="Catatan Khusus">{{ old('message') }}</textarea>
                            </div>
                            <input type="hidden" name="ordered_items_summary" id="orderedItemsSummaryInput">
                            <input type="hidden" name="total_payment" id="totalPaymentInput">
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
                                <iframe
                                    class="w-full h-full"
                                    frameborder="0"
                                    scrolling="no"
                                    marginheight="0"
                                    marginwidth="0"
                                    allowfullscreen
                                    loading="lazy"
                                    referrerpolicy="no-referrer-when-downgrade"
                                    src="https://maps.google.com/maps?q=-6.116312383077391, 106.15421359101309&z=15&output=embed">
                                </iframe>
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
                    <p>Authentic Dimsum Since 1985</p>
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

                <div class="footer-newsletter">
                    @if(session('success'))
                        <p style="color: green;">{{ session('success') }}</p>
                    @endif

                    <form action="{{ route('newsletter.subscribe') }}" method="POST" class="newsletter-form">
                        @csrf
                        <input type="email" name="email" placeholder="Your Email" required>
                        <button type="submit"><i class="fas fa-paper-plane"></i></button>
                    </form>
                </div>
            </div>

            <div class="footer-bottom">
                <p>&copy; 2025 Dimsum Date. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script src="{{ asset('./assets/js/dimsum.js') }}"></script>
    @auth
        <script>
            document.addEventListener("DOMContentLoaded", function () {
                const dropdownToggle = document.getElementById("userDropdown");
                const profileDropdown = document.querySelector(".profile-dropdown");

                if (dropdownToggle && profileDropdown) {
                    dropdownToggle.addEventListener("click", function (e) {
                        e.stopPropagation();
                        profileDropdown.classList.toggle("show");
                    });

                    document.addEventListener("click", function (e) {
                        if (!profileDropdown.contains(e.target)) {
                            profileDropdown.classList.remove("show");
                        }
                    });
                }
            });
        </script>
        @endauth

    <script>
    function updateQuantity(button, change) {
        const display = button.parentElement.querySelector('.quantity-display');
        const currentValue = parseInt(display.textContent);
        const newValue = Math.max(0, currentValue + change);
        display.textContent = newValue;

        // Get menu item details
        const menuItem = button.closest('.menu-item');
        const name = menuItem.querySelector('h3').textContent;
        const price = parseInt(menuItem.querySelector('.price').textContent.replace(/[^0-9]/g, ''));

        updateOrderSummary(name, newValue, price);
    }

    function updateOrderSummary(itemName, quantity, price) {
        const orderItems = document.getElementById('orderItems');
        const totalAmount = document.getElementById('totalAmount');

        // Update or add item to order summary
        let itemElement = orderItems.querySelector(`[data-item="${itemName}"]`);
        if (quantity > 0) {
            if (!itemElement) {
                itemElement = document.createElement('div');
                itemElement.className = 'order-item';
                itemElement.setAttribute('data-item', itemName);
                itemElement.innerHTML = `
                    <span>${itemName} x <span class="item-quantity">${quantity}</span></span>
                    <span class="item-total">Rp ${(price * quantity).toLocaleString()}</span>
                `;
                orderItems.appendChild(itemElement);
            } else {
                itemElement.querySelector('.item-quantity').textContent = quantity;
                itemElement.querySelector('.item-total').textContent = `Rp ${(price * quantity).toLocaleString()}`;
            }
        } else if (itemElement) {
            itemElement.remove();
        }

        // Update total amount
        let total = 0;
        orderItems.querySelectorAll('.order-item').forEach(item => {
            total += parseInt(item.querySelector('.item-total').textContent.replace(/[^0-9]/g, ''));
        });
        totalAmount.textContent = `Rp ${total.toLocaleString()}`;
    }

    function togglePaymentDetails() {
        const paymentSelect = document.getElementById('paymentSelect');
        const qrisDetails = document.getElementById('qrisDetails');
        const cimbDetails = document.getElementById('cimbDetails');
        const mandiriDetails = document.getElementById('mandiriDetails');

        // Hide all payment details first
        qrisDetails.style.display = 'none';
        cimbDetails.style.display = 'none';
        mandiriDetails.style.display = 'none';

        // Show selected payment details
        switch(paymentSelect.value) {
            case 'qris':
                qrisDetails.style.display = 'block';
                break;
            case 'cimb':
                cimbDetails.style.display = 'block';
                break;
            case 'mandiri':
                mandiriDetails.style.display = 'block';
                break;
        }
    }
    </script>
</body>
</html>
