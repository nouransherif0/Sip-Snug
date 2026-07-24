<?php

namespace App\Services\Categories;
use App\Models\Category;

// Defines the structure and properties of this class
class CategoryService
{
    public function getAllCategories()
    {
        return Category::with('subcategories')->get();
    }

    public function getCategoryDetails(int $id)
    {
        return Category::with('subcategories')->findOrFail($id);
    }

    public function getCategoryWithProducts(int $id)
    {
        return Category::findOrFail($id)->products;
    }

    public function createCategory(array $data)
    {
        return Category::create($data);
    }

    public function updateCategory(int $id, array $data)
    {
        $category = Category::findOrFail($id);
        $category->update($data);
        return $category;
    }

    public function deleteCategory(int $id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
    }
}
