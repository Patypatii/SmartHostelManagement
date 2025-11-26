@extends('layouts.frontend')

@section('title', 'Staff Dashboard')

@section('navbar-class', 'solid')

@section('content')
    <!-- Page Header -->
    <div class="page-header" style="padding-bottom: 6rem;">
        <div class="container" data-aos="fade-up">
            <div class="d-flex justify-content-between align-items-end">
                <div>
                    <h1 class="page-title mb-2">Staff Portal</h1>
                    <p class="text-white-50 mb-0" style="font-size: 1.1rem;">
                        Overview of hostel operations &bull; {{ date('l, F j, Y') }}
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="container" style="margin-top: -4rem;">
        <!-- Stats Row -->
        <div class="grid grid-3 mb-5" data-aos="fade-up" data-aos-delay="100">
            <div class="stat-card d-flex align-items-center gap-3" style="text-align: left; padding: 1.5rem;">
                <div style="width: 60px; height: 60px; background: rgba(255, 193, 7, 0.1); border-radius: 12px; display: flex; align-items: center; justify-content: center; color: var(--color-warning);">
                    <i class="fas fa-exclamation-circle fa-2x"></i>
                </div>
                <div>
                    <div class="stat-card-label mb-1 text-uppercase" style="font-size: 0.8rem; letter-spacing: 1px;">Pending Complaints</div>
                    <div class="stat-card-value text-warning" style="font-size: 1.8rem; font-weight: 700;">
                        {{ $pendingComplaints }}
                    </div>
                </div>
            </div>
            
            <div class="stat-card d-flex align-items-center gap-3" style="text-align: left; padding: 1.5rem;">
                <div style="width: 60px; height: 60px; background: rgba(40, 167, 69, 0.1); border-radius: 12px; display: flex; align-items: center; justify-content: center; color: var(--color-success);">
                    <i class="fas fa-user-check fa-2x"></i>
                </div>
                <div>
                    <div class="stat-card-label mb-1 text-uppercase" style="font-size: 0.8rem; letter-spacing: 1px;">Active Visitors</div>
                    <div class="stat-card-value text-success" style="font-size: 1.8rem; font-weight: 700;">
                        {{ $activeVisitors }}
                    </div>
                </div>
            </div>

            <div class="stat-card d-flex align-items-center gap-3" style="text-align: left; padding: 1.5rem;">
                <div style="width: 60px; height: 60px; background: rgba(23, 162, 184, 0.1); border-radius: 12px; display: flex; align-items: center; justify-content: center; color: var(--color-info);">
                    <i class="fas fa-user-clock fa-2x"></i>
                </div>
                <div>
                    <div class="stat-card-label mb-1 text-uppercase" style="font-size: 0.8rem; letter-spacing: 1px;">Visitor Requests</div>
                    <div class="stat-card-value text-info" style="font-size: 1.8rem; font-weight: 700;">
                        {{ $pendingVisitors }}
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-2" style="gap: 2rem;">
            <!-- Recent Complaints -->
            <div class="card" style="border: none; box-shadow: 0 10px 30px rgba(0,0,0,0.05);" data-aos="fade-right" data-aos-delay="200">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h3 class="card-title mb-0">
                        <i class="fas fa-clipboard-list text-primary mr-2"></i> Recent Complaints
                    </h3>
                    <a href="{{ route('staff.complaints.index') }}" class="btn btn-tertiary btn-sm">View All</a>
                </div>

                @if($recentComplaints->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead style="background: transparent;">
                                <tr>
                                    <th style="border-top: none;">Issue</th>
                                    <th style="border-top: none;">Room</th>
                                    <th style="border-top: none;">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($recentComplaints as $complaint)
                                    <tr>
                                        <td>
                                            <div class="font-weight-bold">{{ Str::limit($complaint->title, 25) }}</div>
                                            <small class="text-muted">{{ $complaint->created_at->diffForHumans() }}</small>
                                        </td>
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
                    <div class="text-center py-4 text-muted">
                        <i class="fas fa-check-circle mb-2 fa-2x text-success" style="opacity: 0.5;"></i>
                        <p>No recent complaints.</p>
                    </div>
                @endif
            </div>

            <!-- Recent Visitors -->
            <div class="card" style="border: none; box-shadow: 0 10px 30px rgba(0,0,0,0.05);" data-aos="fade-left" data-aos-delay="300">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h3 class="card-title mb-0">
                        <i class="fas fa-users text-primary mr-2"></i> Recent Visitors
                    </h3>
                    <a href="{{ route('staff.visitors.index') }}" class="btn btn-tertiary btn-sm">View All</a>
                </div>

                @if($recentVisitors->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead style="background: transparent;">
                                <tr>
                                    <th style="border-top: none;">Visitor</th>
                                    <th style="border-top: none;">Host</th>
                                    <th style="border-top: none;">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($recentVisitors as $visitor)
                                    <tr>
                                        <td>
                                            <div class="font-weight-bold">{{ $visitor->visitor_name }}</div>
                                            <small class="text-muted">{{ $visitor->visitor_phone }}</small>
                                        </td>
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
                    <div class="text-center py-4 text-muted">
                        <i class="fas fa-user-slash mb-2 fa-2x" style="opacity: 0.3;"></i>
                        <p>No recent visitors.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <style>
        .text-white-50 { color: rgba(255, 255, 255, 0.8); }
        @media (max-width: 768px) {
            .grid-2, .grid-3 { grid-template-columns: 1fr !important; }
            .container { margin-top: -2rem !important; }
        }
    </style>
@endsection
