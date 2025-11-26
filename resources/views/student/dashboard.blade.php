@extends('layouts.webflow')

@section('title', 'Student Dashboard')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1>My Dashboard</h1>
            <p class="text-muted">Welcome back, {{ Auth::user()->name }}!</p>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('student.rooms') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> New Booking
            </a>
        </div>
    </div>

    @if(session('status'))
        <div class="alert alert-success mb-4">
            {{ session('status') }}
        </div>
    @endif
    
    @if(session('error'))
        <div class="alert alert-danger mb-4">
            {{ session('error') }}
        </div>
    @endif

    <!-- Statistics Cards -->
    <div class="grid grid-3 mb-5">
        <div class="stat-card">
            <div class="stat-card-value">A101</div>
            <div class="stat-card-label">My Room</div>
        </div>
        <div class="stat-card">
            <div class="stat-card-value">KSh 0</div>
            <div class="stat-card-label">Pending Dues</div>
        </div>
        <div class="stat-card">
            <div class="stat-card-value">Active</div>
            <div class="stat-card-label">Booking Status</div>
        </div>
    </div>

    <div class="grid grid-2">
        <!-- My Room Details -->
        <div class="card">
            <h3 class="card-title">My Room Details</h3>
            <div class="mb-3">
                <strong>Block:</strong> Block A<br>
                <strong>Room Number:</strong> 101<br>
                <strong>Type:</strong> Single<br>
                <strong>Floor:</strong> 1st Floor
            </div>
            <button class="btn btn-outline btn-sm">View Room Info</button>
        </div>

        <!-- Quick Actions -->
        <div class="card">
            <h3 class="card-title">Quick Actions</h3>
            <div class="d-flex gap-2 flex-wrap">
                @if($activeBooking && $activeBooking->status === 'approved')
                    <a href="{{ route('student.payments.create', $activeBooking) }}" class="btn btn-primary w-100 mb-2">
                        <i class="fas fa-credit-card"></i> Make Payment
                    </a>
                @else
                    <button class="btn btn-primary w-100 mb-2" disabled>
                        <i class="fas fa-credit-card"></i> Make Payment
                    </button>
                @endif
                <button class="btn btn-outline w-100 mb-2">
                    <i class="fas fa-exclamation-triangle"></i> Report Issue
                </button>
                <a href="{{ route('student.payments.index') }}" class="btn btn-outline w-100">
                    <i class="fas fa-history"></i> Payment History
                </a>
            </div>
        </div>
    </div>
@endsection
