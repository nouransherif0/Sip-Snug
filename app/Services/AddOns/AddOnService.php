<?php

namespace App\Services\AddOns;

use App\Models\AddOn;

// Defines the structure and properties of this class
class AddOnService
{
    public function getAllAddOns()
    {
        return AddOn::with(['category', 'subcategory', 'product', 'categories', 'subcategories', 'products'])->orderBy('id', 'asc')->get();
    }

    public function getAddOnById(int $id)
    {
        return AddOn::with(['category', 'subcategory', 'product', 'categories', 'subcategories', 'products'])->findOrFail($id);
    }

    public function createAddOn(array $data)
    {
        $sanitized = $this->sanitizeScopeData($data);
        $addOn = AddOn::create($sanitized);
        $this->syncPivots($addOn, $data);
        return $addOn->load(['category', 'subcategory', 'product', 'categories', 'subcategories', 'products']);
    }

    public function updateAddOn(int $id, array $data)
    {
        $addOn = AddOn::findOrFail($id);
        $sanitized = $this->sanitizeScopeData($data, $addOn);
        $addOn->update($sanitized);
        $this->syncPivots($addOn, $data);
        return $addOn->load(['category', 'subcategory', 'product', 'categories', 'subcategories', 'products']);
    }

    public function deleteAddOn(int $id)
    {
        $addOn = AddOn::findOrFail($id);
        $addOn->delete();
    }

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