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
        return Product::create($data);
    }

    public function updateProduct(int $id, array $data)
    {
        $product = Product::findOrFail($id);
        $product->update($data);
        return $product;
    }

    public function deleteProduct(int $id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
    }
}
