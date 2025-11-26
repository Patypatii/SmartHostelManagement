@extends('layouts.frontend')

@section('title', 'Student Dashboard')

@section('navbar-class', 'solid')

@section('content')
    <!-- Page Header -->
    <div class="page-header" style="padding-bottom: 6rem;">
        <div class="container" data-aos="fade-up">
            <div class="d-flex justify-content-between align-items-end">
                <div>
                    <h1 class="page-title mb-2">Welcome back, {{ Auth::user()->name }}! 👋</h1>
                    <p class="text-white-50 mb-0" style="font-size: 1.1rem;">
                        Student Portal &bull; {{ Auth::user()->email }}
                    </p>
                </div>
                <div class="d-none d-md-block">
                    <span class="badge badge-light" style="font-size: 1rem; padding: 0.5rem 1rem; color: #146EF5;">
                        {{ date('l, F j, Y') }}
                    </span>
                </div>
            </div>
        </div>
    </div>

    <div class="container" style="margin-top: -4rem;">
        <!-- Stats Row -->
        <div class="grid grid-3 mb-5" data-aos="fade-up" data-aos-delay="100">
            <div class="stat-card d-flex align-items-center gap-3" style="text-align: left; padding: 1.5rem;">
                <div style="width: 60px; height: 60px; background: rgba(20, 110, 245, 0.1); border-radius: 12px; display: flex; align-items: center; justify-content: center; color: var(--color-primary);">
                    <i class="fas fa-bed fa-2x"></i>
                </div>
                <div>
                    <div class="stat-card-label mb-1 text-uppercase" style="font-size: 0.8rem; letter-spacing: 1px;">My Room</div>
                    <div class="stat-card-value" style="font-size: 1.8rem; font-weight: 700;">
                        @if($activeBooking && $activeBooking->room)
                            {{ $activeBooking->room->room_number }}
                        @else
                            --
                        @endif
                    </div>
                </div>
            </div>
            
            <div class="stat-card d-flex align-items-center gap-3" style="text-align: left; padding: 1.5rem;">
                <div style="width: 60px; height: 60px; background: rgba(220, 53, 69, 0.1); border-radius: 12px; display: flex; align-items: center; justify-content: center; color: var(--color-danger);">
                    <i class="fas fa-wallet fa-2x"></i>
                </div>
                <div>
                    <div class="stat-card-label mb-1 text-uppercase" style="font-size: 0.8rem; letter-spacing: 1px;">Pending Dues</div>
                    <div class="stat-card-value {{ $pendingDues > 0 ? 'text-danger' : 'text-success' }}" style="font-size: 1.8rem; font-weight: 700;">
                        KSh {{ number_format($pendingDues) }}
                    </div>
                </div>
            </div>

            <div class="stat-card d-flex align-items-center gap-3" style="text-align: left; padding: 1.5rem;">
                <div style="width: 60px; height: 60px; background: rgba(40, 167, 69, 0.1); border-radius: 12px; display: flex; align-items: center; justify-content: center; color: var(--color-success);">
                    <i class="fas fa-check-circle fa-2x"></i>
                </div>
                <div>
                    <div class="stat-card-label mb-1 text-uppercase" style="font-size: 0.8rem; letter-spacing: 1px;">Status</div>
                    <div class="stat-card-value" style="font-size: 1.8rem; font-weight: 700;">
                        @if($activeBooking)
                            <span class="badge badge-{{ $activeBooking->status === 'approved' ? 'success' : ($activeBooking->status === 'pending' ? 'warning' : 'danger') }}" style="font-size: 0.9rem;">
                                {{ ucfirst($activeBooking->status) }}
                            </span>
                        @else
                            <span class="badge badge-secondary" style="font-size: 0.9rem;">Not Booked</span>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-2" style="grid-template-columns: 2fr 1fr; gap: 2rem;">
            <!-- Left Column -->
            <div data-aos="fade-right" data-aos-delay="200">
                
                <!-- Current Booking Details -->
                <div class="card mb-4" style="border: none; box-shadow: 0 10px 30px rgba(0,0,0,0.05);">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h3 class="card-title mb-0">
                            <i class="fas fa-home text-primary mr-2"></i> Current Accommodation
                        </h3>
                        <!-- Removed redundant 'Book Now' button here since it's in the empty state -->
                    </div>

                    @if($activeBooking && $activeBooking->room)
                        <div class="room-preview-card">
                            <div class="row" style="display: flex; flex-wrap: wrap; gap: 1.5rem;">
                                <div style="flex: 0 0 200px; border-radius: 12px; overflow: hidden;">
                                    @php
                                        $roomImages = [
                                            'https://images.unsplash.com/photo-1555854877-bab0e564b8d5?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80',
                                            'https://images.unsplash.com/photo-1595526114035-0d45ed16cfbf?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80',
                                            'https://images.unsplash.com/photo-1522771753035-4a50356c6518?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80',
                                        ];
                                        $imageIndex = $activeBooking->room->id % count($roomImages);
                                    @endphp
                                    <img src="{{ $roomImages[$imageIndex] }}" alt="Room" style="width: 100%; height: 100%; object-fit: cover; min-height: 150px;">
                                </div>
                                <div style="flex: 1;">
                                    <h4 class="mb-2">{{ $activeBooking->room->block->name ?? 'Block A' }} - Room {{ $activeBooking->room->room_number }}</h4>
                                    <div class="d-flex gap-2 mb-3">
                                        <span class="badge badge-info">{{ ucfirst($activeBooking->room->room_type) }}</span>
                                        <span class="badge badge-secondary">Floor {{ $activeBooking->room->floor }}</span>
                                    </div>
                                    
                                    <div class="d-flex justify-content-between align-items-center p-3" style="background: #f8f9fa; border-radius: 8px;">
                                        <div>
                                            <small class="text-muted d-block">Period</small>
                                            <strong>{{ \Carbon\Carbon::parse($activeBooking->start_date)->format('M Y') }} - {{ \Carbon\Carbon::parse($activeBooking->end_date)->format('M Y') }}</strong>
                                        </div>
                                        @if($activeBooking->status === 'approved')
                                            <a href="{{ route('student.payments.create', $activeBooking) }}" class="btn btn-primary btn-sm">
                                                Pay Rent
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="text-center py-5" style="background: #f8f9fa; border-radius: 12px; border: 2px dashed #e9ecef;">
                            <div style="width: 80px; height: 80px; background: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1.5rem; box-shadow: 0 5px 15px rgba(0,0,0,0.05);">
                                <i class="fas fa-bed fa-2x text-primary"></i>
                            </div>
                            <h4 class="text-muted">No Active Booking</h4>
                            <p class="text-muted small mb-4">You haven't booked a room for this semester yet.</p>
                            <a href="{{ route('student.rooms') }}" class="btn btn-primary px-4 py-2" style="border-radius: 30px;">
                                <i class="fas fa-search mr-2"></i> Browse Available Rooms
                            </a>
                        </div>
                    @endif
                </div>

                <!-- Recent Transactions -->
                <div class="card" style="border: none; box-shadow: 0 10px 30px rgba(0,0,0,0.05);">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h3 class="card-title mb-0">
                            <i class="fas fa-history text-primary mr-2"></i> Recent Activity
                        </h3>
                        <a href="{{ route('student.payments.index') }}" class="btn btn-tertiary btn-sm">View All</a>
                    </div>

                    @if($recentPayments->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead style="background: transparent;">
                                    <tr>
                                        <th style="border-top: none;">Date</th>
                                        <th style="border-top: none;">Description</th>
                                        <th style="border-top: none;">Amount</th>
                                        <th style="border-top: none;">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($recentPayments as $payment)
                                        <tr>
                                            <td>
                                                <div class="font-weight-bold">{{ $payment->created_at->format('d M') }}</div>
                                                <small class="text-muted">{{ $payment->created_at->format('Y') }}</small>
                                            </td>
                                            <td>
                                                <div>Payment #{{ substr($payment->transaction_reference, -6) }}</div>
                                                <small class="text-muted">Rent Payment</small>
                                            </td>
                                            <td class="font-weight-bold">KSh {{ number_format($payment->amount) }}</td>
                                            <td>
                                                <span class="badge badge-success px-2 py-1" style="border-radius: 20px;">Paid</span>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-4 text-muted">
                            <i class="fas fa-receipt mb-2"></i>
                            <p>No recent transactions.</p>
                        </div>
                    @endif
                </div>

            </div>

            <!-- Right Column -->
            <div data-aos="fade-left" data-aos-delay="300">
                
                <!-- Quick Actions -->
                <div class="card mb-4" style="border: none; box-shadow: 0 10px 30px rgba(0,0,0,0.05);">
                    <h3 class="card-title mb-4">
                        <i class="fas fa-bolt text-warning mr-2"></i> Quick Actions
                    </h3>
                    <div class="d-flex flex-column gap-3">
                        <a href="{{ route('student.rooms') }}" class="quick-action-row">
                            <div class="icon-box bg-primary-light text-primary">
                                <i class="fas fa-search"></i>
                            </div>
                            <div class="flex-grow-1">
                                <div class="font-weight-bold">Find a Room</div>
                                <small class="text-muted">Browse and book accommodation</small>
                            </div>
                            <i class="fas fa-chevron-right text-muted"></i>
                        </a>
                        
                        <a href="{{ route('student.payments.index') }}" class="quick-action-row">
                            <div class="icon-box bg-success-light text-success">
                                <i class="fas fa-file-invoice-dollar"></i>
                            </div>
                            <div class="flex-grow-1">
                                <div class="font-weight-bold">Payment History</div>
                                <small class="text-muted">View past transactions</small>
                            </div>
                            <i class="fas fa-chevron-right text-muted"></i>
                        </a>

                        <button class="quick-action-row w-100 text-left" style="border: none; background: none;">
                            <div class="icon-box bg-warning-light text-warning">
                                <i class="fas fa-exclamation-triangle"></i>
                            </div>
                            <div class="flex-grow-1">
                                <div class="font-weight-bold">Report Issue</div>
                                <small class="text-muted">Maintenance or complaints</small>
                            </div>
                            <i class="fas fa-chevron-right text-muted"></i>
                        </button>
                        
                        <a href="{{ route('profile.edit') }}" class="quick-action-row">
                            <div class="icon-box bg-info-light text-info">
                                <i class="fas fa-user"></i>
                            </div>
                            <div class="flex-grow-1">
                                <div class="font-weight-bold">My Profile</div>
                                <small class="text-muted">Update your details</small>
                            </div>
                            <i class="fas fa-chevron-right text-muted"></i>
                        </a>
                    </div>
                </div>

                <!-- Notices Timeline -->
                <div class="card" style="border: none; box-shadow: 0 10px 30px rgba(0,0,0,0.05);">
                    <h3 class="card-title mb-4">
                        <i class="fas fa-bell text-danger mr-2"></i> Notices
                    </h3>
                    <div class="timeline">
                        <div class="timeline-item">
                            <div class="timeline-marker bg-primary"></div>
                            <div class="timeline-content">
                                <div class="timeline-date text-muted small">Today, 10:00 AM</div>
                                <p class="mb-0 font-weight-medium">Water maintenance in Block A.</p>
                            </div>
                        </div>
                        <div class="timeline-item">
                            <div class="timeline-marker bg-warning"></div>
                            <div class="timeline-content">
                                <div class="timeline-date text-muted small">Yesterday</div>
                                <p class="mb-0 font-weight-medium">Fee payment deadline extended.</p>
                            </div>
                        </div>
                        <div class="timeline-item">
                            <div class="timeline-marker bg-success"></div>
                            <div class="timeline-content">
                                <div class="timeline-date text-muted small">2 days ago</div>
                                <p class="mb-0 font-weight-medium">New cafeteria menu available.</p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <style>
        .text-white-50 { color: rgba(255, 255, 255, 0.8); }
        
        /* Quick Action Rows */
        .quick-action-row {
            display: flex;
            align-items: center;
            padding: 1rem;
            background: white;
            border: 1px solid #eee;
            border-radius: 12px;
            text-decoration: none;
            color: var(--color-text);
            transition: all 0.2s;
            gap: 1rem;
        }
        .quick-action-row:hover {
            background: #f8f9fa;
            transform: translateX(5px);
            border-color: var(--color-primary);
            text-decoration: none;
            color: var(--color-text);
        }
        
        .icon-box {
            width: 45px;
            height: 45px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            flex-shrink: 0;
        }
        .bg-primary-light { background: rgba(20, 110, 245, 0.1); }
        .bg-success-light { background: rgba(40, 167, 69, 0.1); }
        .bg-warning-light { background: rgba(255, 193, 7, 0.1); }
        .bg-info-light { background: rgba(23, 162, 184, 0.1); }

        /* Timeline */
        .timeline {
            position: relative;
            padding-left: 1rem;
            border-left: 2px solid #eee;
        }
        .timeline-item {
            position: relative;
            padding-left: 1.5rem;
            margin-bottom: 1.5rem;
        }
        .timeline-item:last-child { margin-bottom: 0; }
        .timeline-marker {
            position: absolute;
            left: -0.4rem;
            top: 0.2rem;
            width: 12px;
            height: 12px;
            border-radius: 50%;
            border: 2px solid white;
            box-shadow: 0 0 0 2px rgba(0,0,0,0.05);
        }
        
        @media (max-width: 768px) {
            .grid-2, .grid-3 { grid-template-columns: 1fr !important; }
            .container { margin-top: -2rem !important; }
        }
    </style>
@endsection
