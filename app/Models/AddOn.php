<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\hasmany;


// Defines the structure and properties of this class
class AddOn extends Model
{
    use HasFactory;

    // Defines which columns can be safely mass-assigned in the database
    protected $fillable = [
        'name',
        'price_adjustment',
    ];

    //rs add-on to many products 
    public function products_item_addon(): BelongsToMany
    {
        // Defines a Many-to-Many relationship using a pivot table
        return $this->belongsToMany(Product::class, 'product_addon');
    }

    public function orderItemAddons(): HasMany
    {
        // Defines a relationship: this model has many child models
        return $this->hasMany(OrderItemAddon::class);
    }
}