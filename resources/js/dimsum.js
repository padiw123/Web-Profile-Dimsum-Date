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
    const mainMenuGrid = document.getElementById('main-menu-grid');
    const favoriteMenuGrid = document.getElementById('favorite-menu-grid');
    const toggleBtn = document.getElementById('toggleMenuBtn');

    // Menu Filtering
    if (mainMenuGrid && favoriteMenuGrid && toggleBtn) {
        const menuItems = mainMenuGrid.querySelectorAll('.menu-item');
        let isExpanded = false;

        menuCategories.forEach(function(categoryBtn) {
            categoryBtn.addEventListener('click', function() {
                // Set tombol aktif
                menuCategories.forEach(btn => btn.classList.remove('active'));
                this.classList.add('active');

                const selectedCategory = this.getAttribute('data-category');

                // Reset state tombol "View Full Menu"
                isExpanded = false;
                toggleBtn.textContent = 'View Full Menu';

                if (selectedCategory === 'favorit') {
                    // Tampilkan grid favorit, sembunyikan yang utama
                    mainMenuGrid.style.display = 'none';
                    favoriteMenuGrid.style.display = 'grid';
                    toggleBtn.style.display = 'none';
                } else {
                    // Tampilkan grid utama, sembunyikan yang favorit
                    mainMenuGrid.style.display = 'grid';
                    favoriteMenuGrid.style.display = 'none';
                    
                    let visibleCount = 0;
                    
                    // Loop dan reset semua item di grid utama
                    menuItems.forEach(item => {
                        const itemCategory = item.getAttribute('data-category');
                        
                        // Sembunyikan semua item terlebih dahulu dan reset status 'extra'
                        item.classList.add('hidden');
                        item.classList.remove('extra-menu');

                        const isMatch = selectedCategory === 'all' || itemCategory === selectedCategory;

                        if (isMatch) {
                            // Tampilkan 6 item pertama yang cocok
                            if (visibleCount < 6) {
                                item.classList.remove('hidden');
                            } else {
                                // Tandai sisanya sebagai 'extra-menu' (tetap tersembunyi)
                                item.classList.add('extra-menu');
                            }
                            visibleCount++;
                        }
                    });

                    // Tentukan apakah tombol "View Full Menu" perlu ditampilkan
                    if (visibleCount > 6) {
                        toggleBtn.style.display = 'block';
                    } else {
                        toggleBtn.style.display = 'none';
                    }
                }
            });
        });

        // Toggle Full Menu
        toggleBtn.addEventListener('click', () => {
            isExpanded = !isExpanded;
            toggleBtn.textContent = isExpanded ? 'Show Less' : 'View Full Menu';

            mainMenuGrid.querySelectorAll('.extra-menu').forEach(item => {
                item.classList.toggle('hidden', !isExpanded);
            });
        });
    }

    // Reveal animations on scroll
    const revealElements = document.querySelectorAll('.section-header, .featured-item, .menu-item, .about-content, .gallery-item, .contact-content');

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

    const reservationForm = document.querySelector('.contact-form form[action*="send-reservation"]'); // Selector for your reservation form

    if (reservationForm) {
        reservationForm.addEventListener('submit', function(event) {
            const orderItemsDiv = document.getElementById('orderItems'); // The div containing individual order items
            const totalAmountSpan = document.getElementById('totalAmount'); // The span showing the total amount
            const orderedItemsSummaryInput = document.getElementById('orderedItemsSummaryInput'); // Hidden input for items
            const totalPaymentInput = document.getElementById('totalPaymentInput'); // Hidden input for total

            // Basic check to ensure all necessary elements are present
            if (!orderItemsDiv || !totalAmountSpan || !orderedItemsSummaryInput || !totalPaymentInput) {
                console.error('Error: One or more order summary elements are missing from the DOM.');
                // Optionally, you could prevent form submission here if critical elements are missing:
                // event.preventDefault();
                return;
            }

            let orderSummaryString = "";
            const items = orderItemsDiv.querySelectorAll('.order-item'); // Get all individual order item divs

            if (items.length > 0) {
                items.forEach(item => {
                    // Extracts "Item Name x Quantity" part
                    const itemNameAndQuantityElement = item.querySelector('span:first-child');
                    // Extracts "Rp X.XXX" part for that item
                    const itemTotalElement = item.querySelector('span.item-total');

                    if (itemNameAndQuantityElement && itemTotalElement) {
                        const itemNameAndQuantity = itemNameAndQuantityElement.textContent.trim();
                        const itemTotal = itemTotalElement.textContent.trim();
                        orderSummaryString += `${itemNameAndQuantity} (${itemTotal})\n`; // Format: "Dimsum Ayam x 2 (Rp 30.000)"
                    }
                });
            } else {
                orderSummaryString = "No items selected";
            }

            // Populate the hidden input fields
            orderedItemsSummaryInput.value = orderSummaryString.trim(); // Set the summarized string of items
            totalPaymentInput.value = totalAmountSpan.textContent.trim(); // Set the total payment string
        });
    }
});
