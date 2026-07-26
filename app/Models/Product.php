<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

// Defines the structure and properties of this class
class Product extends Model
{
    use HasFactory;

    // Defines which columns can be safely mass-assigned in the database
    protected $fillable = [
        'subcategory_id',
        'name',
        'description',
        'price',
        'image',
        'stock',
        'is_featured',
        'calories',
        'prep_time',
        'discount_price',
        'is_bestseller',
    ];

    // rs one product to one subcategory 
    public function subcategory(): BelongsTo
    {
        // Defines a relationship: this model belongs to a parent model
        return $this->belongsTo(Subcategory::class);
    }

    // rs product to many add-ons 
    public function addOns(): BelongsToMany
    {
        // Defines a Many-to-Many relationship using a pivot table
        return $this->belongsToMany(AddOn::class, 'product_addon', 'product_id', 'addon_id');
    }

    public function applicableAddOns()
    {
        return AddOn::forProduct($this);
    }

    public function getApplicableAddOnsAttribute()
    {
        return $this->applicableAddOns();
    }

    // rs product to many cart items
    public function cartItems(): HasMany
    {
        // Defines a relationship: this model has many child models
        return $this->hasMany(CartItem::class);
    }

    //rs product to many order items
    public function orderItems(): HasMany
    {
        // Defines a relationship: this model has many child models
        return $this->hasMany(OrderItem::class);
    }

    public function casts(): array{
        return[
            'is_featured' => 'boolean',
            'is_bestseller' => 'boolean',
            'discount_price' => 'decimal:2',
            'ingredients' => 'array',
        ];
    }

    public function favoritedBy(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'favorites', 'product_id', 'user_id')->withTimestamps();
    }

    public function getEffectivePriceAttribute()
    {
        $discount = $this->discount_price ?? 0;
        return max(0, $this->price - $discount);
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }

    public function getAverageRatingAttribute()
    {
        return $this->reviews()->avg('rating') ?: 0;
    }

    public function getReviewsCountAttribute()
    {
        return $this->reviews()->count();
    }
}