<?php

namespace App\Http\Resources\DeliveryZones;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DeliveryZoneResource extends JsonResource
{
    public function toArray(Request $request): array
    {
    return [
   'id' => $this->id,
  'name' => $this->name,
  'delivery_fee' => number_format($this->delivery_fee, 2),
  'minimum_order_value' => number_format($this->minimum_order_value, 2),
 'estimated_time' => $this->estimated_time,
        ];
    }
}