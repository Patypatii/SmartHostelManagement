<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Smart Hostel MS') }} - @yield('title', 'Dashboard')</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=outfit:300,400,500,600,700&display=swap" rel="stylesheet" />
    
    <!-- Webflow Design System -->
    <link rel="stylesheet" href="{{ asset('css/webflow-design-system.css') }}">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'Outfit', sans-serif;
            background-color: #f8f9fa;
        }
        
        .navbar {
            background: #146EF5;
            color: white;
            padding: 1rem 2rem;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        .navbar-brand {
            color: white;
            font-weight: 700;
            font-size: 1.5rem;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .navbar-nav {
            display: flex;
            align-items: center;
            gap: 1.5rem;
            list-style: none;
            margin: 0;
            padding: 0;
        }

        .navbar-nav a {
            color: rgba(255,255,255,0.9);
            text-decoration: none;
            font-weight: 500;
            transition: color 0.2s;
        }

        .navbar-nav a:hover {
            color: white;
        }

        .sidebar {
            background: white;
            border-right: 1px solid #eee;
        }

        .sidebar-nav-link {
            color: #666;
            border-radius: 8px;
            margin-bottom: 0.5rem;
            transition: all 0.2s;
        }

        .sidebar-nav-link:hover, .sidebar-nav-link.active {
            background: #f0f7ff;
            color: #146EF5;
        }

        .main-content {
            padding: 2rem;
            min-height: calc(100vh - 160px); /* Adjust for navbar + footer */
        }

        /* Footer Styles */
        .app-footer {
            background: white;
            border-top: 1px solid #eee;
            padding: 1.5rem 2rem;
            margin-top: auto;
            color: #666;
            font-size: 0.9rem;
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar">
        <div class="d-flex justify-content-between align-items-center w-100">
            <div class="d-flex align-items-center gap-3">
                @auth
                <button id="sidebarToggle" class="btn btn-link text-white p-0 d-md-none" style="font-size: 1.5rem;">
                    <i class="fas fa-bars"></i>
                </button>
                @endauth
                <a href="{{ route('dashboard') }}" class="navbar-brand">
                    <i class="fas fa-building"></i> SmartHostel
                </a>
            </div>
            <ul class="navbar-nav">
                @auth
                    <li>
                        <div class="d-flex align-items-center gap-2">
                            <div style="width: 32px; height: 32px; background: rgba(255,255,255,0.2); border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                                <i class="fas fa-user"></i>
                            </div>
                            <span>{{ Auth::user()->name }}</span>
                        </div>
                    </li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="btn btn-outline btn-sm text-white border-white hover:bg-white hover:text-primary">
                                <i class="fas fa-sign-out-alt"></i> Logout
                            </button>
                        </form>
                    </li>
                @else
                    <li><a href="{{ route('login') }}">Login</a></li>
                    <li><a href="{{ route('register') }}" class="btn btn-light btn-sm text-primary">Register</a></li>
                @endauth
            </ul>
        </div>
    </nav>

    <div class="d-flex">
        @auth
        <!-- Sidebar -->
        <aside class="sidebar" style="width: 250px; min-height: calc(100vh - 70px); padding: 1.5rem;">
            <ul class="sidebar-nav" style="list-style: none; padding: 0;">
                <li class="mb-3 text-muted small text-uppercase font-weight-bold">Menu</li>
                
                @if(Auth::user()->role === 'admin')
                    <li>
                        <a href="{{ route('dashboard') }}" class="sidebar-nav-link d-flex align-items-center gap-3 p-2 {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                            <i class="fas fa-home fa-fw"></i> Dashboard
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.bookings') }}" class="sidebar-nav-link d-flex align-items-center gap-3 p-2 {{ request()->routeIs('admin.bookings*') ? 'active' : '' }}">
                            <i class="fas fa-calendar-check fa-fw"></i> Bookings
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.reports.index') }}" class="sidebar-nav-link d-flex align-items-center gap-3 p-2 {{ request()->routeIs('admin.reports*') ? 'active' : '' }}">
                            <i class="fas fa-chart-bar fa-fw"></i> Reports
                        </a>
                    </li>
                    <li>
                        <a href="#" class="sidebar-nav-link d-flex align-items-center gap-3 p-2">
                            <i class="fas fa-users fa-fw"></i> Students
                        </a>
                    </li>
                    <li>
                        <a href="#" class="sidebar-nav-link d-flex align-items-center gap-3 p-2">
                            <i class="fas fa-bed fa-fw"></i> Rooms
                        </a>
                    </li>
                @elseif(Auth::user()->role === 'student')
                    <li>
                        <a href="{{ route('dashboard') }}" class="sidebar-nav-link d-flex align-items-center gap-3 p-2 {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                            <i class="fas fa-home fa-fw"></i> Dashboard
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('student.rooms') }}" class="sidebar-nav-link d-flex align-items-center gap-3 p-2 {{ request()->routeIs('student.rooms*') ? 'active' : '' }}">
                            <i class="fas fa-bed fa-fw"></i> Book Room
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('student.payments.index') }}" class="sidebar-nav-link d-flex align-items-center gap-3 p-2 {{ request()->routeIs('student.payments*') ? 'active' : '' }}">
                            <i class="fas fa-history fa-fw"></i> Payments
                        </a>
                    </li>
                    <li>
                        <a href="#" class="sidebar-nav-link d-flex align-items-center gap-3 p-2">
                            <i class="fas fa-comment-alt fa-fw"></i> Complaints
                        </a>
                    </li>
                @elseif(Auth::user()->role === 'staff')
                    <li>
                        <a href="{{ route('staff.dashboard') }}" class="sidebar-nav-link d-flex align-items-center gap-3 p-2 {{ request()->routeIs('staff.dashboard') ? 'active' : '' }}">
                            <i class="fas fa-home fa-fw"></i> Dashboard
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('staff.complaints.index') }}" class="sidebar-nav-link d-flex align-items-center gap-3 p-2 {{ request()->routeIs('staff.complaints*') ? 'active' : '' }}">
                            <i class="fas fa-exclamation-circle fa-fw"></i> Complaints
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('staff.visitors.index') }}" class="sidebar-nav-link d-flex align-items-center gap-3 p-2 {{ request()->routeIs('staff.visitors*') ? 'active' : '' }}">
                            <i class="fas fa-user-friends fa-fw"></i> Visitors
                        </a>
                    </li>
                @endif
            </ul>
        </aside>
        @endauth

        <!-- Main Content -->
        <div class="flex-grow-1 d-flex flex-column">
            <main class="main-content" style="{{ Auth::check() ? '' : 'margin-left: 0;' }}">
                @yield('content')
            </main>

            <!-- App Footer -->
            <footer class="app-footer">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        &copy; {{ date('Y') }} Smart Hostel MS. All rights reserved.
                    </div>
                    <div class="d-flex gap-3">
                        <a href="#" class="text-muted text-decoration-none">Privacy Policy</a>
                        <a href="#" class="text-muted text-decoration-none">Terms of Service</a>
                        <a href="#" class="text-muted text-decoration-none">Support</a>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    @stack('scripts')
    <!-- Toastify CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    
    <!-- Toastify JS -->
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>

    <script>
        // Check for Laravel Session Messages
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

        @if(session('status'))
            Toastify({
                text: "{{ session('status') }}",
                duration: 3000,
                close: true,
                gravity: "top",
                position: "right",
                backgroundColor: "#2196F3",
                stopOnFocus: true
            }).showToast();
        @endif
        
        @if($errors->any())
            @foreach($errors->all() as $error)
                Toastify({
                    text: "{{ $error }}",
                    duration: 4000,
                    close: true,
                    gravity: "top",
                    position: "right",
                    backgroundColor: "#F44336",
                    stopOnFocus: true
                }).showToast();
            @endforeach
        @endif

        // Sidebar Toggle Script
        document.addEventListener('DOMContentLoaded', function() {
            const sidebarToggle = document.getElementById('sidebarToggle');
            const sidebar = document.querySelector('.sidebar');
            
            if (sidebarToggle && sidebar) {
                sidebarToggle.addEventListener('click', function() {
                    sidebar.classList.toggle('active');
                });
            }
        });
    </script>
</body>
</html>
