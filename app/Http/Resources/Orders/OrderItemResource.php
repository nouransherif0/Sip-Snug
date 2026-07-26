<?php

namespace App\Http\Resources\Orders;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderItemResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'product' => [
                'id' => $this->product->id ?? null,
                'name' => $this->product->name ?? null,
            ],
            'quantity' => $this->quantity,
            'price_per_item' => number_format($this->price, 2) . ' EGP',
            'total_price' => number_format($this->price * $this->quantity, 2) . ' EGP',
        ];
    }
}
