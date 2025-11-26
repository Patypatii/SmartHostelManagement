@extends('layouts.webflow')

@section('title', 'Occupancy Report')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1>Occupancy Report</h1>
            <p class="text-muted">As of {{ now()->format('M d, Y') }}</p>
        </div>
        <div class="d-flex gap-2">
            <button onclick="window.print()" class="btn btn-outline">
                <i class="fas fa-print"></i> Print
            </button>
            <a href="{{ route('admin.reports.occupancy.export') }}" class="btn btn-primary">
                <i class="fas fa-download"></i> Export CSV
            </a>
        </div>
    </div>

    <!-- Summary Stats -->
    <div class="grid grid-3 mb-5">
        <div class="stat-card">
            <div class="stat-card-value">{{ $totalCapacity }}</div>
            <div class="stat-card-label">Total Capacity</div>
        </div>
        <div class="stat-card">
            <div class="stat-card-value">{{ $totalOccupied }}</div>
            <div class="stat-card-label">Total Occupied</div>
        </div>
        <div class="stat-card">
            <div class="stat-card-value">{{ $occupancyRate }}%</div>
            <div class="stat-card-label">Occupancy Rate</div>
        </div>
    </div>

    <!-- Block Breakdown -->
    <div class="card">
        <h3 class="card-title mb-3">Block Breakdown</h3>
        <table class="table">
            <thead>
                <tr>
                    <th>Block Name</th>
                    <th>Gender</th>
                    <th>Total Rooms</th>
                    <th>Occupied Rooms</th>
                    <th>Utilization</th>
                </tr>
            </thead>
            <tbody>
                @foreach($blocks as $block)
                    @php
                        $utilization = $block->total_rooms > 0 ? round(($block->occupied_rooms / $block->total_rooms) * 100, 1) : 0;
                    @endphp
                    <tr>
                        <td>{{ $block->name }}</td>
                        <td>{{ ucfirst($block->gender) }}</td>
                        <td>{{ $block->total_rooms }}</td>
                        <td>{{ $block->occupied_rooms }}</td>
                        <td>
                            <div class="d-flex align-items-center gap-2">
                                <div style="flex-grow: 1; background: #eee; height: 8px; border-radius: 4px; overflow: hidden;">
                                    <div style="width: {{ $utilization }}%; background: var(--color-primary); height: 100%;"></div>
                                </div>
                                <span>{{ $utilization }}%</span>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
