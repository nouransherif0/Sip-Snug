<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function store(Request $request, Product $product)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
        ]);

        $user = $request->user();
        if (!$user) {
            return response()->json(['message' => 'Unauthenticated.'], 401);
        }

        // Check if user already reviewed this product
        if ($product->reviews()->where('user_id', $user->id)->exists()) {
            return response()->json(['message' => 'You have already reviewed this product.'], 400);
        }

        $product->reviews()->create([
            'user_id' => $user->id,
            'rating' => $request->rating,
        ]);

        return response()->json(['message' => 'Review submitted successfully.']);
    }
}
