<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable(['user_id', 'delivery_zone_id', 'label', 'street', 'building_number', 'floor', 'apartment', 'landmark', 'phone_number', 'is_default'])]
// Defines the structure and properties of this class
class Address extends Model
{
    use HasFactory;

    use HasUlids;

    protected function casts(): array
    {
        return [
            'is_default' => 'boolean',
        ];
    }

    public function user(): BelongsTo
    {
        // Defines a relationship: this model belongs to a parent model
        return $this->belongsTo(User::class);
    }

    public function deliveryZone(): BelongsTo
    {
        // Defines a relationship: this model belongs to a parent model
        return $this->belongsTo(DeliveryZone::class);
    }


    public function orders(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        // Defines a relationship: this model has many child models
        return $this->hasMany(Order::class);
    }
}
