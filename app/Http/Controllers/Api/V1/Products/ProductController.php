<?php

namespace App\Http\Controllers\Api\V1\Products;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductFilterRequest;
use App\Services\Products\ProductService;
use App\Services\Categories\CategoryService;
use Illuminate\Http\Request;
use OpenApi\Attributes as OA;

class ProductController extends Controller
{
    public function __construct(protected ProductService $productService) {}
    
    #[OA\Get(
        path: '/products',
        summary: 'Get all products',
        description: 'Retrieve a list of all products, optionally filtered.',
        tags: ['Products'],
        parameters: [
            new OA\Parameter(
                name: 'search',
                in: 'query',
                required: false,
                description: 'Search keyword for product names',
                schema: new OA\Schema(type: 'string')
            )
        ],
        responses: [
            new OA\Response(response: 200, description: 'Successful operation')
        ]
    )]
    public function index(ProductFilterRequest $request)
    {
        $filters = $request->validated();
        $products = $this->productService->getFilteredProducts($request, $filters);
        return \App\Http\Resources\Products\ProductsResources::collection($products);
    }

    #[OA\Get(
        path: '/products/{id}',
        summary: 'Get a specific product',
        description: 'Retrieve details of a product by its ID.',
        tags: ['Products'],
        parameters: [
            new OA\Parameter(
                name: 'id',
                in: 'path',
                required: true,
                description: 'Product ID',
                schema: new OA\Schema(type: 'integer')
            )
        ],
        responses: [
            new OA\Response(response: 200, description: 'Successful operation'),
            new OA\Response(response: 404, description: 'Product not found')
        ]
    )]
    public function show($id)
    {
        $product = $this->productService->getProductById($id);
        return new \App\Http\Resources\Products\ProductsResources($product);
    }   
}
