<?php

namespace App\Http\Resources\Carts;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CartItemResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        $productPrice = $this->product->effective_price ?? 0;
        
        // Format add_ons properly
        $formattedAddOns = [];
        $addonsTotal = 0;

        if (is_array($this->add_ons)) {
            foreach ($this->add_ons as $addon) {
                $priceAdjustment = $addon['price_adjustment'] ?? 0;
                $formattedAddOns[] = [
                    'id' => $addon['id'] ?? null,
                    'name' => $addon['name'] ?? 'Unknown Add-on',
                    'price' => number_format($priceAdjustment, 2) . ' EGP'
                ];
                $addonsTotal += $priceAdjustment;
            }
        }

        $itemPrice = $productPrice + $addonsTotal;
        $totalPrice = $itemPrice * $this->quantity;

        return [
            'id' => $this->id,
            'product' => [
                'id' => $this->product->id ?? null,
                'name' => $this->product->name ?? null,
                'image' => $this->product->image ? asset($this->product->image) : null,
                'base_price' => number_format($productPrice, 2) . ' EGP',
            ],
            'quantity' => $this->quantity,
            'add_ons' => $formattedAddOns,
            'item_price_with_addons' => number_format($itemPrice, 2) . ' EGP',
            'total_price' => number_format($totalPrice, 2) . ' EGP',
        ];
    }
}
