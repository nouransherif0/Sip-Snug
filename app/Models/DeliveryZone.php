<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

// Defines the structure and properties of this class
class DeliveryZone extends Model
{
    use HasFactory;

    // Defines which columns can be safely mass-assigned in the database
    protected $fillable = [
        'name',
        'delivery_fee',
        'minimum_order_value',
        'estimated_time',
    ];

    //rs delivery to many saved addresses
    public function addresses(): HasMany
    {
        // Defines a relationship: this model has many child models
        return $this->hasMany(Address::class);
    }
}

