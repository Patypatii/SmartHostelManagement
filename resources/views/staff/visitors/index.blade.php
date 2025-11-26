@extends('layouts.frontend')

@section('title', 'Manage Visitors')

@section('navbar-class', 'solid')

@section('content')
    <!-- Page Header -->
    <div class="page-header" style="padding-bottom: 6rem;">
        <div class="container" data-aos="fade-up">
            <h1 class="page-title mb-2">Visitor Management</h1>
            <p class="text-white-50 mb-0" style="font-size: 1.1rem;">
                Monitor and control visitor access
            </p>
        </div>
    </div>

    <div class="container" style="margin-top: -4rem;">
        <div class="card" style="border: none; box-shadow: 0 10px 30px rgba(0,0,0,0.05);" data-aos="fade-up">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead style="background: #f8f9fa;">
                        <tr>
                            <th style="border-top: none;">Visitor Name</th>
                            <th style="border-top: none;">Host Student</th>
                            <th style="border-top: none;">Purpose</th>
                            <th style="border-top: none;">Expected Time</th>
                            <th style="border-top: none;">Status</th>
                            <th style="border-top: none;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($visitors as $visitor)
                            <tr>
                                <td>
                                    <div class="font-weight-bold">{{ $visitor->visitor_name }}</div>
                                    <small class="text-muted">{{ $visitor->visitor_phone }}</small>
                                </td>
                                <td>{{ $visitor->host->name ?? 'Unknown' }}</td>
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
                                                <button type="submit" class="btn btn-sm btn-outline-success">
                                                    <i class="fas fa-check"></i> Approve
                                                </button>
                                            </form>
                                            <form method="POST" action="{{ route('staff.visitors.update', $visitor->id) }}">
                                                @csrf @method('PATCH')
                                                <input type="hidden" name="action" value="reject">
                                                <button type="submit" class="btn btn-sm btn-outline-danger">
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
                                <td colspan="6" class="text-center py-5">
                                    <i class="fas fa-user-friends fa-3x text-muted mb-3" style="opacity: 0.3;"></i>
                                    <p class="text-muted">No visitors found.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="p-4 border-top">
                {{ $visitors->links() }}
            </div>
        </div>
    </div>

    <style>
        .text-white-50 { color: rgba(255, 255, 255, 0.8); }
        .btn-outline-success {
            color: var(--color-success);
            border: 1px solid var(--color-success);
            background: transparent;
        }
        .btn-outline-success:hover {
            background: var(--color-success);
            color: white;
        }
        .btn-outline-danger {
            color: var(--color-danger);
            border: 1px solid var(--color-danger);
            background: transparent;
        }
        .btn-outline-danger:hover {
            background: var(--color-danger);
            color: white;
        }
    </style>
@endsection
