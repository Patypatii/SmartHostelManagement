@extends('layouts.webflow')

@section('title', 'Staff Dashboard')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0 text-gray-800">Staff Dashboard</h1>
            <p class="text-muted">Overview of hostel operations</p>
        </div>
        <div>
            <span class="badge badge-primary">{{ now()->format('l, d M Y') }}</span>
        </div>
    </div>

    <!-- Stats Grid -->
    <div class="grid grid-3 mb-5">
        <div class="stat-card">
            <div class="stat-card-value text-warning">{{ $pendingComplaints }}</div>
            <div class="stat-card-label">Pending Complaints</div>
        </div>
        <div class="stat-card">
            <div class="stat-card-value text-success">{{ $activeVisitors }}</div>
            <div class="stat-card-label">Active Visitors</div>
        </div>
        <div class="stat-card">
            <div class="stat-card-value text-info">{{ $pendingVisitors }}</div>
            <div class="stat-card-label">Visitor Requests</div>
        </div>
    </div>

    <div class="grid grid-2">
        <!-- Recent Complaints -->
        <div class="card">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h3 class="card-title h5 mb-0">Recent Complaints</h3>
                <a href="{{ route('staff.complaints.index') }}" class="btn btn-sm btn-outline">View All</a>
            </div>
            
            @if($recentComplaints->count() > 0)
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Issue</th>
                                <th>Room</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($recentComplaints as $complaint)
                                <tr>
                                    <td>{{ Str::limit($complaint->title, 20) }}</td>
                                    <td>{{ $complaint->room->room_number ?? 'N/A' }}</td>
                                    <td>
                                        <span class="badge badge-{{ $complaint->status === 'resolved' ? 'success' : ($complaint->status === 'pending' ? 'warning' : 'info') }}">
                                            {{ ucfirst($complaint->status) }}
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <p class="text-muted text-center py-3">No recent complaints.</p>
            @endif
        </div>

        <!-- Recent Visitors -->
        <div class="card">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h3 class="card-title h5 mb-0">Recent Visitors</h3>
                <a href="{{ route('staff.visitors.index') }}" class="btn btn-sm btn-outline">View All</a>
            </div>

            @if($recentVisitors->count() > 0)
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Visitor</th>
                                <th>Host</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($recentVisitors as $visitor)
                                <tr>
                                    <td>{{ $visitor->visitor_name }}</td>
                                    <td>{{ $visitor->host->name ?? 'N/A' }}</td>
                                    <td>
                                        <span class="badge badge-{{ $visitor->status === 'checked_in' ? 'success' : ($visitor->status === 'pending' ? 'warning' : 'secondary') }}">
                                            {{ ucfirst(str_replace('_', ' ', $visitor->status)) }}
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <p class="text-muted text-center py-3">No recent visitors.</p>
            @endif
        </div>
    </div>
@endsection
