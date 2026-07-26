<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
<<<<<<< HEAD
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\hasmany;

=======
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
>>>>>>> 243a993cfb520c2a7a67eb35395e0e8a4216dc64

// Defines the structure and properties of this class
class AddOn extends Model
{
    use HasFactory;

    // Defines which columns can be safely mass-assigned in the database
    protected $fillable = [
        'name',
        'price_adjustment',
<<<<<<< HEAD
    ];

=======
        'scope',
        'category_id',
        'subcategory_id',
        'product_id',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function subcategory(): BelongsTo
    {
        return $this->belongsTo(Subcategory::class);
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'addon_category', 'addon_id', 'category_id');
    }

    public function subcategories(): BelongsToMany
    {
        return $this->belongsToMany(Subcategory::class, 'addon_subcategory', 'addon_id', 'subcategory_id');
    }

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'product_addon', 'addon_id', 'product_id');
    }

>>>>>>> 243a993cfb520c2a7a67eb35395e0e8a4216dc64
    //rs add-on to many products 
    public function products_item_addon(): BelongsToMany
    {
        // Defines a Many-to-Many relationship using a pivot table
<<<<<<< HEAD
        return $this->belongsToMany(Product::class, 'product_addon');
=======
        return $this->belongsToMany(Product::class, 'product_addon', 'addon_id', 'product_id');
>>>>>>> 243a993cfb520c2a7a67eb35395e0e8a4216dc64
    }

    public function orderItemAddons(): HasMany
    {
        // Defines a relationship: this model has many child models
        return $this->hasMany(OrderItemAddon::class);
    }
<<<<<<< HEAD
=======

    public static function forProduct($product)
    {
        if (!$product) {
            return collect();
        }

        $subcategoryId = $product->subcategory_id;
        $categoryId = $product->subcategory ? $product->subcategory->category_id : null;

        return static::where(function ($query) use ($product, $subcategoryId, $categoryId) {
            $query->where('scope', 'global')
                ->orWhereNull('scope');

            if ($categoryId) {
                $query->orWhere(function ($q) use ($categoryId) {
                    $q->where('scope', 'category')
                      ->where(function ($q2) use ($categoryId) {
                          $q2->where('category_id', $categoryId)
                             ->orWhereHas('categories', function ($q3) use ($categoryId) {
                                 $q3->where('categories.id', $categoryId);
                             });
                      });
                });
            }

            if ($subcategoryId) {
                $query->orWhere(function ($q) use ($subcategoryId) {
                    $q->where('scope', 'subcategory')
                      ->where(function ($q2) use ($subcategoryId) {
                          $q2->where('subcategory_id', $subcategoryId)
                             ->orWhereHas('subcategories', function ($q3) use ($subcategoryId) {
                                 $q3->where('subcategories.id', $subcategoryId);
                             });
                      });
                });
            }

            $query->orWhere(function ($q) use ($product) {
                $q->where('scope', 'product')
                  ->where(function ($q2) use ($product) {
                      $q2->where('product_id', $product->id)
                         ->orWhereHas('products', function ($q3) use ($product) {
                             $q3->where('products.id', $product->id);
                         });
                  });
            })
            ->orWhereHas('products_item_addon', function ($q) use ($product) {
                $q->where('products.id', $product->id);
            });
        })->get();
    }
>>>>>>> 243a993cfb520c2a7a67eb35395e0e8a4216dc64
}