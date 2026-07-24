<?php

namespace App\Services\Carts;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;

// Defines the structure and properties of this class
class CartService
{
    public function getOrCreateCart(string $userId): Cart
    {
        return Cart::firstOrCreate(['user_id' => $userId]);
    }

    public function addItem(string $userId, array $itemData)
    {
        $cart = $this->getOrCreateCart($userId);

        // Check if item with exact same product_id and add_ons already exists
        $existingItem = CartItem::where('cart_id', $cart->id)
            ->where('product_id', $itemData['product_id'])
            ->whereJsonContains('add_ons', $itemData['add_ons'] ?? [])
            ->first();

        if ($existingItem) {
            $existingItem->quantity += $itemData['quantity'];
            $existingItem->save();
            return $existingItem;
        }

        return CartItem::create([
            'cart_id' => $cart->id,
            'product_id' => $itemData['product_id'],
            'quantity' => $itemData['quantity'],
            'add_ons' => $itemData['add_ons'] ?? [],
        ]);
    }

    public function updateItemQuantity(string $itemId, int $quantity, string $userId)
    {
        $item = CartItem::whereHas('cart', function ($query) use ($userId) {
            $query->where('user_id', $userId);
        })->findOrFail($itemId);
        
        $item->update(['quantity' => $quantity]);
        return $item;
    }

    public function removeItem(string $itemId, string $userId)
    {
        $item = CartItem::whereHas('cart', function ($query) use ($userId) {
            $query->where('user_id', $userId);
        })->findOrFail($itemId);
        
        $item->delete();
    }

    public function calculateSubtotal(string $userId): float
    {
        $cart = Cart::where('user_id', $userId)->with('cartItems.product')->first();
        if (!$cart) return 0.0;

        $subtotal = 0;
        foreach ($cart->cartItems as $item) {
            $productPrice = $item->product->price ?? 0;
            $addonsTotal = 0;
            
            if (is_array($item->add_ons)) {
                foreach ($item->add_ons as $addon) {
                    $addonsTotal += $addon['price_adjustment'] ?? 0;
                }
            }
            
            $subtotal += ($productPrice + $addonsTotal) * $item->quantity;
        }

        return $subtotal;
    }
}
