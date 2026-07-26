<?php

namespace App\Http\Controllers\Web\Favorites;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    public function toggle(Product $product)
    {
        $user = Auth::user();
        
        $user->favorites()->toggle($product->id);

        $isFavorited = $user->favorites()->where('product_id', $product->id)->exists();

        return response()->json([
            'success' => true,
            'is_favorited' => $isFavorited,
            'message' => $isFavorited ? 'Added to favorites.' : 'Removed from favorites.',
            'product' => $isFavorited ? [
                'id' => $product->id,
                'name' => $product->name,
                'price' => number_format($product->price, 2),
                'category' => $product->subcategory->name ?? 'Drink',
                'image' => $product->image ? asset($product->image) : asset('front/photos/coffee/esspresso.jpg')
            ] : null
        ]);
    }
}
