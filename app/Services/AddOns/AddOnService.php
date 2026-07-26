<?php

namespace App\Services\AddOns;

use App\Models\AddOn;
use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;

class AddOnService
{
    /**
     * Get all add-ons with their relationships.
     */
    public function getAllAddOns()
    {
        return AddOn::with(['category', 'subcategory', 'product', 'categories', 'subcategories', 'products'])
            ->orderBy('id', 'asc')
            ->get();
    }

    /**
     * Get a single add-on by ID with relationships.
     */
    public function getAddOnById(int $id)
    {
        return AddOn::with(['category', 'subcategory', 'product', 'categories', 'subcategories', 'products'])
            ->findOrFail($id);
    }

    /**
     * Get all applicable add-ons for a given product based on scope rules (Global, Category, Subcategory, Product).
     */
    public function getAddOnsForProduct(?Product $product): Collection
    {
        if (!$product) {
            return new Collection();
        }

        $subcategoryId = $product->subcategory_id;
        $categoryId = $product->subcategory ? $product->subcategory->category_id : null;

        return AddOn::query()->where(function ($query) use ($product, $subcategoryId, $categoryId) {
            // Global scope add-ons
            $query->where('scope', 'global')
                ->orWhereNull('scope');

            // Category scope add-ons
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

            // Subcategory scope add-ons
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

            // Product scope add-ons
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

    /**
     * Create a new add-on and sync pivot tables.
     */
    public function createAddOn(array $data)
    {
        $sanitized = $this->sanitizeScopeData($data);
        $addOn = AddOn::create($sanitized);
        $this->syncPivots($addOn, $data);
        return $addOn->load(['category', 'subcategory', 'product', 'categories', 'subcategories', 'products']);
    }

    /**
     * Update an existing add-on and sync pivot tables.
     */
    public function updateAddOn(int $id, array $data)
    {
        $addOn = AddOn::findOrFail($id);
        $sanitized = $this->sanitizeScopeData($data, $addOn);
        $addOn->update($sanitized);
        $this->syncPivots($addOn, $data);
        return $addOn->load(['category', 'subcategory', 'product', 'categories', 'subcategories', 'products']);
    }

    /**
     * Delete an add-on.
     */
    public function deleteAddOn(int $id)
    {
        $addOn = AddOn::findOrFail($id);
        $addOn->delete();
    }

    /**
     * Sanitize scope fields based on selected scope type.
     */
    protected function sanitizeScopeData(array $data, ?AddOn $existing = null): array
    {
        $scope = $data['scope'] ?? ($existing->scope ?? 'global');
        $data['scope'] = $scope;

        if ($scope === 'global') {
            $data['category_id'] = null;
            $data['subcategory_id'] = null;
            $data['product_id'] = null;
        } elseif ($scope === 'category') {
            $data['subcategory_id'] = null;
            $data['product_id'] = null;
            if (!empty($data['category_ids']) && is_array($data['category_ids'])) {
                $data['category_id'] = $data['category_ids'][0] ?? null;
            }
        } elseif ($scope === 'subcategory') {
            $data['category_id'] = null;
            $data['product_id'] = null;
            if (!empty($data['subcategory_ids']) && is_array($data['subcategory_ids'])) {
                $data['subcategory_id'] = $data['subcategory_ids'][0] ?? null;
            }
        } elseif ($scope === 'product') {
            $data['category_id'] = null;
            $data['subcategory_id'] = null;
            if (!empty($data['product_ids']) && is_array($data['product_ids'])) {
                $data['product_id'] = $data['product_ids'][0] ?? null;
            }
        }

        return $data;
    }

    /**
     * Sync relationship pivot tables based on scope type.
     */
    protected function syncPivots(AddOn $addOn, array $data): void
    {
        $scope = $addOn->scope;

        $categoryIds = [];
        if (isset($data['category_ids']) && is_array($data['category_ids'])) {
            $categoryIds = array_map('intval', $data['category_ids']);
        } elseif (!empty($data['category_id'])) {
            $categoryIds = [(int) $data['category_id']];
        }

        $subcategoryIds = [];
        if (isset($data['subcategory_ids']) && is_array($data['subcategory_ids'])) {
            $subcategoryIds = array_map('intval', $data['subcategory_ids']);
        } elseif (!empty($data['subcategory_id'])) {
            $subcategoryIds = [(int) $data['subcategory_id']];
        }

        $productIds = [];
        if (isset($data['product_ids']) && is_array($data['product_ids'])) {
            $productIds = array_map('intval', $data['product_ids']);
        } elseif (!empty($data['product_id'])) {
            $productIds = [(int) $data['product_id']];
        }

        if ($scope === 'category') {
            $addOn->categories()->sync($categoryIds);
            $addOn->subcategories()->sync([]);
            $addOn->products()->sync([]);
        } elseif ($scope === 'subcategory') {
            $addOn->categories()->sync([]);
            $addOn->subcategories()->sync($subcategoryIds);
            $addOn->products()->sync([]);
        } elseif ($scope === 'product') {
            $addOn->categories()->sync([]);
            $addOn->subcategories()->sync([]);
            $addOn->products()->sync($productIds);
        } else {
            $addOn->categories()->sync([]);
            $addOn->subcategories()->sync([]);
            $addOn->products()->sync([]);
        }
    }
}
