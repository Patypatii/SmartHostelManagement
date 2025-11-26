<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\HostelBlock;
use App\Models\Room;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index()
    {
        // Fetch Statistics
        $totalStudents = User::where('role', 'student')->count();
        $totalRooms = Room::count();
        
        // Calculate Occupancy Rate
        $totalCapacity = Room::sum('capacity');
        $totalOccupied = Room::sum('occupied');
        $occupancyRate = $totalCapacity > 0 ? round(($totalOccupied / $totalCapacity) * 100) : 0;

        // Calculate Monthly Revenue (Estimated from active bookings)
        $monthlyRevenue = Booking::where('status', 'approved')
            ->whereMonth('created_at', now()->month)
            ->sum('total_amount');

        // Recent Bookings
        $recentBookings = Booking::with(['user', 'room'])
            ->latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'totalStudents',
            'totalRooms',
            'occupancyRate',
            'monthlyRevenue',
            'recentBookings'
        ));
    }

    public function bookings()
    {
        $bookings = Booking::with(['user', 'room.block'])
            ->latest()
            ->paginate(10);

        return view('admin.bookings', compact('bookings'));
    }

    public function approveBooking(Booking $booking)
    {
        if ($booking->status !== 'pending') {
            return back()->with('error', 'Booking is not pending.');
        }

        // Update Booking Status
        $booking->update([
            'status' => 'approved',
            'approved_by' => Auth::id(),
            'approved_at' => now(),
        ]);

        // Update Room Occupancy
        $room = $booking->room;
        $room->increment('occupied');
        
        if ($room->occupied >= $room->capacity) {
            $room->update(['status' => 'full']);
        } else {
            $room->update(['status' => 'occupied']);
        }

        return back()->with('status', 'Booking approved successfully.');
    }

    public function rejectBooking(Booking $booking)
    {
        if ($booking->status !== 'pending') {
            return back()->with('error', 'Booking is not pending.');
        }

        $booking->update([
            'status' => 'rejected',
            'approved_by' => Auth::id(), // Track who rejected it
            'approved_at' => now(),
        ]);

        return back()->with('status', 'Booking rejected.');
    }
}
