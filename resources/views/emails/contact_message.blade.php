<!DOCTYPE html>
<html>
<head>
    <title>New Contact Message</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f8f9fa; padding: 20px;">
    <div style="max-width: 600px; margin: 0 auto; background: #ffffff; padding: 20px; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
        <h2 style="color: #4a3b32; text-align: center;">New Message Received</h2>
        <p><strong>From:</strong> {{ $contactMessage->name }}</p>
        <p><strong>Email:</strong> {{ $contactMessage->email }}</p>
        <p><strong>Phone:</strong> {{ $contactMessage->phone ?? 'N/A' }}</p>
        <p><strong>Subject:</strong> {{ $contactMessage->subject }}</p>
        <hr style="border: 0; border-top: 1px solid #eeeeee;">
        <p><strong>Message:</strong></p>
        <p style="background-color: #f4f4f4; padding: 15px; border-radius: 5px;">{{ $contactMessage->message }}</p>
    </div>
</body>
</html>
