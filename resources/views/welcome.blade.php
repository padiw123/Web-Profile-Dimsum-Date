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
                    <img src="/assets/img/logo-dimsum.jpg" alt="Dimsum Date" class="logo-img">
                    <span>Dimsum Date</span>
                </a>
            </div>
            <div class="navbar-menu" id="navbarMenu">
                <ul class="navbar-nav">
                    <li class="nav-item"><a href="#home" class="nav-link">Home</a></li>
                    <li class="nav-item"><a href="#promo" class="nav-link">Promo</a></li>
                    <li class="nav-item"><a href="#menu" class="nav-link">Menu</a></li>
                    <li class="nav-item"><a href="#about" class="nav-link">About</a></li>
                    <li class="nav-item"><a href="#gallery" class="nav-link">Gallery</a></li>
                    <li class="nav-item"><a href="#contact" class="nav-link">Contact</a></li>
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

    <!-- Featured Section -->
    <section class="featured">
        <div class="container">
            <div class="featured-grid">
                <div class="featured-item">
                    <i class="fas fa-utensils"></i>
                    <h3>Fresh Ingredients</h3>
                    <p>Sourced daily from local markets</p>
                </div>
                <div class="featured-item">
                    <i class="fas fa-clock"></i>
                    <h3>Traditional Recipe</h3>
                    <p>Passed down through generations</p>
                </div>
                <div class="featured-item">
                    <i class="fas fa-award"></i>
                    <h3>Master Chefs</h3>
                    <p>With decades of experience</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Promotions Section -->
    <section id="promo" class="promotions">
        <div class="container">
            <div class="section-header">
                <h2>Special Offers</h2>
                <p>Exclusive deals for an extraordinary dining experience</p>
            </div>

            <div class="promo-slider">
                <div class="promo-arrow prev">
                    <i class="fas fa-chevron-left"></i>
                </div>

                <div class="promo-container">
                    <div class="promo-slide">
                        <div class="promo-card">
                            <h3>Weekday Lunch Special</h3>
                            <div class="description">
                                <p>Enjoy our premium dimsum selection at special prices</p>
                                <p class="price">$24.99 <span>per person</span></p>
                                <ul>
                                    <li>6 pieces of Premium Dimsum</li>
                                    <li>Chinese Tea Selection</li>
                                    <li>Dessert of the Day</li>
                                </ul>
                            </div>
                            <a href="#contact" class="btn btn-secondary">Book Now</a>
                        </div>
                    </div>

                    <div class="promo-slide">
                        <div class="promo-card">
                            <h3>Family Feast</h3>
                            <div class="description">
                                <p>Perfect for family gatherings and celebrations</p>
                                <p class="price">$89.99 <span>for 4 people</span></p>
                                <ul>
                                    <li>20 pieces of Signature Dimsum</li>
                                    <li>4 Bowl of Special Soup</li>
                                    <li>4 Desserts</li>
                                </ul>
                            </div>
                            <a href="#contact" class="btn btn-secondary">Book Now</a>
                        </div>
                    </div>

                    <div class="promo-slide">
                        <div class="promo-card">
                            <h3>Weekend All-You-Can-Eat</h3>
                            <div class="description">
                                <p>Unlimited dimsum experience every weekend</p>
                                <p class="price">$39.99 <span>per person</span></p>
                                <ul>
                                    <li>Unlimited Dimsum Selection</li>
                                    <li>Free Flow Chinese Tea</li>
                                    <li>Signature Dessert Buffet</li>
                                </ul>
                            </div>
                            <a href="#contact" class="btn btn-secondary">Book Now</a>
                        </div>
                    </div>
                </div>

                <div class="promo-arrow next">
                    <i class="fas fa-chevron-right"></i>
                </div>
            </div>

            <div class="promo-navigation">
                <div class="promo-dot active"></div>
                <div class="promo-dot"></div>
                <div class="promo-dot"></div>
            </div>
        </div>
    </section>

    <!-- Menu Section -->
    <section id="menu" class="menu">
        <div class="container">
            <div class="section-header">
                <h2>Our Menu</h2>
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
                    <img src="https://images.pexels.com/photos/2098134/pexels-photo-2098134.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" alt="About Dimsum Date">
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

    <!-- Gallery Section -->
    <section id="gallery" class="gallery">
        <div class="container">
            <div class="section-header">
                <h2>Gallery</h2>
                <p>Take a glimpse into our world of dimsum</p>
            </div>

            <div class="gallery-grid">
                <div class="gallery-item">
                    <img src="" alt="Dimsum Assortment">
                </div>
                <div class="gallery-item">
                    <img src="" alt="Chef Preparing Dimsum">
                </div>
                <div class="gallery-item">
                    <img src="" alt="Restaurant Interior">
                </div>
                <div class="gallery-item">
                    <img src="" alt="Steaming Baskets">
                </div>
                <div class="gallery-item">
                    <img src="" alt="Steaming Baskets">
                </div>
                <div class="gallery-item">
                    <img src="" alt="Tea Service">
                </div>
                <div class="gallery-item">
                    <img src="" alt="Dining Experience">
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="testimonials">
        <div class="container">
            <div class="section-header">
                <h2>What Our Customers Say</h2>
            </div>

            <div class="testimonial-slider">
                <div class="testimonial-slide">
                    <div class="testimonial-content">
                        <div class="stars">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <p>"The best dimsum I've had outside of Hong Kong. Authentic flavors and impeccable service!"</p>
                        <div class="testimonial-author">
                            <h4>Sarah Chen</h4>
                            <p>Food Critic</p>
                        </div>
                    </div>
                </div>

                <div class="testimonial-slide">
                    <div class="testimonial-content">
                        <div class="stars">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <p>"Dimsum Date has been our family's go-to for dimsum for years. Their har gow is simply unmatched!"</p>
                        <div class="testimonial-author">
                            <h4>Michael Wong</h4>
                            <p>Regular Customer</p>
                        </div>
                    </div>
                </div>

                <div class="testimonial-slide">
                    <div class="testimonial-content">
                        <div class="stars">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                        </div>
                        <p>"A hidden gem with the most delicious dimsum and a wonderful atmosphere. Perfect for family gatherings!"</p>
                        <div class="testimonial-author">
                            <h4>Emily Johnson</h4>
                            <p>Food Blogger</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="testimonial-dots">
                <span class="dot active"></span>
                <span class="dot"></span>
                <span class="dot"></span>
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
                                </a>
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
                        <a href="https://tiktok.com/@dimsum_date" class="social-link" target="_blank"><i class="fab fa-tiktok"></i></a>
                        <a href="https://linktr.ee/dimsumdate?utm_source=linktree_profile_share&ltsid=c76934ad-601e-47db-ae8c-73a3d4287aa4" class="social-link" target="_blank"><img src="/assets/img/Linktree.png" alt="Linktree" style="color: #FFFFFF; width: 16px;"></a>
                        <a href="https://www.instagram.com/dimsum_date?utm_source=ig_web_button_share_sheet&igsh=ZDNlZDc0MzIxNw==" class="social-link" target="_blank"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>

                <div class="contact-form">
                    <h3>Make a Reservation</h3>
                    <form action="{{ route('send.reservation') }}" method="POST" target="_blank">
                        @csrf
                        <div class="form-group">
                            <input type="text" name="name" placeholder="Your Name" value="{{ old('name') }}" required>
                        </div>
                        <div class="form-group">
                            <input type="email" name="email" placeholder="Your Email" value="{{ old('email') }}" required>
                        </div>
                        <div class="form-group">
                            <input type="tel" name="phone" placeholder="Phone Number" value="{{ old('phone') }}" required>
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
                                <option value="" disabled {{ old('guests') ? '' : 'selected' }}>Number of Guests</option>
                                @foreach (['1' => '1 Person', '2' => '2 People', '3' => '3 People', '4' => '4 People', '5' => '5 People', '6+' => '6+ People'] as $value => $label)
                                    <option value="{{ $value }}" {{ old('guests') == $value ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <textarea name="message" placeholder="Special Requests">{{ old('message') }}</textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Reserve Table</button>
                    </form>
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
                        <li><a href="#about">About</a></li>
                        <li><a href="#gallery">Gallery</a></li>
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
</body>
</html>
