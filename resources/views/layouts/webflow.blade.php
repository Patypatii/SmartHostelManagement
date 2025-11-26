<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Smart Hostel MS') }} - @yield('title', 'Dashboard')</title>
    
    <!-- Webflow Design System -->
    <link rel="stylesheet" href="{{ asset('css/webflow-design-system.css') }}">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar">
        <div class="navbar-container">
            <a href="{{ route('dashboard') }}" class="navbar-brand">Smart Hostel MS</a>
            <ul class="navbar-nav">
                @auth
                    <li><span class="text-muted">Welcome, {{ Auth::user()->name }}</span></li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="btn btn-primary btn-sm">Logout</button>
                        </form>
                    </li>
                @else
                    <li><a href="{{ route('login') }}" class="nav-link">Login</a></li>
                    <li><a href="{{ route('register') }}" class="btn btn-primary btn-sm">Register</a></li>
                @endauth
            </ul>
        </div>
    </nav>

    @auth
    <!-- Sidebar -->
    <aside class="sidebar">
        <ul class="sidebar-nav">
            @if(Auth::user()->role === 'admin')
                <li class="sidebar-nav-item">
                    <a href="{{ route('dashboard') }}" class="sidebar-nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                        <i class="fas fa-home"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="sidebar-nav-item">
                    <a href="#" class="sidebar-nav-link">
                        <i class="fas fa-bed"></i>
                        <span>Rooms</span>
                    </a>
                </li>
                <li class="sidebar-nav-item">
                    <a href="#" class="sidebar-nav-link">
                        <i class="fas fa-users"></i>
                        <span>Students</span>
                    </a>
                </li>
                <li class="sidebar-nav-item">
                    <a href="#" class="sidebar-nav-link">
                        <i class="fas fa-calendar-check"></i>
                        <span>Bookings</span>
                    </a>
                </li>
                <li class="sidebar-nav-item">
                    <a href="#" class="sidebar-nav-link">
                        <i class="fas fa-money-bill"></i>
                        <span>Payments</span>
                    </a>
                </li>
                <li class="sidebar-nav-item">
                    <a href="#" class="sidebar-nav-link">
                        <i class="fas fa-exclamation-circle"></i>
                        <span>Complaints</span>
                    </a>
                </li>
            @elseif(Auth::user()->role === 'student')
                <li class="sidebar-nav-item">
                    <a href="{{ route('dashboard') }}" class="sidebar-nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                        <i class="fas fa-home"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="sidebar-nav-item">
                    <a href="#" class="sidebar-nav-link">
                        <i class="fas fa-bed"></i>
                        <span>My Room</span>
                    </a>
                </li>
                <li class="sidebar-nav-item">
                    <a href="#" class="sidebar-nav-link">
                        <i class="fas fa-calendar-plus"></i>
                        <span>Book Room</span>
                    </a>
                </li>
                <li class="sidebar-nav-item">
                    <a href="#" class="sidebar-nav-link">
                        <i class="fas fa-history"></i>
                        <span>Payments</span>
                    </a>
                </li>
                <li class="sidebar-nav-item">
                    <a href="#" class="sidebar-nav-link">
                        <i class="fas fa-comment-alt"></i>
                        <span>Complaints</span>
                    </a>
                </li>
            @endif
        </ul>
    </aside>
    @endauth

    <!-- Main Content -->
    <main class="{{ Auth::check() ? 'main-content' : 'container mt-5' }}">
        @yield('content')
    </main>

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    @stack('scripts')
</body>
</html>
