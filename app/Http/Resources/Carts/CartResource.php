<?php

namespace App\Http\Resources\Carts;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Services\Carts\CartService;

class CartResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        $cartService = app(CartService::class);
        $subtotal = $cartService->calculateSubtotal($this->user_id);

        return [
            'id' => $this->id,
            'items' => CartItemResource::collection($this->whenLoaded('cartItems')),
            'subtotal' => number_format($subtotal, 2) . ' EGP',
        ];
    }
}
