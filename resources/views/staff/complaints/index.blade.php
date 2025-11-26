@extends('layouts.frontend')

@section('title', 'Manage Complaints')

@section('navbar-class', 'solid')

@section('content')
    <!-- Page Header -->
    <div class="page-header" style="padding-bottom: 6rem;">
        <div class="container" data-aos="fade-up">
            <h1 class="page-title mb-2">Complaints Management</h1>
            <p class="text-white-50 mb-0" style="font-size: 1.1rem;">
                Track and resolve student issues
            </p>
        </div>
    </div>

    <div class="container" style="margin-top: -4rem;">
        <div class="card" style="border: none; box-shadow: 0 10px 30px rgba(0,0,0,0.05);" data-aos="fade-up">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead style="background: #f8f9fa;">
                        <tr>
                            <th style="border-top: none;">ID</th>
                            <th style="border-top: none;">Student</th>
                            <th style="border-top: none;">Room</th>
                            <th style="border-top: none;">Issue</th>
                            <th style="border-top: none;">Status</th>
                            <th style="border-top: none;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($complaints as $complaint)
                            <tr>
                                <td><span class="text-muted">#{{ $complaint->complaint_number }}</span></td>
                                <td>
                                    <div class="font-weight-bold">{{ $complaint->user->name ?? 'Unknown' }}</div>
                                </td>
                                <td>{{ $complaint->room->room_number ?? 'N/A' }}</td>
                                <td>
                                    <div class="font-weight-bold">{{ $complaint->title }}</div>
                                    <small class="text-muted">{{ Str::limit($complaint->description, 40) }}</small>
                                </td>
                                <td>
                                    <span class="badge badge-{{ $complaint->status === 'resolved' ? 'success' : ($complaint->status === 'pending' ? 'warning' : 'info') }}">
                                        {{ ucfirst($complaint->status) }}
                                    </span>
                                </td>
                                <td>
                                    <button class="btn btn-sm btn-outline-primary" onclick="openComplaintModal('{{ $complaint->id }}', '{{ $complaint->status }}', '{{ $complaint->admin_comment }}')">
                                        <i class="fas fa-edit"></i> Update
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-5">
                                    <i class="fas fa-clipboard-check fa-3x text-muted mb-3" style="opacity: 0.3;"></i>
                                    <p class="text-muted">No complaints found.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="p-4 border-top">
                {{ $complaints->links() }}
            </div>
        </div>
    </div>

    <!-- Update Modal -->
    <div id="updateModal" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,0.5); z-index:1000; align-items:center; justify-content:center;">
        <div class="card" style="width: 100%; max-width: 500px; border: none; box-shadow: 0 20px 50px rgba(0,0,0,0.2);">
            <div class="d-flex justify-content-between align-items-center mb-4 pb-3 border-bottom">
                <h3 class="h5 mb-0">Update Complaint</h3>
                <button onclick="closeModal()" style="background:none; border:none; font-size:1.5rem; cursor: pointer;">&times;</button>
            </div>
            
            <form id="updateForm" method="POST">
                @csrf
                @method('PATCH')
                
                <div class="form-group mb-3">
                    <label class="form-label font-weight-bold">Status</label>
                    <select name="status" id="modalStatus" class="form-control" style="height: 45px;">
                        <option value="pending">Pending</option>
                        <option value="in_progress">In Progress</option>
                        <option value="resolved">Resolved</option>
                        <option value="rejected">Rejected</option>
                    </select>
                </div>

                <div class="form-group mb-4">
                    <label class="form-label font-weight-bold">Staff Comment</label>
                    <textarea name="admin_comment" id="modalComment" class="form-control" rows="4" placeholder="Add a note about the resolution..."></textarea>
                </div>

                <div class="d-flex justify-content-end gap-2">
                    <button type="button" class="btn btn-secondary" onclick="closeModal()">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openComplaintModal(id, status, comment) {
            const modal = document.getElementById('updateModal');
            const form = document.getElementById('updateForm');
            const statusSelect = document.getElementById('modalStatus');
            const commentText = document.getElementById('modalComment');

            form.action = `/staff/complaints/${id}`;
            statusSelect.value = status;
            commentText.value = comment || '';
            
            modal.style.display = 'flex';
            document.body.style.overflow = 'hidden'; // Prevent scrolling
        }

        function closeModal() {
            document.getElementById('updateModal').style.display = 'none';
            document.body.style.overflow = 'auto'; // Restore scrolling
        }

        // Close modal when clicking outside
        document.getElementById('updateModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeModal();
            }
        });
    </script>

    <style>
        .text-white-50 { color: rgba(255, 255, 255, 0.8); }
        .btn-outline-primary {
            color: var(--color-primary);
            border-color: var(--color-primary);
        }
        .btn-outline-primary:hover {
            background: var(--color-primary);
            color: white;
        }
    </style>
@endsection
