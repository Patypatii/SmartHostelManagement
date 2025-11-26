<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Complaint;
use App\Models\Visitor;
use App\Models\Room;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Log;

class StaffController extends Controller
{
    public function dashboard()
    {
        $pendingComplaints = Complaint::where('status', 'pending')->count();
        $activeVisitors = Visitor::where('status', 'checked_in')->count();
        $pendingVisitors = Visitor::where('status', 'pending')->count();
        
        // Recent activities
        $recentComplaints = Complaint::with(['user', 'room'])->latest()->take(5)->get();
        $recentVisitors = Visitor::with(['host', 'room'])->latest()->take(5)->get();

        return view('staff.dashboard', compact(
            'pendingComplaints', 
            'activeVisitors', 
            'pendingVisitors',
            'recentComplaints',
            'recentVisitors'
        ));
    }

    // Complaints Management
    public function complaints()
    {
        $complaints = Complaint::with(['user', 'room'])->latest()->paginate(10);
        return view('staff.complaints.index', compact('complaints'));
    }

    public function updateComplaint(Request $request, $id)
    {
        Log::info('Complaint update attempt', ['complaint_id' => $id, 'status' => $request->status]);

        try {
            $complaint = Complaint::findOrFail($id);
            
            $request->validate([
                'status' => 'required|in:pending,in_progress,resolved,rejected',
                'admin_comment' => 'nullable|string'
            ]);

            $complaint->update([
                'status' => $request->status,
                'admin_comment' => $request->admin_comment,
                'assigned_staff_id' => Auth::id()
            ]);

            // Send Email if status changed
            try {
                \Illuminate\Support\Facades\Mail::to($complaint->user->email)->send(new \App\Mail\ComplaintUpdated($complaint));
                Log::info('Complaint update email sent', ['email' => $complaint->user->email]);
            } catch (\Exception $e) {
                Log::error('Failed to send complaint update email', ['error' => $e->getMessage()]);
            }

            Log::info('Complaint updated successfully', ['complaint_id' => $id]);
            return back()->with('success', 'Complaint updated successfully.');

        } catch (\Exception $e) {
            Log::error('Complaint update failed', ['error' => $e->getMessage()]);
            return back()->with('error', 'Failed to update complaint.');
        }
    }

    // Visitor Management
    public function visitors()
    {
        $visitors = Visitor::with(['host', 'room'])->latest()->paginate(10);
        return view('staff.visitors.index', compact('visitors'));
    }

    public function updateVisitor(Request $request, $id)
    {
        Log::info('Visitor update attempt', ['visitor_id' => $id, 'action' => $request->input('action')]);

        try {
            $visitor = Visitor::findOrFail($id);
            
            $action = $request->input('action'); // approve, reject, check_in, check_out

            switch ($action) {
                case 'approve':
                    $visitor->update([
                        'status' => 'approved',
                        'approved_by' => Auth::id()
                    ]);
                    break;
                case 'reject':
                    $visitor->update([
                        'status' => 'rejected',
                        'approved_by' => Auth::id()
                    ]);
                    break;
                case 'check_in':
                    $visitor->update([
                        'status' => 'checked_in',
                        'entry_time' => now()
                    ]);
                    break;
                case 'check_out':
                    $visitor->update([
                        'status' => 'checked_out',
                        'actual_exit_time' => now()
                    ]);
                    break;
            }

            Log::info('Visitor status updated successfully', ['visitor_id' => $id, 'action' => $action]);
            return back()->with('success', 'Visitor status updated successfully.');

        } catch (\Exception $e) {
            Log::error('Visitor update failed', ['error' => $e->getMessage()]);
            return back()->with('error', 'Failed to update visitor status.');
        }
    }
}
