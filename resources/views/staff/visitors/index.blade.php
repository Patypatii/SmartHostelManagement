@extends('layouts.webflow')

@section('title', 'Manage Visitors')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0">Visitor Management</h1>
    </div>

    <div class="card">
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>Visitor Name</th>
                        <th>Host Student</th>
                        <th>Phone</th>
                        <th>Purpose</th>
                        <th>Expected Time</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($visitors as $visitor)
                        <tr>
                            <td>{{ $visitor->visitor_name }}</td>
                            <td>{{ $visitor->host->name ?? 'Unknown' }}</td>
                            <td>{{ $visitor->visitor_phone }}</td>
                            <td>{{ $visitor->purpose_of_visit }}</td>
                            <td>{{ \Carbon\Carbon::parse($visitor->expected_exit_time)->format('M d, H:i') }}</td>
                            <td>
                                <span class="badge badge-{{ $visitor->status === 'checked_in' ? 'success' : ($visitor->status === 'pending' ? 'warning' : 'secondary') }}">
                                    {{ ucfirst(str_replace('_', ' ', $visitor->status)) }}
                                </span>
                            </td>
                            <td>
                                <div class="d-flex gap-2">
                                    @if($visitor->status === 'pending')
                                        <form method="POST" action="{{ route('staff.visitors.update', $visitor->id) }}">
                                            @csrf @method('PATCH')
                                            <input type="hidden" name="action" value="approve">
                                            <button type="submit" class="btn btn-sm btn-outline text-success border-success hover:bg-success hover:text-white">
                                                <i class="fas fa-check"></i> Approve
                                            </button>
                                        </form>
                                        <form method="POST" action="{{ route('staff.visitors.update', $visitor->id) }}">
                                            @csrf @method('PATCH')
                                            <input type="hidden" name="action" value="reject">
                                            <button type="submit" class="btn btn-sm btn-outline text-danger border-danger hover:bg-danger hover:text-white">
                                                <i class="fas fa-times"></i> Reject
                                            </button>
                                        </form>
                                    @elseif($visitor->status === 'approved')
                                        <form method="POST" action="{{ route('staff.visitors.update', $visitor->id) }}">
                                            @csrf @method('PATCH')
                                            <input type="hidden" name="action" value="check_in">
                                            <button type="submit" class="btn btn-sm btn-primary">
                                                <i class="fas fa-sign-in-alt"></i> Check In
                                            </button>
                                        </form>
                                    @elseif($visitor->status === 'checked_in')
                                        <form method="POST" action="{{ route('staff.visitors.update', $visitor->id) }}">
                                            @csrf @method('PATCH')
                                            <input type="hidden" name="action" value="check_out">
                                            <button type="submit" class="btn btn-sm btn-secondary">
                                                <i class="fas fa-sign-out-alt"></i> Check Out
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-4 text-muted">No visitors found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="p-3">
            {{ $visitors->links() }}
        </div>
    </div>
@endsection
