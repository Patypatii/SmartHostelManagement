@extends('layouts.frontend')

@section('title', 'Payment History')

@section('navbar-class', 'solid')

@section('content')
    <!-- Page Header -->
    <div class="page-header">
        <div class="container" data-aos="fade-up">
            <h1 class="page-title">Payment History</h1>
            <p class="text-white-50" style="font-size: 1.2rem; max-width: 600px; margin: 0 auto;">
                Track your transactions and download receipts.
            </p>
        </div>
    </div>

    <div class="container section-padding">
        @if(session('status'))
            <div class="alert alert-success mb-4" data-aos="fade-in">
                {{ session('status') }}
            </div>
        @endif

        <div class="card" data-aos="fade-up" data-aos-delay="100">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h3 class="card-title mb-0">Transactions</h3>
                <div class="d-flex gap-2">
                    <button class="btn btn-outline btn-sm"><i class="fas fa-filter mr-2"></i> Filter</button>
                    <button class="btn btn-outline btn-sm"><i class="fas fa-download mr-2"></i> Export</button>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead>
                        <tr>
                            <th>Reference</th>
                            <th>Date</th>
                            <th>Room</th>
                            <th>Method</th>
                            <th>Amount</th>
                            <th>Status</th>
                            <th>Receipt</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($payments as $payment)
                            <tr>
                                <td class="font-weight-bold text-primary">{{ $payment->transaction_reference }}</td>
                                <td>{{ $payment->created_at->format('M d, Y') }} <small class="text-muted d-block">{{ $payment->created_at->format('H:i A') }}</small></td>
                                <td>
                                    @if($payment->booking && $payment->booking->room)
                                        <span class="badge badge-light">{{ $payment->booking->room->block->name }} - {{ $payment->booking->room->room_number }}</span>
                                    @else
                                        <span class="text-muted">N/A</span>
                                    @endif
                                </td>
                                <td>
                                    @if($payment->payment_method === 'mpesa')
                                        <span class="d-flex align-items-center gap-2">
                                            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/1/15/M-PESA_LOGO-01.svg/1200px-M-PESA_LOGO-01.svg.png" alt="M-Pesa" style="height: 16px;">
                                            M-Pesa
                                        </span>
                                    @else
                                        <span class="d-flex align-items-center gap-2">
                                            <i class="fab fa-paypal text-primary"></i>
                                            PayPal
                                        </span>
                                    @endif
                                </td>
                                <td class="font-weight-bold">KSh {{ number_format($payment->amount) }}</td>
                                <td>
                                    <span class="badge badge-success">Completed</span>
                                </td>
                                <td>
                                    <button class="btn btn-sm btn-light text-primary" title="Download Receipt">
                                        <i class="fas fa-file-download"></i>
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-5">
                                    <div class="mb-3">
                                        <i class="fas fa-receipt fa-3x text-muted" style="opacity: 0.3;"></i>
                                    </div>
                                    <p class="text-muted mb-3">No payments found.</p>
                                    <a href="{{ route('student.rooms') }}" class="btn btn-primary btn-sm">Book a Room</a>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            @if($payments->hasPages())
                <div class="mt-4 border-top pt-3">
                    {{ $payments->links() }}
                </div>
            @endif
        </div>
    </div>

    <style>
        .text-white-50 { color: rgba(255, 255, 255, 0.8); }
        .table th { border-top: none; background: #f8f9fa; color: #666; font-weight: 600; }
        .table td { vertical-align: middle; }
        .badge-light { background: #f8f9fa; color: #666; border: 1px solid #eee; }
    </style>
@endsection
