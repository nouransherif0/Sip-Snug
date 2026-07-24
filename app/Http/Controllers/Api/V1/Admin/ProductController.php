<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Products\StoreProductRequest;
use App\Http\Requests\Products\UpdateProductRequest;
use App\Http\Resources\Products\ProductsResources;
use App\Services\Products\ProductService;
use Illuminate\Http\Request;
use OpenApi\Attributes as OA;

class ProductController extends Controller
{
    public function __construct(protected ProductService $productService) {}
    #[OA\Post(
        path: '/admin/products',
        summary: 'Create a new product (Admin)',
        description: 'Add a new product with an optional image.',
        tags: ['Admin - Products'],
        security: [['bearerAuth' => []]],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\MediaType(
                mediaType: 'multipart/form-data',
                schema: new OA\Schema(
                    required: ['subcategory_id', 'name', 'price'],
                    properties: [
                        new OA\Property(property: 'subcategory_id', type: 'integer'),
                        new OA\Property(property: 'name', type: 'string'),
                        new OA\Property(property: 'description', type: 'string'),
                        new OA\Property(property: 'price', type: 'number'),
                        new OA\Property(property: 'image', type: 'string', format: 'binary'),
                        new OA\Property(property: 'stock', type: 'integer'),
                        new OA\Property(property: 'is_featured', type: 'boolean')
                    ]
                )
            )
        ),
        responses: [
            new OA\Response(response: 200, description: 'Product created successfully'),
            new OA\Response(response: 422, description: 'Validation error')
        ]
    )]
    public function store(StoreProductRequest $request)
    {
        $data = $request->validated();
        $data['is_featured'] = $request->boolean('is_featured');

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('front/photos/products'), $filename);
            $data['image'] = 'front/photos/products/' . $filename;
        }

        $product = $this->productService->createProduct($data);
        return new ProductsResources($product);
    }

    #[OA\Put(
        path: '/admin/products/{id}',
        summary: 'Update a product (Admin)',
        description: 'Update an existing product.',
        tags: ['Admin - Products'],
        security: [['bearerAuth' => []]],
        parameters: [
            new OA\Parameter(
                name: 'id',
                in: 'path',
                required: true,
                description: 'Product ID',
                schema: new OA\Schema(type: 'integer')
            )
        ],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\MediaType(
                mediaType: 'multipart/form-data',
                schema: new OA\Schema(
                    properties: [
                        new OA\Property(property: 'subcategory_id', type: 'integer'),
                        new OA\Property(property: 'name', type: 'string'),
                        new OA\Property(property: 'description', type: 'string'),
                        new OA\Property(property: 'price', type: 'number'),
                        new OA\Property(property: 'image', type: 'string', format: 'binary'),
                        new OA\Property(property: 'stock', type: 'integer'),
                        new OA\Property(property: 'is_featured', type: 'boolean')
                    ]
                )
            )
        ),
        responses: [
            new OA\Response(response: 200, description: 'Product updated successfully'),
            new OA\Response(response: 422, description: 'Validation error')
        ]
    )]
    public function update(UpdateProductRequest $request, $id)
    {
        $data = $request->validated();
        $data['is_featured'] = $request->boolean('is_featured');

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('front/photos/products'), $filename);
            $data['image'] = 'front/photos/products/' . $filename;
        }

        $product = $this->productService->updateProduct($id, $data);
        return new ProductsResources($product);
    }

    #[OA\Delete(
        path: '/admin/products/{id}',
        summary: 'Delete a product (Admin)',
        description: 'Delete a product from the database.',
        tags: ['Admin - Products'],
        security: [['bearerAuth' => []]],
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
            new OA\Response(response: 200, description: 'Product deleted successfully')
        ]
    )]
    public function destroy($id)
    {
        $this->productService->deleteProduct($id);
        return response()->json(['message' => 'Product deleted successfully']);
    }
}
