<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

// Defines the structure and properties of this class
class OrderItemAddon extends Model
{
    use HasFactory;

    // Defines which columns can be safely mass-assigned in the database
    protected $fillable = [
        'order_item_id',
        'addon_id',
        'price_adjustment',
    ];

    public function orderItem(): BelongsTo
    {
        // Defines a relationship: this model belongs to a parent model
        return $this->belongsTo(OrderItem::class);
    }

    public function addOn(): BelongsTo
    {
        // Defines a relationship: this model belongs to a parent model
        return $this->belongsTo(AddOn::class, 'addon_id');
    }
}