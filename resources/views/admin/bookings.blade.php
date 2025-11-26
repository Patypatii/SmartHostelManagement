@extends('layouts.webflow')

@section('title', 'Manage Bookings')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1>Manage Bookings</h1>
            <p class="text-muted">Review and approve student booking requests</p>
        </div>
        <a href="{{ route('dashboard') }}" class="btn btn-outline">Back to Dashboard</a>
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

    <div class="card">
        <table class="table">
            <thead>
                <tr>
                    <th>Reference</th>
                    <th>Student</th>
                    <th>Room</th>
                    <th>Date</th>
                    <th>Amount</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($bookings as $booking)
                    <tr>
                        <td>{{ $booking->booking_reference }}</td>
                        <td>
                            <div>{{ $booking->user->name }}</div>
                            <small class="text-muted">{{ $booking->user->student_id }}</small>
                        </td>
                        <td>
                            <div>{{ $booking->room->room_number }}</div>
                            <small class="text-muted">{{ $booking->room->block->name }}</small>
                        </td>
                        <td>{{ $booking->created_at->format('M d, Y') }}</td>
                        <td>KSh {{ number_format($booking->total_amount) }}</td>
                        <td>
                            @if($booking->status === 'approved')
                                <span class="badge badge-success">Approved</span>
                            @elseif($booking->status === 'pending')
                                <span class="badge badge-warning">Pending</span>
                            @elseif($booking->status === 'rejected')
                                <span class="badge badge-danger">Rejected</span>
                            @else
                                <span class="badge badge-secondary">{{ ucfirst($booking->status) }}</span>
                            @endif
                        </td>
                        <td>
                            @if($booking->status === 'pending')
                                <div class="d-flex gap-2">
                                    <form action="{{ route('admin.bookings.approve', $booking) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-primary">Approve</button>
                                    </form>
                                    <form action="{{ route('admin.bookings.reject', $booking) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-outline text-danger" onclick="return confirm('Are you sure?')">Reject</button>
                                    </form>
                                </div>
                            @else
                                <button class="btn btn-sm btn-outline" disabled>Processed</button>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center py-4 text-muted">No bookings found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="mt-4">
            {{ $bookings->links() }}
        </div>
    </div>
@endsection
