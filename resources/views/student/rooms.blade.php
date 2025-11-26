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
        @forelse($rooms as $room)
            <div class="card">
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

                <form action="{{ route('student.book', $room) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-primary w-100">
                        Book Room
                    </button>
                </form>
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
