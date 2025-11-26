@extends('layouts.frontend')

@section('title', 'Premium Student Living')

@section('content')
    <!-- Hero Section -->
    <section class="hero-section">
        <div class="hero-bg">
            <video autoplay muted loop playsinline poster="https://images.unsplash.com/photo-1555854877-bab0e564b8d5?ixlib=rb-1.2.1&auto=format&fit=crop&w=1920&q=80">
                <source src="https://cdn.coverr.co/videos/coverr-students-walking-in-hallway-4623/1080p.mp4" type="video/mp4">
                Your browser does not support the video tag.
            </video>
        </div>
        <div class="hero-overlay"></div>
        <div class="hero-content" data-aos="fade-up">
            <h1 class="hero-title">Experience Premium Student Living</h1>
            <p class="hero-subtitle">Modern amenities, secure environment, and a vibrant community designed for your academic success.</p>
            <a href="{{ route('register') }}" class="btn-hero">Book Your Room Now</a>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="section-padding" style="background: #fff;">
        <div class="container">
            <div class="text-center mb-5" data-aos="fade-up">
                <h2 class="section-title">Why Choose SmartHostel?</h2>
                <p class="section-subtitle">We provide everything you need to live, learn, and thrive.</p>
            </div>
            
            <div class="grid grid-3">
                <!-- Feature 1 -->
                <div class="feature-card" data-aos="fade-up" data-aos-delay="0">
                    <img src="https://images.unsplash.com/photo-1522771753033-6a58612ac6be?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80" alt="Modern Rooms" class="feature-img">
                    <div class="feature-content">
                        <h3>Modern Rooms</h3>
                        <p class="text-muted">Fully furnished spaces with high-speed internet, designed for comfort and productivity.</p>
                    </div>
                </div>

                <!-- Feature 2 -->
                <div class="feature-card" data-aos="fade-up" data-aos-delay="100">
                    <img src="https://images.unsplash.com/photo-1524178232363-1fb2b075b655?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80" alt="Study Lounges" class="feature-img">
                    <div class="feature-content">
                        <h3>Collaborative Spaces</h3>
                        <p class="text-muted">Vibrant study lounges and common areas to connect, create, and collaborate.</p>
                    </div>
                </div>

                <!-- Feature 3 -->
                <div class="feature-card" data-aos="fade-up" data-aos-delay="200">
                    <img src="https://images.unsplash.com/photo-1554224155-8d04cb21cd6c?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80" alt="Security" class="feature-img">
                    <div class="feature-content">
                        <h3>24/7 Security</h3>
                        <p class="text-muted">Advanced biometric access and round-the-clock surveillance for your peace of mind.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Rooms Section -->
    <section id="rooms" class="section-padding" style="background: #f8f9fa;">
        <div class="container">
            <div class="text-center mb-5" data-aos="fade-up">
                <h2 class="section-title">Choose Your Space</h2>
                <p class="section-subtitle">Find the perfect room that fits your style and budget.</p>
            </div>

            <div class="grid grid-3">
                <!-- Room 1 -->
                <div class="room-card" data-aos="fade-up" data-aos-delay="0">
                    <img src="https://images.unsplash.com/photo-1555854877-bab0e564b8d5?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80" alt="Single Room" class="room-img">
                    <div class="room-details">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <h3>Single Studio</h3>
                            <span class="room-price">KSh 25k<small>/sem</small></span>
                        </div>
                        <ul class="room-features">
                            <li><i class="fas fa-check text-success"></i> Private Bathroom</li>
                            <li><i class="fas fa-check text-success"></i> High-Speed WiFi</li>
                            <li><i class="fas fa-check text-success"></i> Study Desk</li>
                        </ul>
                        <a href="{{ route('register') }}" class="btn-primary w-100 text-center">Book Now</a>
                    </div>
                </div>

                <!-- Room 2 -->
                <div class="room-card" data-aos="fade-up" data-aos-delay="100">
                    <img src="https://images.unsplash.com/photo-1595526114035-0d45ed16cfbf?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80" alt="Double Room" class="room-img">
                    <div class="room-details">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <h3>Double Share</h3>
                            <span class="room-price">KSh 15k<small>/sem</small></span>
                        </div>
                        <ul class="room-features">
                            <li><i class="fas fa-check text-success"></i> Shared Bathroom</li>
                            <li><i class="fas fa-check text-success"></i> High-Speed WiFi</li>
                            <li><i class="fas fa-check text-success"></i> 2 Study Desks</li>
                        </ul>
                        <a href="{{ route('register') }}" class="btn-primary w-100 text-center">Book Now</a>
                    </div>
                </div>

                <!-- Room 3 -->
                <div class="room-card" data-aos="fade-up" data-aos-delay="200">
                    <img src="https://images.unsplash.com/photo-1522708323590-d24dbb6b0267?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80" alt="Quad Room" class="room-img">
                    <div class="room-details">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <h3>Quad Share</h3>
                            <span class="room-price">KSh 10k<small>/sem</small></span>
                        </div>
                        <ul class="room-features">
                            <li><i class="fas fa-check text-success"></i> Community Living</li>
                            <li><i class="fas fa-check text-success"></i> High-Speed WiFi</li>
                            <li><i class="fas fa-check text-success"></i> Large Lockers</li>
                        </ul>
                        <a href="{{ route('register') }}" class="btn-primary w-100 text-center">Book Now</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="stats-section">
        <div class="stats-grid" data-aos="zoom-in">
            <div class="stat-item">
                <h3>500+</h3>
                <p>Happy Students</p>
            </div>
            <div class="stat-item">
                <h3>100%</h3>
                <p>Secure</p>
            </div>
            <div class="stat-item">
                <h3>24/7</h3>
                <p>Support</p>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="section-padding">
        <div class="container">
            <div class="text-center mb-5" data-aos="fade-up">
                <h2 class="section-title">What Students Say</h2>
            </div>
            
            <!-- Swiper -->
            <div class="swiper testimonial-swiper" data-aos="fade-up">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <div class="testimonial-card">
                            <div class="stars">
                                <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                            </div>
                            <p class="mb-3">"The best hostel experience I've ever had. The WiFi is super fast and the study lounges are perfect for exam prep."</p>
                            <strong>- Sarah M., Computer Science</strong>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="testimonial-card">
                            <div class="stars">
                                <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                            </div>
                            <p class="mb-3">"I love the community here. It's safe, clean, and the staff are always helpful. Highly recommended!"</p>
                            <strong>- James K., Engineering</strong>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="testimonial-card">
                            <div class="stars">
                                <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star-half-alt"></i>
                            </div>
                            <p class="mb-3">"Great value for money. The location is convenient and the booking process was seamless."</p>
                            <strong>- Anita W., Business</strong>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="testimonial-card">
                            <div class="stars">
                                <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                            </div>
                            <p class="mb-3">"The security is top-notch. I feel very safe here, and the biometric access is really cool."</p>
                            <strong>- David O., Law</strong>
                        </div>
                    </div>
                </div>
                <div class="swiper-pagination"></div>
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    <section id="faq" class="section-padding" style="background: #f8f9fa;">
        <div class="container">
            <div class="text-center mb-5" data-aos="fade-up">
                <h2 class="section-title">Frequently Asked Questions</h2>
            </div>
            
            <div class="faq-section" data-aos="fade-up">
                <div class="faq-item">
                    <div class="faq-question" onclick="toggleFaq(this)">
                        How do I book a room?
                        <i class="fas fa-chevron-down"></i>
                    </div>
                    <div class="faq-answer">
                        Simply register for an account, go to your dashboard, and click "New Booking". You can browse available rooms and book instantly.
                    </div>
                </div>
                <div class="faq-item">
                    <div class="faq-question" onclick="toggleFaq(this)">
                        What payment methods are accepted?
                        <i class="fas fa-chevron-down"></i>
                    </div>
                    <div class="faq-answer">
                        We accept M-Pesa and PayPal. Payments can be made directly through your student dashboard.
                    </div>
                </div>
                <div class="faq-item">
                    <div class="faq-question" onclick="toggleFaq(this)">
                        Is there a curfew?
                        <i class="fas fa-chevron-down"></i>
                    </div>
                    <div class="faq-answer">
                        For security reasons, the main gates close at 11 PM. However, late entry can be requested in advance through the portal.
                    </div>
                </div>
                <div class="faq-item">
                    <div class="faq-question" onclick="toggleFaq(this)">
                        Can I have visitors?
                        <i class="fas fa-chevron-down"></i>
                    </div>
                    <div class="faq-answer">
                        Yes, visitors are allowed between 9 AM and 8 PM. You must register them at the gate or through your dashboard.
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        function toggleFaq(element) {
            const item = element.parentElement;
            item.classList.toggle('active');
        }

        // Initialize Swiper
        document.addEventListener('DOMContentLoaded', function () {
            var swiper = new Swiper(".testimonial-swiper", {
                slidesPerView: 1,
                spaceBetween: 30,
                loop: true,
                autoplay: {
                    delay: 3500,
                    disableOnInteraction: false,
                },
                pagination: {
                    el: ".swiper-pagination",
                    clickable: true,
                },
                breakpoints: {
                    640: {
                        slidesPerView: 1,
                    },
                    768: {
                        slidesPerView: 2,
                    },
                    1024: {
                        slidesPerView: 3,
                    },
                },
            });
        });
    </script>

@endsection
