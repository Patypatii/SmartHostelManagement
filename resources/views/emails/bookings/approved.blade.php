<!DOCTYPE html>
<html>
<head>
    <title>Booking Approved</title>
    <style>
        body { font-family: sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { background: #146EF5; color: white; padding: 20px; text-align: center; }
        .content { padding: 20px; border: 1px solid #ddd; }
        .footer { text-align: center; font-size: 0.8rem; color: #666; margin-top: 20px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Booking Approved!</h1>
        </div>
        <div class="content">
            <p>Hello {{ $booking->user->name }},</p>
            <p>Great news! Your booking for <strong>Room {{ $booking->room->room_number }}</strong> has been approved.</p>
            <p><strong>Booking Reference:</strong> {{ $booking->booking_reference }}</p>
            <p>You can now proceed to make your payment through the student dashboard to secure your room.</p>
            <p>
                <a href="{{ route('student.payments.index') }}" style="background: #146EF5; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px;">Make Payment</a>
            </p>
        </div>
        <div class="footer">
            &copy; {{ date('Y') }} Smart Hostel Management System
        </div>
    </div>
</body>
</html>
