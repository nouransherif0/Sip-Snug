<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['category_id', 'name', 'image'])]
// Defines the structure and properties of this class
class Subcategory extends Model
{
    use HasFactory;

    public function category(): BelongsTo
    {
        // Defines a relationship: this model belongs to a parent model
        return $this->belongsTo(Category::class);
    }

    public function products(): HasMany
    {
        // Defines a relationship: this model has many child models
        return $this->hasMany(Product::class);
    }

}
