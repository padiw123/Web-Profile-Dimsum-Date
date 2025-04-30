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

    <!-- Menu Section -->
    <section id="menu" class="menu">
        <div class="container">
            <div class="section-header">
                <h2>Our Menu</h2>
                <p>Discover our handcrafted selection of authentic dimsum</p>
            </div>

            <div class="menu-categories">
                <button class="menu-category active" data-category="all">All</button>
                <button class="menu-category" data-category="steamed">Steamed</button>
                <button class="menu-category" data-category="fried">Fried</button>
                <button class="menu-category" data-category="buns">Buns</button>
                <button class="menu-category" data-category="desserts">Desserts</button>
            </div>

            <div class="menu-grid">
                <!-- Steamed Items -->
                <div class="menu-item" data-category="steamed">
                    <div class="menu-image">
                        <img src="https://images.pexels.com/photos/955137/pexels-photo-955137.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" alt="Har Gow">
                    </div>
                    <div class="menu-content">
                        <h3>Har Gow <span class="price">$6.50</span></h3>
                        <p>Crystal shrimp dumplings with bamboo shoots</p>
                    </div>
                </div>

                <div class="menu-item" data-category="steamed">
                    <div class="menu-image">
                        <img src="https://images.pexels.com/photos/2664443/pexels-photo-2664443.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" alt="Siu Mai">
                    </div>
                    <div class="menu-content">
                        <h3>Siu Mai <span class="price">$5.95</span></h3>
                        <p>Open-faced dumplings with pork, shrimp and mushroom</p>
                    </div>
                </div>

                <!-- Fried Items -->
                <div class="menu-item" data-category="fried">
                    <div class="menu-image">
                        <img src="https://images.pexels.com/photos/15913452/pexels-photo-15913452/free-photo-of-spring-rolls-on-plate.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" alt="Spring Rolls">
                    </div>
                    <div class="menu-content">
                        <h3>Spring Rolls <span class="price">$5.50</span></h3>
                        <p>Crispy vegetable spring rolls with sweet chili sauce</p>
                    </div>
                </div>

                <div class="menu-item" data-category="fried">
                    <div class="menu-image">
                        <img src="https://images.pexels.com/photos/14188208/pexels-photo-14188208.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" alt="Fried Wontons">
                    </div>
                    <div class="menu-content">
                        <h3>Fried Wontons <span class="price">$6.25</span></h3>
                        <p>Crispy pork wontons with sweet and sour dipping sauce</p>
                    </div>
                </div>

                <!-- Buns -->
                <div class="menu-item" data-category="buns">
                    <div class="menu-image">
                        <img src="https://images.pexels.com/photos/9470516/pexels-photo-9470516.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" alt="Char Siu Bao">
                    </div>
                    <div class="menu-content">
                        <h3>Char Siu Bao <span class="price">$5.25</span></h3>
                        <p>Steamed buns filled with barbecue pork</p>
                    </div>
                </div>

                <div class="menu-item" data-category="buns">
                    <div class="menu-image">
                        <img src="https://images.pexels.com/photos/674574/pexels-photo-674574.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" alt="Lotus Seed Bun">
                    </div>
                    <div class="menu-content">
                        <h3>Lotus Seed Bun <span class="price">$4.95</span></h3>
                        <p>Sweet buns filled with lotus seed paste</p>
                    </div>
                </div>

                <!-- Desserts -->
                <div class="menu-item" data-category="desserts">
                    <div class="menu-image">
                        <img src="https://images.pexels.com/photos/2313682/pexels-photo-2313682.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" alt="Egg Tarts">
                    </div>
                    <div class="menu-content">
                        <h3>Egg Tarts <span class="price">$4.50</span></h3>
                        <p>Flaky pastry tarts filled with sweet egg custard</p>
                    </div>
                </div>

                <div class="menu-item" data-category="desserts">
                    <div class="menu-image">
                        <img src="https://images.pexels.com/photos/1374358/pexels-photo-1374358.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" alt="Mango Pudding">
                    </div>
                    <div class="menu-content">
                        <h3>Mango Pudding <span class="price">$5.25</span></h3>
                        <p>Creamy mango pudding topped with fresh fruit</p>
                    </div>
                </div>
            </div>

            <div class="menu-cta">
                <a href="#" class="btn btn-primary">View Full Menu</a>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="about">
        <div class="container">
            <div class="about-content">
                <div class="about-image">
                    <img src="https://images.pexels.com/photos/2098134/pexels-photo-2098134.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" alt="About Golden Dragon">
                </div>
                <div class="about-text">
                    <div class="section-header">
                        <h2>Our Story</h2>
                    </div>
                    <p>Founded in 1985 by Master Chef Liu, Golden Dragon has been serving authentic dimsum for over three decades. Our recipes have been passed down through generations, preserving the art and tradition of handcrafted dimsum.</p>
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
                    <img src="https://images.pexels.com/photos/6941001/pexels-photo-6941001.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" alt="Dimsum Assortment">
                </div>
                <div class="gallery-item">
                    <img src="https://images.pexels.com/photos/2347311/pexels-photo-2347311.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" alt="Chef Preparing Dimsum">
                </div>
                <div class="gallery-item">
                    <img src="https://images.pexels.com/photos/5865196/pexels-photo-5865196.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" alt="Restaurant Interior">
                </div>
                <div class="gallery-item">
                    <img src="https://images.pexels.com/photos/5409015/pexels-photo-5409015.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" alt="Steaming Baskets">
                </div>
                <div class="gallery-item">
                    <img src="https://images.pexels.com/photos/1001090/pexels-photo-1001090.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" alt="Tea Service">
                </div>
                <div class="gallery-item">
                    <img src="https://images.pexels.com/photos/3217156/pexels-photo-3217156.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" alt="Dining Experience">
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
                        <p>"Golden Dragon has been our family's go-to for dimsum for years. Their har gow is simply unmatched!"</p>
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
                            <h3>Location</h3>
                            <a href="https://maps.app.goo.gl/i75AbVTMPiejnNNZA"><p>Ruko R5 Ramayana, Kotabaru,<br> Kec. Serang, Kota Serang, Banten 42112</p></a>
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
                            <p>+1 (555) 123-4567<br>reservations@goldendragon.com</p>
                        </div>
                    </div>

                    <div class="social-links">
                        <a href="https://tiktok.com/@dimsum_date" class="social-link"><i class="fab fa-tiktok"></i></a>
                        <a href="https://www.instagram.com/dimsum_date?utm_source=ig_web_button_share_sheet&igsh=ZDNlZDc0MzIxNw==" class="social-link"><i class="fab fa-instagram"></i></a>
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
                        <li><a href="#menu">Menu</a></li>
                        <li><a href="#about">About</a></li>
                        <li><a href="#gallery">Gallery</a></li>
                        <li><a href="#contact">Contact</a></li>
                    </ul>
                </div>

                <div class="footer-newsletter">
                    <h3>Newsletter</h3>
                    <p>Subscribe to receive special offers and updates</p>
                    <form action="#" method="POST" class="newsletter-form">
                        <input type="email" name="email" placeholder="Your Email" required>
                        <button type="submit"><i class="fas fa-paper-plane"></i></button>
                    </form>
                </div>
            </div>

            <div class="footer-bottom">
                <p>&copy; 2025 Golden Dragon Dimsum. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script src="{{ asset('./assets/js/dimsum.js') }}"></script>
</body>
</html>
