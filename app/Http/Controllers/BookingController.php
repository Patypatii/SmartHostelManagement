<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\BookingApproved;

use Illuminate\Support\Facades\Log;

class BookingController extends Controller
{
    // Admin: View all bookings
    public function index()
    {
        return view('admin.bookings', [
            'bookings' => Booking::with(['user', 'room'])->latest()->paginate(10)
        ]);
    }

    // Student: Create a booking with payment
    public function store(Request $request)
    {
        Log::info('Booking attempt started', ['user_id' => Auth::id(), 'room_id' => $request->room_id]);

        try {
            $request->validate([
                'room_id' => 'required|exists:rooms,id',
                'payment_method' => 'required|in:mpesa,paypal',
                'phone_number' => 'required_if:payment_method,mpesa',
            ]);

            // Check if room is available
            $room = Room::findOrFail($request->room_id);
            if ($room->status !== 'available') {
                return back()->with('error', 'Room is not available.');
            }

            // Create booking
            $booking = Booking::create([
                'user_id' => Auth::id(),
                'room_id' => $request->room_id,
                'status' => 'pending',
                'booking_reference' => 'BK-' . strtoupper(uniqid()),
                'total_amount' => $room->price_per_semester,
            ]);

            // Process Payment (Simulated)
            $transactionId = 'TXN-' . strtoupper(\Illuminate\Support\Str::random(12));
            
            $payment = \App\Models\Payment::create([
                'booking_id' => $booking->id,
                'user_id' => Auth::id(),
                'transaction_reference' => $transactionId,
                'amount' => $room->price_per_semester,
                'payment_method' => $request->payment_method,
                'phone_number' => $request->phone_number,
                'status' => 'completed',
                'paid_at' => now(),
            ]);

            Log::info('Booking and Payment created successfully', ['booking_id' => $booking->id, 'payment_id' => $payment->id]);

            return redirect()->route('dashboard')->with('success', 'Booking and payment processed successfully! Ref: ' . $transactionId);

        } catch (\Exception $e) {
            Log::error('Booking creation failed', ['error' => $e->getMessage()]);
            return back()->with('error', 'An error occurred while processing your booking. Please try again.');
        }
    }

    // Admin: Update booking status
    public function updateStatus(Request $request, $id)
    {
        Log::info('Booking status update attempt', ['booking_id' => $id, 'status' => $request->status]);

        try {
            $booking = Booking::findOrFail($id);
            
            $request->validate([
                'status' => 'required|in:approved,rejected',
            ]);

            if ($request->status === 'approved') {
                $booking->update([
                    'status' => 'approved',
                    'approved_by' => Auth::id()
                ]);
                
                // Send Email
                try {
                    Mail::to($booking->user->email)->send(new BookingApproved($booking));
                    Log::info('Booking approval email sent', ['email' => $booking->user->email]);
                } catch (\Exception $e) {
                    Log::error('Failed to send booking approval email', ['error' => $e->getMessage()]);
                }
                
            } elseif ($request->status === 'rejected') {
                $booking->update([
                    'status' => 'rejected',
                    'approved_by' => Auth::id()
                ]);
            }

            Log::info('Booking status updated successfully', ['booking_id' => $id, 'new_status' => $request->status]);
            return back()->with('success', 'Booking status updated successfully.');

        } catch (\Exception $e) {
            Log::error('Booking status update failed', ['error' => $e->getMessage()]);
            return back()->with('error', 'Failed to update booking status.');
        }
    }
}
