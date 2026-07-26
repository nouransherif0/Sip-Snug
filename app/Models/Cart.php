<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['user_id'])]
// Defines the structure and properties of this class
class Cart extends Model
{
    use HasFactory;

    use HasUlids;

    public function user(): BelongsTo
    {
        // Defines a relationship: this model belongs to a parent model
        return $this->belongsTo(User::class);
    }

    public function cartItems(): HasMany
    {
        // Defines a relationship: this model has many child models
        return $this->hasMany(CartItem::class);
    }

}
