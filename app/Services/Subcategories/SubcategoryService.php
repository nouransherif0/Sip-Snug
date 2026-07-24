<?php

namespace App\Services\Subcategories;

use App\Models\Subcategory;

// Defines the structure and properties of this class
class SubcategoryService
{
    public function getSubcategoriesByCategory(int $categoryId)
    {
        return Subcategory::where('category_id', $categoryId)->get();
    }

    public function createSubcategory(array $data)
    {
        return Subcategory::create($data);
    }

    public function updateSubcategory(int $id, array $data)
    {
        $subcategory = Subcategory::findOrFail($id);
        $subcategory->update($data);
        return $subcategory;
    }

    public function deleteSubcategory(int $id)
    {
        $subcategory = Subcategory::findOrFail($id);
        $subcategory->delete();
    }
}
