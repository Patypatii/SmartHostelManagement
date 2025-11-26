@extends('layouts.webflow')

@section('title', 'Make Payment')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1>Make Payment</h1>
            <p class="text-muted">Booking Ref: {{ $booking->booking_reference }}</p>
        </div>
        <a href="{{ route('dashboard') }}" class="btn btn-outline">Back</a>
    </div>

    <div class="grid grid-2">
        <div class="card">
            <h3 class="card-title mb-4">Payment Details</h3>
            
            <div class="mb-3">
                <label class="text-muted d-block mb-1">Room</label>
                <strong>{{ $booking->room->room_number }} ({{ $booking->room->block->name }})</strong>
            </div>
            
            <div class="mb-3">
                <label class="text-muted d-block mb-1">Total Amount Due</label>
                <strong class="text-primary" style="font-size: 1.5rem;">KSh {{ number_format($booking->total_amount) }}</strong>
            </div>

            <div class="alert alert-info">
                <i class="fas fa-info-circle"></i> Secure payment processing via M-Pesa or PayPal.
            </div>
        </div>

        <div class="card">
            <form action="{{ route('student.payments.store', $booking) }}" method="POST">
                @csrf
                
                <div class="form-group">
                    <label class="form-label">Amount to Pay (KSh)</label>
                    <input type="number" name="amount" class="form-control" value="{{ $booking->total_amount }}" required>
                </div>

                <div class="form-group">
                    <label class="form-label">Payment Method</label>
                    <select name="payment_method" id="payment_method" class="form-control" onchange="togglePhoneField()">
                        <option value="mpesa">M-Pesa</option>
                        <option value="paypal">PayPal</option>
                    </select>
                </div>

                <div class="form-group" id="phone_field">
                    <label class="form-label">M-Pesa Phone Number</label>
                    <input type="text" name="phone_number" class="form-control" placeholder="07XX XXX XXX" value="{{ Auth::user()->phone }}">
                </div>

                <button type="submit" class="btn btn-primary w-100 mt-3">
                    <i class="fas fa-lock"></i> Pay Now
                </button>
            </form>
        </div>
    </div>

    <script>
        function togglePhoneField() {
            const method = document.getElementById('payment_method').value;
            const phoneField = document.getElementById('phone_field');
            if (method === 'mpesa') {
                phoneField.style.display = 'block';
            } else {
                phoneField.style.display = 'none';
            }
        }
    </script>
@endsection
