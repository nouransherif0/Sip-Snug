<?php

namespace App\Http\Resources\AddOns;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AddOnResource extends JsonResource
{
    public function toArray(Request $request): array
    {
<<<<<<< HEAD
   return [
  'id' => $this->id,
  'name' => $this->name,
 'price_adjustment' => number_format($this->price_adjustment, 2),
   ];
=======
        return [
            'id' => $this->id,
            'name' => $this->name,
            'price_adjustment' => number_format($this->price_adjustment, 2),
            'scope' => $this->scope ?? 'global',
            'category_id' => $this->category_id,
            'subcategory_id' => $this->subcategory_id,
            'product_id' => $this->product_id,
            'category_name' => $this->category->name ?? null,
            'subcategory_name' => $this->subcategory->name ?? null,
            'product_name' => $this->product->name ?? null,
        ];
>>>>>>> 243a993cfb520c2a7a67eb35395e0e8a4216dc64
    }
}