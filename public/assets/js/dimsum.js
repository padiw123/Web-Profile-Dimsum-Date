document.addEventListener('DOMContentLoaded', function() {
    // Navbar scroll effect
    const navbar = document.getElementById('navbar');

    window.addEventListener('scroll', function() {
        if (window.scrollY > 50) {
            navbar.classList.add('scrolled');
        } else {
            navbar.classList.remove('scrolled');
        }
    });

    // Mobile menu toggle
    const navbarToggle = document.getElementById('navbarToggle');
    const navbarMenu = document.getElementById('navbarMenu');

    navbarToggle.addEventListener('click', function() {
        navbarToggle.classList.toggle('active');
        navbarMenu.classList.toggle('active');
    });

    // Close mobile menu when a link is clicked
    const navLinks = document.querySelectorAll('.nav-link');

    navLinks.forEach(function(navLink) {
        navLink.addEventListener('click', function() {
            navbarToggle.classList.remove('active');
            navbarMenu.classList.remove('active');
        });
    });

    // Menu filtering
    const menuCategories = document.querySelectorAll('.menu-category');
    const menuItems = document.querySelectorAll('.menu-item');

    menuCategories.forEach(function(category) {
        category.addEventListener('click', function() {
            // Remove active class from all categories
            menuCategories.forEach(function(cat) {
                cat.classList.remove('active');
            });

            // Add active class to clicked category
            this.classList.add('active');

            const filter = this.getAttribute('data-category');

            // Show or hide menu items based on category
            menuItems.forEach(function(item) {
                if (filter === 'all' || item.getAttribute('data-category') === filter) {
                    item.style.display = 'block';
                } else {
                    item.style.display = 'none';
                }
            });
        });
    });

    // Testimonial slider
    const testimonialSlides = document.querySelectorAll('.testimonial-slide');
    const dots = document.querySelectorAll('.dot');
    let currentSlide = 0;

    function showSlide(n) {
        // Hide all slides
        testimonialSlides.forEach(function(slide) {
            slide.style.display = 'none';
        });

        // Remove active class from all dots
        dots.forEach(function(dot) {
            dot.classList.remove('active');
        });

        // Show current slide and activate corresponding dot
        testimonialSlides[n].style.display = 'block';
        dots[n].classList.add('active');
    }

    // Initialize slider
    showSlide(currentSlide);

    // Add click event to dots
    dots.forEach(function(dot, index) {
        dot.addEventListener('click', function() {
            showSlide(index);
            currentSlide = index;
            resetTimer();
        });
    });

    // Auto slide
    let slideTimer = setInterval(nextSlide, 5000);

    function nextSlide() {
        currentSlide = (currentSlide + 1) % testimonialSlides.length;
        showSlide(currentSlide);
    }

    function resetTimer() {
        clearInterval(slideTimer);
        slideTimer = setInterval(nextSlide, 5000);
    }

    // Reveal animations on scroll
    const revealElements = document.querySelectorAll('.section-header, .featured-item, .menu-item, .about-content, .gallery-item, .testimonial-slider, .contact-content');

    function revealOnScroll() {
        let windowHeight = window.innerHeight;

        revealElements.forEach(function(element) {
            let elementTop = element.getBoundingClientRect().top;

            if (elementTop < windowHeight - 100) {
                element.style.opacity = 1;
                element.style.transform = 'translateY(0)';
            }
        });
    }

    // Initialize reveal elements styles
    revealElements.forEach(function(element) {
        element.style.opacity = 0;
        element.style.transform = 'translateY(30px)';
        element.style.transition = 'opacity 0.8s ease, transform 0.8s ease';
    });

    // Add scroll event
    window.addEventListener('scroll', revealOnScroll);

    // Trigger on load
    revealOnScroll();

// ScrollSpy Active Navbar Link
    const sections = document.querySelectorAll('section[id]');

    window.addEventListener('scroll', () => {
        let scrollPos = window.scrollY + 150; // Adjust offset if needed

        sections.forEach(section => {
            const top = section.offsetTop;
            const height = section.offsetHeight;
            const id = section.getAttribute('id');

            if (scrollPos >= top && scrollPos < top + height) {
                navLinks.forEach(link => {
                    link.classList.remove('active');
                    if (link.getAttribute('href') === `#${id}`) {
                        link.classList.add('active');
                    }
                });
            }
        });
    });

    // Form validation
    const contactForm = document.querySelector('.contact-form form');

    if (contactForm) {
        contactForm.addEventListener('submit', function(e) {
            let isValid = true;
            const inputs = contactForm.querySelectorAll('input[required], select[required], textarea[required]');

            inputs.forEach(function(input) {
                const isEmpty = !input.value.trim();
                input.classList.toggle('input-error', isEmpty);
                if (isEmpty) isValid = false;
            });

            if (!isValid) {
                e.preventDefault();
                alert('Please fill in all required fields.');
            }
        });
    }

    const toggleBtn = document.getElementById('toggleMenuBtn');
    const extraMenus = document.querySelectorAll('.extra-menu');
    let isExpanded = false;

    toggleBtn.addEventListener('click', () => {
        extraMenus.forEach(item => {
            item.classList.toggle('hidden');
        });

        isExpanded = !isExpanded;
        toggleBtn.textContent = isExpanded ? 'Show Less' : 'View Full Menu';
    });

    // Promotions Slider
    const promoContainer = document.querySelector('.promo-container');
    const promoSlides = document.querySelectorAll('.promo-slide');
    const prevButton = document.querySelector('.promo-arrow.prev');
    const nextButton = document.querySelector('.promo-arrow.next');
    const dots1 = document.querySelectorAll('.promo-dot');
    let currentSlide1 = 0;
    let slideInterval;

    function updateSlidePosition() {
        promoContainer.style.transform = `translateX(-${currentSlide1 * 100}%)`;

        // Update dots1
        dots1.forEach(dot => dot.classList.remove('active'));
        dots1[currentSlide1].classList.add('active');

        // Update cards
        promoSlides.forEach((slide, index) => {
            const card = slide.querySelector('.promo-card');
            if (index === currentSlide1) {
                card.classList.add('active');
            } else {
                card.classList.remove('active');
            }
        });
    }

    function nextSlide() {
        currentSlide1 = (currentSlide1 + 1) % promoSlides.length;
        updateSlidePosition();
    }

    function prevSlide() {
        currentSlide1 = (currentSlide1 - 1 + promoSlides.length) % promoSlides.length;
        updateSlidePosition();
    }

    function startSlideShow() {
        slideInterval = setInterval(nextSlide, 5000);
    }

    function stopSlideShow() {
        clearInterval(slideInterval);
    }

    // Event Listeners
    prevButton.addEventListener('click', () => {
        prevSlide();
        stopSlideShow();
        startSlideShow();
    });

    nextButton.addEventListener('click', () => {
        nextSlide();
        stopSlideShow();
        startSlideShow();
    });

    dots1.forEach((dot, index) => {
        dot.addEventListener('click', () => {
            currentSlide1 = index;
            updateSlidePosition();
            stopSlideShow();
            startSlideShow();
        });
    });

    promoContainer.addEventListener('mouseenter', stopSlideShow);
    promoContainer.addEventListener('mouseleave', startSlideShow);

    // Start the slideshow
    startSlideShow();
});
