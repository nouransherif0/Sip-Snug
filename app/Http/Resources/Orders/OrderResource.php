<?php

namespace App\Http\Resources\Orders;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Addresses\AddressResource;

class OrderResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'status' => $this->status,
            'status_translated' => $this->translateStatus($this->status),
            'total_price' => number_format($this->total_price, 2) . ' EGP',
            'delivery_fee' => number_format($this->delivery_fee, 2) . ' EGP',
            'payment_method' => $this->payment_method,
            'address' => $this->relationLoaded('address') && $this->address ? new AddressResource($this->address) : null,
            'items' => OrderItemResource::collection($this->whenLoaded('orderItems')),
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
        ];
    }
    
    private function translateStatus(string $status): string
    {
        $statuses = [
            'pending' => 'قيد الانتظار',
            'confirmed' => 'مؤكد',
            'processing' => 'جاري التجهيز',
            'out_for_delivery' => 'في الطريق للتوصيل',
            'delivered' => 'تم التوصيل',
            'cancelled' => 'ملغي',
        ];
        
        return $statuses[$status] ?? $status;
    }
}
