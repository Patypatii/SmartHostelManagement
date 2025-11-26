<!DOCTYPE html>
<html>
<head>
    <title>Payment Received</title>
    <style>
        body { font-family: sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { background: #28a745; color: white; padding: 20px; text-align: center; }
        .content { padding: 20px; border: 1px solid #ddd; }
        .footer { text-align: center; font-size: 0.8rem; color: #666; margin-top: 20px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Payment Received</h1>
        </div>
        <div class="content">
            <p>Hello {{ $payment->user->name }},</p>
            <p>We have received your payment of <strong>KSh {{ number_format($payment->amount, 2) }}</strong>.</p>
            <p><strong>Transaction Ref:</strong> {{ $payment->transaction_reference }}</p>
            <p>Your room booking is now fully confirmed. Welcome to Smart Hostel!</p>
        </div>
        <div class="footer">
            &copy; {{ date('Y') }} Smart Hostel Management System
        </div>
    </div>
</body>
</html>
