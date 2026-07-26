<!DOCTYPE html>
<html>
<head>
    <title>Reservation Confirmed</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f8f9fa; padding: 20px;">
    <div style="max-width: 600px; margin: 0 auto; background: #ffffff; padding: 30px; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
        <h2 style="color: #4a3b32; text-align: center; border-bottom: 2px solid #eeeeee; padding-bottom: 10px;">Reservation Confirmation</h2>
        
        <p style="font-size: 16px; color: #555;">Dear <strong>{{ $reservation->full_name }}</strong>,</p>
        <p style="font-size: 16px; color: #555;">Thank you for choosing Sip & Snug. We are delighted to confirm your reservation.</p>
        
        <div style="background-color: #f4f4f4; padding: 20px; border-radius: 5px; margin: 20px 0;">
            <p style="margin: 5px 0;"><strong>📅 Date:</strong> {{ \Carbon\Carbon::parse($reservation->reservation_date)->format('F j, Y') }}</p>
            <p style="margin: 5px 0;"><strong>⏰ Time:</strong> {{ \Carbon\Carbon::parse($reservation->reservation_time)->format('g:i A') }}</p>
            <p style="margin: 5px 0;"><strong>👥 Guests:</strong> {{ $reservation->guests }} Person(s)</p>
            <p style="margin: 5px 0;"><strong>📞 Phone:</strong> {{ $reservation->phone_number }}</p>
            @if($reservation->special_requests)
            <p style="margin: 5px 0;"><strong>📝 Special Requests:</strong> {{ $reservation->special_requests }}</p>
            @endif
        </div>

        <p style="font-size: 16px; color: #555;">If you need to make any changes to your reservation, please contact us.</p>
        <p style="font-size: 16px; color: #555;">We look forward to hosting you!</p>
        
        <br>
        <p style="font-size: 14px; color: #777;">Warm regards,<br>The Sip & Snug Team</p>
    </div>
</body>
</html>
