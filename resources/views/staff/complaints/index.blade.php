@extends('layouts.webflow')

@section('title', 'Manage Complaints')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0">Complaints Management</h1>
    </div>

    <div class="card">
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Student</th>
                        <th>Room</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($complaints as $complaint)
                        <tr>
                            <td>{{ $complaint->complaint_number }}</td>
                            <td>{{ $complaint->user->name ?? 'Unknown' }}</td>
                            <td>{{ $complaint->room->room_number ?? 'N/A' }}</td>
                            <td>{{ $complaint->title }}</td>
                            <td>{{ Str::limit($complaint->description, 30) }}</td>
                            <td>
                                <span class="badge badge-{{ $complaint->status === 'resolved' ? 'success' : ($complaint->status === 'pending' ? 'warning' : 'info') }}">
                                    {{ ucfirst($complaint->status) }}
                                </span>
                            </td>
                            <td>
                                <button class="btn btn-sm btn-outline" onclick="openComplaintModal('{{ $complaint->id }}', '{{ $complaint->status }}', '{{ $complaint->admin_comment }}')">
                                    Update
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-4 text-muted">No complaints found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="p-3">
            {{ $complaints->links() }}
        </div>
    </div>

    <!-- Update Modal (Simple Implementation) -->
    <div id="updateModal" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,0.5); z-index:1000; align-items:center; justify-content:center;">
        <div class="card" style="width: 100%; max-width: 500px;">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h3 class="h5 mb-0">Update Complaint</h3>
                <button onclick="closeModal()" style="background:none; border:none; font-size:1.5rem;">&times;</button>
            </div>
            
            <form id="updateForm" method="POST">
                @csrf
                @method('PATCH')
                
                <div class="form-group">
                    <label class="form-label">Status</label>
                    <select name="status" id="modalStatus" class="form-control">
                        <option value="pending">Pending</option>
                        <option value="in_progress">In Progress</option>
                        <option value="resolved">Resolved</option>
                        <option value="rejected">Rejected</option>
                    </select>
                </div>

                <div class="form-group">
                    <label class="form-label">Staff Comment</label>
                    <textarea name="admin_comment" id="modalComment" class="form-control" rows="3"></textarea>
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
        }

        function closeModal() {
            document.getElementById('updateModal').style.display = 'none';
        }
    </script>
@endsection
