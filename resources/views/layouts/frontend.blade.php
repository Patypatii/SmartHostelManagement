<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Smart Hostel') }} - @yield('title')</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=outfit:300,400,500,600,700&display=swap" rel="stylesheet" />
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- AOS Animation CSS -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    
    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

    <!-- Custom Styles -->
    <link rel="stylesheet" href="{{ asset('css/webflow-design-system.css') }}">
    <link rel="stylesheet" href="{{ asset('css/frontend.css') }}">
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar @yield('navbar-class')">
        <div class="container" style="display: flex; justify-content: space-between; align-items: center; height: 100%;">
            <a href="{{ url('/') }}" class="logo">
                <i class="fas fa-building"></i> SmartHostel
            </a>
            <button class="mobile-menu-toggle" aria-label="Toggle navigation">
                <i class="fas fa-bars"></i>
            </button>
            <div class="nav-links">
                @auth
                    @if(Auth::user()->role === 'student')
                        <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">Dashboard</a>
                        <a href="{{ route('student.rooms') }}" class="{{ request()->routeIs('student.rooms*') ? 'active' : '' }}">Rooms</a>
                        <a href="{{ route('student.payments.index') }}" class="{{ request()->routeIs('student.payments*') ? 'active' : '' }}">Payments</a>
                    @elseif(Auth::user()->role === 'staff')
                        <a href="{{ route('staff.dashboard') }}" class="{{ request()->routeIs('staff.dashboard') ? 'active' : '' }}">Dashboard</a>
                        <a href="{{ route('staff.complaints.index') }}" class="{{ request()->routeIs('staff.complaints*') ? 'active' : '' }}">Complaints</a>
                        <a href="{{ route('staff.visitors.index') }}" class="{{ request()->routeIs('staff.visitors*') ? 'active' : '' }}">Visitors</a>
                    @elseif(Auth::user()->role === 'admin')
                        <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">Dashboard</a>
                        <a href="{{ route('admin.bookings') }}" class="{{ request()->routeIs('admin.bookings*') ? 'active' : '' }}">Bookings</a>
                        <a href="{{ route('admin.reports.index') }}" class="{{ request()->routeIs('admin.reports*') ? 'active' : '' }}">Reports</a>
                    @endif
                    
                    <div class="dropdown" style="position: relative; display: inline-block;">
                        <a href="#" class="btn-primary" style="padding: 0.5rem 1.5rem; border-radius: 20px; display: flex; align-items: center; gap: 0.5rem;">
                            <i class="fas fa-user-circle"></i> {{ Auth::user()->name }}
                        </a>
                    </div>
                    
                    <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                        @csrf
                        <button type="submit" class="btn-secondary" style="border: none; background: none; color: white; cursor: pointer; font-weight: 500;">
                            <i class="fas fa-sign-out-alt"></i> Logout
                        </button>
                    </form>
                @else
                    <a href="{{ url('/') }}" class="{{ request()->is('/') ? 'active' : '' }}">Home</a>
                    <a href="{{ route('about') }}" class="{{ request()->routeIs('about') ? 'active' : '' }}">About Us</a>
                    <a href="{{ url('/#rooms') }}">Rooms</a>
                    <a href="{{ route('contact') }}" class="{{ request()->routeIs('contact') ? 'active' : '' }}">Contact</a>
                    <a href="{{ route('login') }}">Log in</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" style="background: rgba(255,255,255,0.2); padding: 0.5rem 1.5rem; border-radius: 20px;">Register</a>
                    @endif
                @endauth
            </div>
        </div>
    </nav>

    <!-- Content -->
    @yield('content')

    <!-- Footer -->
    <footer class="footer">
        <div class="footer-grid">
            <div>
                <h4>SmartHostel</h4>
                <p>Premium student accommodation designed for the modern scholar. Safe, comfortable, and connected.</p>
            </div>
            <div>
                <h4>Quick Links</h4>
                <ul>
                    <li><a href="{{ url('/') }}">Home</a></li>
                    <li><a href="{{ route('about') }}">About Us</a></li>
                    <li><a href="{{ url('/#rooms') }}">Rooms</a></li>
                    <li><a href="{{ route('contact') }}">Contact Us</a></li>
                </ul>
            </div>
            <div>
                <h4>Contact Us</h4>
                <ul>
                    <li><i class="fas fa-phone mr-2"></i> +254 700 000 000</li>
                    <li><i class="fas fa-envelope mr-2"></i> info@smarthostel.com</li>
                    <li><i class="fas fa-map-marker-alt mr-2"></i> University Way, Nairobi</li>
                </ul>
            </div>
        </div>
        <div style="text-align: center; border-top: 1px solid #333; padding-top: 2rem;">
            <p>&copy; {{ date('Y') }} Smart Hostel Management System. All rights reserved.</p>
        </div>
    </footer>

    <!-- Scripts -->
    <script>
        // Navbar scroll effect
        window.addEventListener('scroll', function() {
            const navbar = document.querySelector('.navbar');
            if (navbar) {
                if (window.scrollY > 50) {
                    navbar.classList.add('scrolled');
                } else {
                    navbar.classList.remove('scrolled');
                }
            }
        });

        // Fade in animation
        const observerOptions = {
            root: null,
            rootMargin: '0px',
            threshold: 0.1
        };

        const observer = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                    observer.unobserve(entry.target);
                }
            });
        }, observerOptions);

        document.querySelectorAll('.fade-in-up').forEach(el => {
            observer.observe(el);
        });

        // Mobile Menu Toggle
        const mobileMenuToggle = document.querySelector('.mobile-menu-toggle');
        const navLinks = document.querySelector('.nav-links');

        if (mobileMenuToggle) {
            mobileMenuToggle.addEventListener('click', () => {
                navLinks.classList.toggle('active');
                const icon = mobileMenuToggle.querySelector('i');
                if (navLinks.classList.contains('active')) {
                    icon.classList.remove('fa-bars');
                    icon.classList.add('fa-times');
                } else {
                    icon.classList.remove('fa-times');
                    icon.classList.add('fa-bars');
                }
            });
        }
    </script>

    <!-- Toastify CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    
    <!-- Toastify JS -->
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>

    <!-- AOS Animation JS -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    
    <!-- Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

    <script>
        // Initialize AOS
        AOS.init({
            duration: 800,
            once: true,
            offset: 100
        });
    </script>

    <script>
        @if(session('success'))
            Toastify({
                text: "{{ session('success') }}",
                duration: 3000,
                close: true,
                gravity: "top",
                position: "right",
                backgroundColor: "#4CAF50",
                stopOnFocus: true
            }).showToast();
        @endif

        @if(session('error'))
            Toastify({
                text: "{{ session('error') }}",
                duration: 3000,
                close: true,
                gravity: "top",
                position: "right",
                backgroundColor: "#F44336",
                stopOnFocus: true
            }).showToast();
        @endif
    </script>
</body>
</html>
