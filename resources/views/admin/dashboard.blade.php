@extends('layouts.webflow')

@section('title', 'Admin Dashboard')

@section('content')
            <div class="stat-card-value">{{ $totalStudents }}</div>
            <div class="stat-card-label">Total Students</div>
        </div>
        <div class="stat-card">
            <div class="stat-card-value">{{ $totalRooms }}</div>
            <div class="stat-card-label">Total Rooms</div>
        </div>
        <div class="stat-card">
            <div class="stat-card-value">{{ $occupancyRate }}%</div>
            <div class="stat-card-label">Occupancy Rate</div>
        </div>
        <div class="stat-card">
            <div class="stat-card-value">KSh {{ number_format($monthlyRevenue) }}</div>
            <div class="stat-card-label">Revenue (Monthly)</div>
        </div>
    </div>

    <!-- Recent Bookings -->
    <div class="card mb-5">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3 class="card-title mb-0">Recent Bookings</h3>
            <a href="{{ route('admin.bookings') }}" class="btn btn-sm btn-outline">View All</a>
        </div>

        <table class="table">
            <thead>
                <tr>
                    <th>Booking ID</th>
                    <th>Student Name</th>
                    <th>Room</th>
                    <th>Date</th>
                    <th>Amount</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>#BK001</td>
                    <td>John Doe</td>
                    <td>A101</td>
                    <td>2024-01-15</td>
                    <td>KSh 15,000</td>
                    <td><span class="badge badge-success">Confirmed</span></td>
                    <td>
                        <button class="btn btn-sm btn-outline">View</button>
                    </td>
                </tr>
                <tr>
                    <td>#BK002</td>
                    <td>Jane Smith</td>
                    <td>B205</td>
                    <td>2024-01-14</td>
                    <td>KSh 15,000</td>
                    <td><span class="badge badge-warning">Pending</span></td>
                    <td>
                        <button class="btn btn-sm btn-primary">Approve</button>
                    </td>
                </tr>
                <tr>
                    <td>#BK003</td>
                    <td>Mike Johnson</td>
                    <td>A303</td>
                    <td>2024-01-14</td>
                    <td>KSh 12,000</td>
                    <td><span class="badge badge-success">Confirmed</span></td>
                    <td>
                        <button class="btn btn-sm btn-outline">View</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- Charts Row -->
    <div class="grid grid-2">
        <!-- Occupancy Chart -->
        <div class="card">
            <h3 class="card-title">Occupancy Trend</h3>
            <canvas id="occupancyChart"></canvas>
        </div>

        <!-- Revenue Chart -->
        <div class="card">
            <h3 class="card-title">Revenue Overview</h3>
            <canvas id="revenueChart"></canvas>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('js/dashboard-charts.js') }}"></script>
@endpush
