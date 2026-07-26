<?php

namespace App\Http\Controllers\Api\V1\SavedCards;

use App\Http\Controllers\Controller;
use App\Models\SavedCard;
use Illuminate\Http\Request;
use App\Http\Requests\Customer\StoreSavedCardRequest;

class SavedCardController extends Controller
{
    public function index(Request $request)
    {
        $cards = SavedCard::where('user_id', $request->user()->id)->get();
        return response()->json([
            'status' => 'success',
            'data' => $cards
        ]);
    }

    public function store(StoreSavedCardRequest $request)
    {
        $validated = $request->validated();

        $card = SavedCard::create([
            'user_id' => $request->user()->id,
            'card_type' => $validated['card_type'],
            'card_name' => $validated['card_name'],
            'card_number' => $validated['card_number'],
            'expiry_date' => $validated['expiry_date'],
            'cvv' => $validated['cvv'],
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Card saved successfully',
            'data' => $card
        ], 201);
    }
}
