@extends('layouts.frontend')

@section('title', 'Premium Student Living')

@section('content')
    <!-- Hero Section -->
    <section class="hero-section">
        <div class="hero-bg" style="background-image: url('https://images.unsplash.com/photo-1555854877-bab0e564b8d5?ixlib=rb-1.2.1&auto=format&fit=crop&w=1920&q=80');"></div>
        <div class="hero-overlay"></div>
        <div class="hero-content">
            <h1 class="hero-title">Experience Premium Student Living</h1>
            <p class="hero-subtitle">Modern amenities, secure environment, and a vibrant community designed for your academic success.</p>
            <a href="{{ route('register') }}" class="btn-hero">Book Your Room Now</a>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="section-padding" style="background: #fff;">
        <h2 class="section-title">Why Choose SmartHostel?</h2>
        <p class="section-subtitle">We provide everything you need to live, learn, and thrive.</p>
        
        <div class="feature-grid">
            <!-- Feature 1 -->
            <div class="feature-card fade-in-up" id="card1">
                <img src="https://images.unsplash.com/photo-1522771753033-6a58612ac6be?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80" alt="Modern Rooms" class="feature-img">
                <div class="feature-content">
                    <h3>Modern Rooms</h3>
                    <p class="text-muted">Fully furnished spaces with high-speed internet, designed for comfort and productivity.</p>
                </div>
            </div>

            <!-- Feature 2 -->
            <div class="feature-card fade-in-up" id="card2" style="transition-delay: 0.2s;">
                <img src="https://images.unsplash.com/photo-1524178232363-1fb2b075b655?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80" alt="Study Lounges" class="feature-img">
                <div class="feature-content">
                    <h3>Collaborative Spaces</h3>
                    <p class="text-muted">Vibrant study lounges and common areas to connect, create, and collaborate.</p>
                </div>
            </div>

            <!-- Feature 3 -->
            <div class="feature-card fade-in-up" id="card3" style="transition-delay: 0.4s;">
                <img src="https://images.unsplash.com/photo-1554224155-8d04cb21cd6c?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80" alt="Security" class="feature-img">
                <div class="feature-content">
                    <h3>24/7 Security</h3>
                    <p class="text-muted">Advanced biometric access and round-the-clock surveillance for your peace of mind.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Rooms Section -->
    <section id="rooms" class="section-padding" style="background: #f8f9fa;">
        <h2 class="section-title">Choose Your Space</h2>
        <p class="section-subtitle">Find the perfect room that fits your style and budget.</p>

        <div class="feature-grid">
            <!-- Room 1 -->
            <div class="room-card fade-in-up">
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
            <div class="room-card fade-in-up" style="transition-delay: 0.2s;">
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
            <div class="room-card fade-in-up" style="transition-delay: 0.4s;">
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
    </section>

    <!-- Stats Section -->
    <section class="stats-section">
        <div class="stats-grid">
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
        <h2 class="section-title">What Students Say</h2>
        <div class="testimonial-grid">
            <div class="testimonial-card fade-in-up">
                <div class="stars">
                    <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                </div>
                <p class="mb-3">"The best hostel experience I've ever had. The WiFi is super fast and the study lounges are perfect for exam prep."</p>
                <strong>- Sarah M., Computer Science</strong>
            </div>
            <div class="testimonial-card fade-in-up" style="transition-delay: 0.2s;">
                <div class="stars">
                    <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                </div>
                <p class="mb-3">"I love the community here. It's safe, clean, and the staff are always helpful. Highly recommended!"</p>
                <strong>- James K., Engineering</strong>
            </div>
            <div class="testimonial-card fade-in-up" style="transition-delay: 0.4s;">
                <div class="stars">
                    <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star-half-alt"></i>
                </div>
                <p class="mb-3">"Great value for money. The location is convenient and the booking process was seamless."</p>
                <strong>- Anita W., Business</strong>
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    <section id="faq" class="section-padding" style="background: #f8f9fa;">
        <h2 class="section-title">Frequently Asked Questions</h2>
        <div class="faq-section fade-in-up">
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
    </section>

    <script>
        function toggleFaq(element) {
            const item = element.parentElement;
            item.classList.toggle('active');
        }
    </script>

    <style>
        /* Inline styles for components specific to home page */
        .feature-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 3rem;
            max-width: 1200px;
            margin: 0 auto;
        }

        .feature-card {
            background: white;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0,0,0,0.05);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .feature-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(20, 110, 245, 0.15);
        }

        .feature-img {
            height: 250px;
            width: 100%;
            object-fit: cover;
        }

        .feature-content {
            padding: 2rem;
        }

        .room-card {
            background: white;
            border: 1px solid #eee;
            border-radius: 16px;
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .room-card:hover {
            border-color: #146EF5;
            box-shadow: 0 10px 30px rgba(20, 110, 245, 0.1);
        }

        .room-img {
            height: 300px;
            width: 100%;
            object-fit: cover;
        }

        .room-details {
            padding: 2rem;
        }

        .room-price {
            color: #146EF5;
            font-size: 1.5rem;
            font-weight: 700;
        }

        .room-features {
            list-style: none;
            padding: 0;
            margin: 1.5rem 0;
            color: #666;
        }

        .room-features li {
            margin-bottom: 0.5rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .testimonial-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
            max-width: 1200px;
            margin: 0 auto;
        }

        .testimonial-card {
            background: white;
            padding: 2rem;
            border-radius: 16px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        }

        .stars {
            color: #FFD700;
            margin-bottom: 1rem;
        }

        .faq-section {
            background: white;
            max-width: 800px;
            margin: 0 auto;
        }

        .faq-item {
            border-bottom: 1px solid #eee;
            padding: 1.5rem 0;
        }

        .faq-question {
            font-weight: 600;
            font-size: 1.1rem;
            cursor: pointer;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .faq-answer {
            margin-top: 1rem;
            color: #666;
            display: none;
        }

        .faq-item.active .faq-answer {
            display: block;
        }

        .faq-item.active .fa-chevron-down {
            transform: rotate(180deg);
        }
    </style>
@endsection
