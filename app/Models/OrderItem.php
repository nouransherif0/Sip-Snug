<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

// Defines the structure and properties of this class
class OrderItem extends Model
{
    use HasFactory;

    // Defines which columns can be safely mass-assigned in the database
    protected $fillable = [
        'order_id',
        'product_id',
        'quantity',
        'price',
    ];

    public function order(): BelongsTo
    {
        // Defines a relationship: this model belongs to a parent model
        return $this->belongsTo(Order::class);
    }

    public function product(): BelongsTo
    {
        // Defines a relationship: this model belongs to a parent model
        return $this->belongsTo(Product::class);
    }

    public function orderItemAddons(): HasMany
    {
        // Defines a relationship: this model has many child models
        return $this->hasMany(OrderItemAddon::class);
    }
}