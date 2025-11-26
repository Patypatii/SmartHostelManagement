@extends('layouts.webflow')

@section('title', 'Reports')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1>Reports Center</h1>
            <p class="text-muted">Generate and view system reports</p>
        </div>
        <a href="{{ route('dashboard') }}" class="btn btn-outline">Back to Dashboard</a>
    </div>

    <div class="grid grid-2">
        <!-- Occupancy Report Card -->
        <div class="card">
            <div class="d-flex align-items-center gap-3 mb-3">
                <div class="bg-light p-3 rounded">
                    <i class="fas fa-bed fa-2x text-primary"></i>
                </div>
                <div>
                    <h3 class="card-title mb-1">Occupancy Report</h3>
                    <p class="text-muted mb-0">Room availability and occupancy stats</p>
                </div>
            </div>
            <p>View detailed breakdown of hostel occupancy by block, room type, and availability status.</p>
            <div class="d-flex gap-2 mt-3">
                <a href="{{ route('admin.reports.occupancy') }}" class="btn btn-primary">View Report</a>
                <a href="{{ route('admin.reports.occupancy.export') }}" class="btn btn-outline">
                    <i class="fas fa-download"></i> CSV
                </a>
            </div>
        </div>

        <!-- Revenue Report Card -->
        <div class="card">
            <div class="d-flex align-items-center gap-3 mb-3">
                <div class="bg-light p-3 rounded">
                    <i class="fas fa-chart-line fa-2x text-success"></i>
                </div>
                <div>
                    <h3 class="card-title mb-1">Revenue Report</h3>
                    <p class="text-muted mb-0">Financial performance and income</p>
                </div>
            </div>
            <p>Track monthly revenue, payment methods, and outstanding dues from students.</p>
            <div class="d-flex gap-2 mt-3">
                <a href="{{ route('admin.reports.revenue') }}" class="btn btn-primary">View Report</a>
            </div>
        </div>
    </div>
@endsection
