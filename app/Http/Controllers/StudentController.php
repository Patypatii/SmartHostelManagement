<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class StudentController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Get Active Booking (if any)
        $activeBooking = Booking::where('user_id', $user->id)
            ->whereIn('status', ['approved', 'pending'])
            ->with(['room.block'])
            ->latest()
            ->first();

        // Calculate Pending Dues
        $pendingDues = 0;
        if ($activeBooking && $activeBooking->status === 'approved') {
            $paidAmount = $activeBooking->payments()->where('status', 'completed')->sum('amount');
            $pendingDues = $activeBooking->total_amount - $paidAmount;
        }

        return view('student.dashboard', compact('activeBooking', 'pendingDues'));
    }

    public function rooms()
    {
        // Fetch available rooms with their block details
        $rooms = Room::with('block')
            ->where('status', 'available')
            ->where('occupied', '<', \Illuminate\Support\Facades\DB::raw('capacity'))
            ->get();

        return view('student.rooms', compact('rooms'));
    }

    public function book(Request $request, Room $room)
    {
        $user = Auth::user();

        // Check if user already has an active booking
        $existingBooking = Booking::where('user_id', $user->id)
            ->whereIn('status', ['pending', 'approved'])
            ->exists();

        if ($existingBooking) {
            return back()->with('error', 'You already have an active booking request.');
        }

        // Check if room is actually available
        if ($room->occupied >= $room->capacity) {
            return back()->with('error', 'This room is fully occupied.');
        }

        // Create Booking
        Booking::create([
            'user_id' => $user->id,
            'room_id' => $room->id,
            'booking_reference' => 'BK-' . strtoupper(Str::random(10)),
            'start_date' => now(),
            'end_date' => now()->addMonths(4), // Semester duration
            'total_amount' => $room->price_per_semester,
            'status' => 'pending',
        ]);

        return redirect()->route('dashboard')->with('status', 'Booking request submitted successfully!');
    }
}
