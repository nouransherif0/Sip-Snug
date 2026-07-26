<?php

namespace App\Http\Controllers\Web\Forms;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Forms\SubmitContactRequest;
use App\Http\Requests\Forms\SubscribeRequest;
use App\Http\Requests\Forms\MakeReservationRequest;
use App\Models\ContactMessage;
use App\Models\Subscriber;
use App\Models\Reservation;
use App\Mail\ContactMessageMail;
use App\Mail\WelcomeSubscriberMail;
use App\Mail\ReservationConfirmationMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class FormController extends Controller
{
    public function submitContact(SubmitContactRequest $request)
    {

        $contact = ContactMessage::create($request->all());

        // Queue Email to Admin
        Mail::to('sipnsnug@gmail.com')->queue(new ContactMessageMail($contact));

        return response()->json(['success' => true, 'message' => 'Message sent successfully!']);
    }

    public function subscribe(SubscribeRequest $request)
    {

        // Check if subscriber already exists
        $subscriber = Subscriber::where('email', $request->email)->first();

        if ($subscriber) {
            return response()->json(['success' => false, 'message' => 'You are already subscribed!'], 409);
        }

        $subscriber = Subscriber::create(['email' => $request->email]);

        // Queue Welcome Email
        Mail::to($subscriber->email)->queue(new WelcomeSubscriberMail($subscriber));

        return response()->json(['success' => true, 'message' => 'Subscribed successfully! Check your email.']);
    }

    public function makeReservation(MakeReservationRequest $request)
    {

        $data = $request->all();
        // Convert time like "09:00 PM" to "21:00:00"
        $data['reservation_time'] = \Carbon\Carbon::parse($data['reservation_time'])->format('H:i:s');

        $reservation = Reservation::create($data);

        // Queue Confirmation to Customer
        Mail::to($reservation->email_address)->queue(new ReservationConfirmationMail($reservation));

        // Queue Alert to Admin (Optional, could just re-use the same mailable)
        Mail::to('sipnsnug@gmail.com')->queue(new ReservationConfirmationMail($reservation));

        return response()->json(['success' => true, 'message' => 'Reservation confirmed!']);
    }
}
