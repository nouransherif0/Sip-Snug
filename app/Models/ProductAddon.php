<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

// Defines the structure and properties of this class
class ProductAddon extends Model
{
    use HasFactory;

    // Explicitly links this model to a specific database table
    protected $table = 'product_addon';

    // Defines which columns can be safely mass-assigned in the database
    protected $fillable = [
        'product_id',
        'addon_id',
    ];

    public function product(): BelongsTo
    {
        // Defines a relationship: this model belongs to a parent model
        return $this->belongsTo(Product::class);
    }

    public function addOn(): BelongsTo
    {
        // Defines a relationship: this model belongs to a parent model
        return $this->belongsTo(AddOn::class, 'addon_id');
    }
}