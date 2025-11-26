@extends('layouts.webflow')

@section('title', 'Payment History')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1>Payment History</h1>
            <p class="text-muted">Track your transactions</p>
        </div>
        <a href="{{ route('dashboard') }}" class="btn btn-outline">Back to Dashboard</a>
    </div>

    @if(session('status'))
        <div class="alert alert-success mb-4">
            {{ session('status') }}
        </div>
    @endif

    <div class="card">
        <table class="table">
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
                        <td>{{ $payment->transaction_reference }}</td>
                        <td>{{ $payment->created_at->format('M d, Y H:i') }}</td>
                        <td>{{ $payment->booking->room->room_number ?? 'N/A' }}</td>
                        <td>
                            @if($payment->payment_method === 'mpesa')
                                <span class="badge badge-success" style="background-color: #4CAF50;">M-Pesa</span>
                            @else
                                <span class="badge badge-primary" style="background-color: #003087;">PayPal</span>
                            @endif
                        </td>
                        <td>KSh {{ number_format($payment->amount) }}</td>
                        <td>
                            <span class="badge badge-success">Completed</span>
                        </td>
                        <td>
                            <button class="btn btn-sm btn-outline">
                                <i class="fas fa-download"></i>
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center py-4 text-muted">No payments found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        
        <div class="mt-4">
            {{ $payments->links() }}
        </div>
    </div>
@endsection
