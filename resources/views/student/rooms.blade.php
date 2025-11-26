@extends('layouts.frontend')

@section('title', 'Available Rooms')

@section('navbar-class', 'solid')

@section('content')
    <!-- Page Header -->
    <div class="page-header">
        <div class="container" data-aos="fade-up">
            <h1 class="page-title">Available Rooms</h1>
            <p class="text-white-50" style="font-size: 1.2rem; max-width: 600px; margin: 0 auto;">
                Find your perfect home away from home. Browse our selection of premium student accommodations.
            </p>
        </div>
    </div>

    <div class="container section-padding">
        <!-- Actions Bar -->
        <div class="d-flex justify-content-between align-items-center mb-5" data-aos="fade-up" data-aos-delay="100">
            <div class="d-flex align-items-center gap-3">
                <span class="text-muted">Showing all available rooms</span>
            </div>
            <div class="d-flex gap-2">
                <button class="btn btn-outline btn-sm"><i class="fas fa-filter mr-2"></i> Filter</button>
                <a href="{{ route('dashboard') }}" class="btn btn-secondary btn-sm">Back to Dashboard</a>
            </div>
        </div>

        @if(session('error'))
            <div class="alert alert-danger mb-4" data-aos="fade-in">
                {{ session('error') }}
            </div>
        @endif

        <div class="grid grid-3">
            @php
                $roomImages = [
                    'https://images.unsplash.com/photo-1555854877-bab0e564b8d5?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80', // Hostel bunk beds
                    'https://images.unsplash.com/photo-1595526114035-0d45ed16cfbf?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80', // Modern bedroom
                    'https://images.unsplash.com/photo-1522771753035-4a50356c6518?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80', // Study desk
                    'https://images.unsplash.com/photo-1519710164239-da123dc03ef4?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80', // Cozy room
                    'https://images.unsplash.com/photo-1598928506311-c55ded91a20c?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80', // Minimalist room
                ];
            @endphp

            @forelse($rooms as $index => $room)
                <div class="room-card" data-aos="fade-up" data-aos-delay="{{ ($index % 3) * 100 }}">
                    <div class="position-relative">
                        <img src="{{ $roomImages[$index % count($roomImages)] }}" alt="Room Image" class="room-img">
                        <span class="badge badge-success position-absolute" style="top: 1rem; right: 1rem; box-shadow: 0 2px 10px rgba(0,0,0,0.1);">
                            Available
                        </span>
                    </div>
                    
                    <div class="room-details">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <div>
                                <h3 class="card-title mb-1" style="font-size: 1.5rem;">{{ $room->room_number }}</h3>
                                <span class="text-muted"><i class="fas fa-building mr-1"></i> {{ $room->block->name }}</span>
                            </div>
                            <div class="text-right">
                                <span class="room-price" style="font-size: 1.2rem;">KSh {{ number_format($room->price_per_semester / 1000) }}k</span>
                                <small class="d-block text-muted">/semester</small>
                            </div>
                        </div>
                    
                        <div class="mb-4">
                            <div class="d-flex justify-content-between mb-2 pb-2 border-bottom">
                                <span class="text-muted">Type</span>
                                <strong>{{ ucfirst($room->room_type) }}</strong>
                            </div>
                            <div class="d-flex justify-content-between mb-2 pb-2 border-bottom">
                                <span class="text-muted">Floor</span>
                                <strong>{{ $room->floor }}</strong>
                            </div>
                            <div class="d-flex justify-content-between">
                                <span class="text-muted">Capacity</span>
                                <strong>{{ $room->occupied }} / {{ $room->capacity }} Students</strong>
                            </div>
                        </div>

                        <a href="{{ route('student.rooms.show', $room->id) }}" class="btn btn-primary w-100">
                            View Details & Book
                        </a>
                    </div>
                </div>
            @empty
                <div class="card" style="grid-column: 1 / -1;" data-aos="fade-in">
                    <div class="text-center py-5">
                        <div class="mb-3">
                            <i class="fas fa-search fa-3x text-muted"></i>
                        </div>
                        <h3>No rooms found</h3>
                        <p class="text-muted">Check back later or try adjusting your filters.</p>
                    </div>
                </div>
            @endforelse
        </div>
    </div>

    <style>
        .position-relative { position: relative; }
        .position-absolute { position: absolute; }
        .border-bottom { border-bottom: 1px solid var(--color-border); }
        .pb-2 { padding-bottom: 0.5rem; }
        .text-white-50 { color: rgba(255, 255, 255, 0.8); }
    </style>
@endsection
