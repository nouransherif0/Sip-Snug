<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['user_id', 'address_id', 'total_price', 'delivery_fee', 'status', 'payment_method'])]
// Defines the structure and properties of this class
class Order extends Model
{
    use HasFactory;

    use HasUlids;

    public function user(): BelongsTo
    {
        // Defines a relationship: this model belongs to a parent model
        return $this->belongsTo(User::class);
    }

    public function address(): BelongsTo
    {
        // Defines a relationship: this model belongs to a parent model
        return $this->belongsTo(Address::class);
    }

    public function orderItems(): HasMany
    {
        // Defines a relationship: this model has many child models
        return $this->hasMany(OrderItem::class);
    }

}
