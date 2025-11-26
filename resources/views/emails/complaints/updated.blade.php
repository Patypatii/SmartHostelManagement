<!DOCTYPE html>
<html>
<head>
    <title>Complaint Update</title>
    <style>
        body { font-family: sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { background: #ffc107; color: #333; padding: 20px; text-align: center; }
        .content { padding: 20px; border: 1px solid #ddd; }
        .footer { text-align: center; font-size: 0.8rem; color: #666; margin-top: 20px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Complaint Status Update</h1>
        </div>
        <div class="content">
            <p>Hello {{ $complaint->user->name }},</p>
            <p>The status of your complaint <strong>#{{ $complaint->complaint_number }}</strong> has been updated.</p>
            <p><strong>New Status:</strong> {{ ucfirst($complaint->status) }}</p>
            @if($complaint->admin_comment)
                <p><strong>Staff Comment:</strong><br>
                <em>"{{ $complaint->admin_comment }}"</em></p>
            @endif
            <p>We are committed to resolving your issues as quickly as possible.</p>
        </div>
        <div class="footer">
            &copy; {{ date('Y') }} Smart Hostel Management System
        </div>
    </div>
</body>
</html>
