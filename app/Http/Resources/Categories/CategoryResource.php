<?php

namespace App\Http\Resources\Categories;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Subcategories\SubcategoryResource;

class CategoryResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'image' => $this->image ? asset($this->image) : null,
            'subcategories' => SubcategoryResource::collection($this->whenLoaded('subcategories')),
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
        ];
    }
}
