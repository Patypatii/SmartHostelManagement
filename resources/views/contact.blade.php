@extends('layouts.frontend')

@section('title', 'Contact Us')
@section('navbar-class', 'solid')

@section('content')
    <header class="page-header">
        <h1 class="page-title">Contact Us</h1>
        <p class="text-white opacity-75" style="font-size: 1.2rem;">We'd love to hear from you.</p>
    </header>

    <section class="section-padding">
        <div class="feature-grid">
            <!-- Contact Info -->
            <div class="fade-in-up">
                <h2 class="mb-4">Get in Touch</h2>
                <p class="text-muted mb-5">Have questions about bookings, facilities, or general inquiries? Reach out to us using the form or the contact details below.</p>
                
                <div class="d-flex align-items-center gap-3 mb-4">
                    <div class="bg-light p-3 rounded-circle text-primary">
                        <i class="fas fa-phone fa-lg"></i>
                    </div>
                    <div>
                        <h5 class="mb-1">Phone</h5>
                        <p class="text-muted mb-0">+254 700 000 000</p>
                    </div>
                </div>

                <div class="d-flex align-items-center gap-3 mb-4">
                    <div class="bg-light p-3 rounded-circle text-primary">
                        <i class="fas fa-envelope fa-lg"></i>
                    </div>
                    <div>
                        <h5 class="mb-1">Email</h5>
                        <p class="text-muted mb-0">info@smarthostel.com</p>
                    </div>
                </div>

                <div class="d-flex align-items-center gap-3 mb-4">
                    <div class="bg-light p-3 rounded-circle text-primary">
                        <i class="fas fa-map-marker-alt fa-lg"></i>
                    </div>
                    <div>
                        <h5 class="mb-1">Location</h5>
                        <p class="text-muted mb-0">University Way, Nairobi, Kenya</p>
                    </div>
                </div>
            </div>

            <!-- Contact Form -->
            <div class="auth-card fade-in-up" style="transition-delay: 0.2s; max-width: 100%;">
                <h3 class="mb-4">Send Message</h3>
                <form>
                    <div class="mb-3">
                        <label class="form-label">Full Name</label>
                        <input type="text" class="form-control" placeholder="John Doe" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email Address</label>
                        <input type="email" class="form-control" placeholder="john@example.com" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Subject</label>
                        <input type="text" class="form-control" placeholder="Inquiry about..." required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Message</label>
                        <textarea class="form-control" rows="4" placeholder="How can we help you?" required></textarea>
                    </div>
                    <button type="submit" class="btn-primary w-100">Send Message</button>
                </form>
            </div>
        </div>
    </section>
@endsection
