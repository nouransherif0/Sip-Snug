<?php

namespace App\Http\Controllers\Api\V1\Chats;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function respond(Request $request)
    {
        $message = strtolower(trim($request->input('message', '')));

        $response = $this->generateResponse($message);

        return response()->json([
            'status' => 'success',
            'response' => $response
        ]);
    }

    private function generateResponse($msg)
    {
        if (str_contains($msg, 'order') && (str_contains($msg, 'track') || str_contains($msg, 'where'))) {
            return "To track your current order, please go to your profile by clicking your name in the top right, then navigate to 'Orders'. There you can see the real-time status of your delivery!";
        }
        
        if (str_contains($msg, 'recommend') || str_contains($msg, 'drink')) {
            return "I highly recommend our signature 'Caramel Macchiato' if you like something sweet, or the 'Iced Matcha Latte' for a refreshing boost! You can find them on our homepage.";
        }
        
        if (str_contains($msg, 'rewards') || str_contains($msg, 'points')) {
            return "You earn 10 points for every 100 EGP spent! Once you reach 500 points, you can redeem a free coffee on the checkout page.";
        }
        
        if (str_contains($msg, 'hour') || str_contains($msg, 'open') || str_contains($msg, 'time')) {
            return "We are open every day from 7:00 AM to 11:00 PM. We can't wait to serve you!";
        }
        
        if (str_contains($msg, 'menu') || str_contains($msg, 'coffee')) {
            return "Our full menu is available on the homepage. We serve espresso, lattes, cold brews, and fresh pastries daily!";
        }

        if (str_contains($msg, 'hello') || str_contains($msg, 'hi') || str_contains($msg, 'hey')) {
            return "Hello there! How can I help make your day a little sweeter?";
        }

        return "I'm still learning, so I didn't quite catch that. Try asking me about our menu, hours, rewards points, or how to track your order!";
    }
}
