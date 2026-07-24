<?php

namespace App\Http\Resources\Products;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductsResources extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'price' => $this->price,
            'effective_price' => $this->effective_price,
            'discount_price' => $this->discount_price,
            'image' => $this->image ? asset($this->image) : null,
            'category' => $this->subcategory ? $this->subcategory->category->name ?? null : null,
            'subcategory' => $this->subcategory ? $this->subcategory->name : null,
            'is_featured' => $this->is_featured,
            'is_bestseller' => $this->is_bestseller,
            'stock' => $this->stock,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
