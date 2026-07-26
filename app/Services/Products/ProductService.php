<?php

namespace App\Services\Products;
use App\Models\Product;
use Illuminate\Http\Request;

// Defines the structure and properties of this class
class ProductService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {

    }

    public function getFilteredProducts(Request $request, array $filters){

        if(isset($filters['search'])){
            $searchTerms = explode(' ', $filters['search']);
            $query = Product::query();
            foreach ($searchTerms as $term) {
                $term = trim($term);
                if (empty($term)) continue;
                $query->where(function($q) use ($term) {
                    $q->where('name', 'like', "%{$term}%")
                      ->orWhere('description', 'like', "%{$term}%");
                });
            }

            $products = $query->get();

            return $products;
        }
        else{
            $products = Product::all();
            return $products;
        }
    }

    public function getProductById(int $id)
    {
        return Product::findOrFail($id);
    }

    public function createProduct(array $data)
    {
        if (!empty($data['is_bestseller'])) {
            $this->unmarkOtherBestsellers($data['subcategory_id']);
        }
        return Product::create($data);
    }

    public function updateProduct(int $id, array $data)
    {
        $product = Product::findOrFail($id);
        if (!empty($data['is_bestseller'])) {
            $subcategoryId = $data['subcategory_id'] ?? $product->subcategory_id;
            $this->unmarkOtherBestsellers($subcategoryId, $id);
        }
        $product->update($data);
        return $product;
    }

    protected function unmarkOtherBestsellers($subcategoryId, $ignoreId = null)
    {
        $subcategory = \App\Models\Subcategory::find($subcategoryId);
        if ($subcategory) {
            $subIds = \App\Models\Subcategory::where('category_id', $subcategory->category_id)->pluck('id');
            $query = Product::whereIn('subcategory_id', $subIds);
            if ($ignoreId) {
                $query->where('id', '!=', $ignoreId);
            }
            $query->update(['is_bestseller' => false]);
        }
    }

    public function deleteProduct(int $id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
    }
}
