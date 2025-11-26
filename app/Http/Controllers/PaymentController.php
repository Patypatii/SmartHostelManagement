<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PaymentController extends Controller
{
    public function index()
    {
        $payments = Auth::user()->payments()->with('booking.room')->latest()->paginate(10);
        return view('student.payments.index', compact('payments'));
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
        $request->validate([
            'payment_method' => 'required|in:mpesa,paypal',
            'phone_number' => 'required_if:payment_method,mpesa',
            'amount' => 'required|numeric|min:1',
        ]);

        // Simulate Payment Processing
        $transactionId = 'TXN-' . strtoupper(Str::random(12));
        $status = 'completed'; // Simulating success

        // Create Payment Record
        Payment::create([
            'booking_id' => $booking->id,
            'user_id' => Auth::id(),
            'transaction_reference' => $transactionId,
            'amount' => $request->amount,
            'payment_method' => $request->payment_method,
            'phone_number' => $request->phone_number,
            'status' => $status,
            'paid_at' => now(),
        ]);

        // Check if full payment is made (Mock logic: if payment >= total, mark booking as completed)
        // In a real app, we'd sum all payments.
        $totalPaid = $booking->payments()->where('status', 'completed')->sum('amount') + $request->amount;
        
        if ($totalPaid >= $booking->total_amount) {
            // Optional: Update booking status if needed, or just keep it as approved
            // $booking->update(['status' => 'paid']); 
        }

        return redirect()->route('student.payments.index')->with('status', 'Payment processed successfully! Ref: ' . $transactionId);
    }
}
