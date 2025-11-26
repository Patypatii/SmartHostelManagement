<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use App\Mail\PaymentReceived;

class PaymentController extends Controller
{
    public function index()
    {
        return view('student.payments.index', [
            'payments' => Auth::user()->payments()->with('booking.room')->latest()->paginate(10)
        ]);
    }

    public function create(Booking $booking)
    {
        // Ensure user owns the booking
        if ($booking->user_id !== Auth::id()) {
            abort(403);
        }

        return view('student.payments.create', compact('booking'));
    }

    public function store(Request $request, Booking $booking)
    {
        Log::info('Payment processing started', ['user_id' => Auth::id(), 'booking_id' => $booking->id]);

        try {
            $request->validate([
                'payment_method' => 'required|in:mpesa,paypal',
                'phone_number' => 'required_if:payment_method,mpesa',
                'amount' => 'required|numeric|min:1',
            ]);

            // Simulate Payment Processing
            $transactionId = 'TXN-' . strtoupper(Str::random(12));
            $status = 'completed'; // Simulating success

            // Create Payment Record
            $payment = Payment::create([
                'booking_id' => $booking->id,
                'user_id' => Auth::id(),
                'transaction_reference' => $transactionId,
                'amount' => $request->amount,
                'payment_method' => $request->payment_method,
                'phone_number' => $request->phone_number,
                'status' => $status,
                'paid_at' => now(),
            ]);

            Log::info('Payment record created', ['payment_id' => $payment->id, 'transaction_ref' => $transactionId]);

            // Check if full payment is made
            $totalPaid = $booking->payments()->where('status', 'completed')->sum('amount');
            
            if ($totalPaid >= $booking->total_amount) {
                // Update booking status
                $booking->update(['is_paid' => true]); 
                Log::info('Booking marked as fully paid', ['booking_id' => $booking->id]);
            }

            // Send Email
            try {
                Mail::to(Auth::user()->email)->send(new PaymentReceived($payment));
                Log::info('Payment receipt email sent', ['email' => Auth::user()->email]);
            } catch (\Exception $e) {
                Log::error('Failed to send payment receipt email', ['error' => $e->getMessage()]);
            }

            return redirect()->route('student.payments.index')->with('success', 'Payment processed successfully! Ref: ' . $transactionId);

        } catch (\Exception $e) {
            Log::error('Payment processing failed', ['error' => $e->getMessage()]);
            return back()->with('error', 'An error occurred while processing your payment. Please try again.');
        }
    }
}
