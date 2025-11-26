@extends('layouts.webflow')

@section('title', 'Available Rooms')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1>Available Rooms</h1>
            <p class="text-muted">Select a room to book for the semester</p>
        </div>
        <a href="{{ route('dashboard') }}" class="btn btn-outline">Back to Dashboard</a>
    </div>

    @if(session('error'))
        <div class="alert alert-danger mb-4">
            {{ session('error') }}
        </div>
    @endif

    <div class="grid grid-3">
        @php
            $roomImages = [
                'https://images.unsplash.com/photo-1555854877-bab0e564b8d5?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80', // Hostel bunk beds
                'https://images.unsplash.com/photo-1595526114035-0d45ed16cfbf?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80', // Modern bedroom
                'https://images.unsplash.com/photo-1522771753035-4a50356c6518?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80', // Clean room with crib (maybe swap this one) -> Let's use a study desk one
                'https://images.unsplash.com/photo-1519710164239-da123dc03ef4?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80', // Cozy room
                'https://images.unsplash.com/photo-1598928506311-c55ded91a20c?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80', // Minimalist room
            ];
        @endphp

        @forelse($rooms as $index => $room)
            <div class="card p-0 overflow-hidden">
                <img src="{{ $roomImages[$index % count($roomImages)] }}" alt="Room Image" style="width: 100%; height: 200px; object-fit: cover;">
                
                <div class="p-4">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div>
                            <h3 class="card-title mb-1">{{ $room->room_number }}</h3>
                            <span class="text-muted">{{ $room->block->name }}</span>
                        </div>
                        <span class="badge badge-success">Available</span>
                    </div>
                
                <div class="mb-4">
                    <div class="d-flex justify-content-between mb-2">
                        <span>Type:</span>
                        <strong>{{ ucfirst($room->room_type) }}</strong>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span>Floor:</span>
                        <strong>{{ $room->floor }}</strong>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span>Price:</span>
                        <strong>KSh {{ number_format($room->price_per_semester) }}</strong>
                    </div>
                    <div class="d-flex justify-content-between">
                        <span>Capacity:</span>
                        <strong>{{ $room->occupied }} / {{ $room->capacity }}</strong>
                    </div>
                </div>

                <form action="{{ route('student.bookings.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="room_id" value="{{ $room->id }}">
                    <button type="submit" class="btn btn-primary w-100">
                        Book Room
                    </button>
                </form>
                </div> <!-- End of p-4 -->
            </div>
        @empty
            <div class="card" style="grid-column: 1 / -1;">
                <div class="text-center py-5">
                    <p class="text-muted">No rooms available at the moment.</p>
                </div>
            </div>
        @endforelse
    </div>
@endsection
