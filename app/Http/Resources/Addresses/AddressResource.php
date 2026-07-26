<?php

namespace App\Http\Resources\Addresses;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AddressResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        $fullAddressParts = array_filter([
            $this->street,
            $this->building_number ? "Building " . $this->building_number : null,
            $this->floor ? "Floor " . $this->floor : null,
            $this->apartment ? "Apt " . $this->apartment : null,
        ]);
        
        $fullAddress = implode(', ', $fullAddressParts);

        return [
            'id' => $this->id,
            'label' => $this->label,
            'full_address' => $fullAddress,
            'street' => $this->street,
            'building_number' => $this->building_number,
            'floor' => $this->floor,
            'apartment' => $this->apartment,
            'landmark' => $this->landmark,
            'phone_number' => $this->phone_number,
            'is_default' => $this->is_default,
            'delivery_zone' => [
                'id' => $this->deliveryZone->id ?? null,
                'name' => $this->deliveryZone->name ?? null,
                'delivery_fee' => isset($this->deliveryZone->delivery_fee) ? number_format($this->deliveryZone->delivery_fee, 2) . ' EGP' : '0.00 EGP',
            ],
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
        ];
    }
}
