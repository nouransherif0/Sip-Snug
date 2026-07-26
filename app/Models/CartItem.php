<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

// Defines the structure and properties of this class
class CartItem extends Model
{
    use HasFactory;

    // Defines which columns can be safely mass-assigned in the database
    protected $fillable = [
        'cart_id',
        'product_id',
        'quantity',
        'add_ons',
    ];

    // convert add_ons column to/from an array
    protected $casts = [
        'add_ons' => 'array',
    ];

    public function cart(): BelongsTo
    {
        // Defines a relationship: this model belongs to a parent model
        return $this->belongsTo(Cart::class);
    }

    public function product(): BelongsTo
    {
        // Defines a relationship: this model belongs to a parent model
        return $this->belongsTo(Product::class);
    }
}