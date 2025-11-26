@extends('layouts.frontend')

@section('title', 'About Us')
@section('navbar-class', 'solid')

@section('content')
    <header class="page-header">
        <h1 class="page-title">About SmartHostel</h1>
        <p class="text-white opacity-75" style="font-size: 1.2rem;">Redefining the student living experience.</p>
    </header>

    <section class="section-padding">
        <div class="feature-grid" style="align-items: center;">
            <div class="fade-in-up">
                <img src="https://images.unsplash.com/photo-1522071820081-009f0129c71c?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80" alt="Our Team" style="width: 100%; border-radius: 16px; box-shadow: 0 10px 30px rgba(0,0,0,0.1);">
            </div>
            <div class="fade-in-up" style="transition-delay: 0.2s;">
                <h2 class="section-title" style="text-align: left;">Our Mission</h2>
                <p class="text-muted mb-4">
                    At SmartHostel, we believe that where you live shapes how you learn. Our mission is to provide students with a safe, comfortable, and inspiring environment that supports their academic and personal growth.
                </p>
                <p class="text-muted mb-4">
                    Founded in 2024, we have grown from a single block to a premier student accommodation provider, serving over 500 students with state-of-the-art facilities and a vibrant community atmosphere.
                </p>
                <div class="d-flex gap-3">
                    <div class="stat-item text-primary">
                        <h3 style="font-size: 2rem; font-weight: 700;">5+</h3>
                        <p>Years Experience</p>
                    </div>
                    <div class="stat-item text-primary">
                        <h3 style="font-size: 2rem; font-weight: 700;">3</h3>
                        <p>Hostel Blocks</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section-padding" style="background: #f8f9fa;">
        <h2 class="section-title">Our Values</h2>
        <div class="feature-grid">
            <div class="feature-card p-4 text-center fade-in-up">
                <i class="fas fa-shield-alt fa-3x text-primary mb-3"></i>
                <h3>Safety First</h3>
                <p class="text-muted">We prioritize the security and well-being of our residents above all else.</p>
            </div>
            <div class="feature-card p-4 text-center fade-in-up" style="transition-delay: 0.2s;">
                <i class="fas fa-users fa-3x text-primary mb-3"></i>
                <h3>Community</h3>
                <p class="text-muted">Fostering a sense of belonging and collaboration among students.</p>
            </div>
            <div class="feature-card p-4 text-center fade-in-up" style="transition-delay: 0.4s;">
                <i class="fas fa-star fa-3x text-primary mb-3"></i>
                <h3>Excellence</h3>
                <p class="text-muted">Delivering premium facilities and exceptional service standards.</p>
            </div>
        </div>
    </section>
@endsection
