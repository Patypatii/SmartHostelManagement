<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\HostelBlock;
use App\Models\Payment;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class ReportController extends Controller
{
    public function index()
    {
        return view('admin.reports.index');
    }

    public function occupancy()
    {
        $blocks = HostelBlock::withCount(['rooms as total_rooms', 'rooms as occupied_rooms' => function($query) {
            $query->where('occupied', '>', 0);
        }])->get();

        $totalCapacity = Room::sum('capacity');
        $totalOccupied = Room::sum('occupied');
        $occupancyRate = $totalCapacity > 0 ? round(($totalOccupied / $totalCapacity) * 100, 1) : 0;

        return view('admin.reports.occupancy', compact('blocks', 'totalCapacity', 'totalOccupied', 'occupancyRate'));
    }

    public function revenue()
    {
        // Monthly Revenue for the current year
        $monthlyRevenue = Payment::selectRaw('EXTRACT(MONTH FROM created_at) as month, SUM(amount) as total')
            ->whereYear('created_at', date('Y'))
            ->where('status', 'completed')
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        // Total Revenue
        $totalRevenue = Payment::where('status', 'completed')->sum('amount');

        return view('admin.reports.revenue', compact('monthlyRevenue', 'totalRevenue'));
    }

    public function exportOccupancy()
    {
        $rooms = Room::with('block')->get();
        $csvData = "Block,Room,Type,Capacity,Occupied,Status\n";

        foreach ($rooms as $room) {
            $csvData .= "{$room->block->name},{$room->room_number},{$room->room_type},{$room->capacity},{$room->occupied},{$room->status}\n";
        }

        return Response::make($csvData, 200, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="occupancy_report.csv"',
        ]);
    }
}
