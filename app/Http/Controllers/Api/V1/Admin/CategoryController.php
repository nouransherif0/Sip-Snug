<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Categories\StoreCategoryRequest;
use App\Http\Requests\Categories\UpdateCategoryRequest;
use App\Http\Resources\Categories\CategoryResource;
use App\Services\Categories\CategoryService;
use Illuminate\Http\Request;
use OpenApi\Attributes as OA;

class CategoryController extends Controller
{
    public function __construct(protected CategoryService $categoryService) {}

    #[OA\Get(
        path: '/admin/categories',
        summary: 'Get all categories (Admin)',
        description: 'Retrieve a list of all categories.',
        tags: ['Admin - Categories'],
        security: [['bearerAuth' => []]],
        responses: [
            new OA\Response(response: 200, description: 'Successful operation')
        ]
    )]
    public function index()
    {
        $categories = $this->categoryService->getAllCategories();
        return CategoryResource::collection($categories);
    }

    #[OA\Post(
        path: '/admin/categories',
        summary: 'Create a new category (Admin)',
        description: 'Add a new category with an optional image.',
        tags: ['Admin - Categories'],
        security: [['bearerAuth' => []]],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\MediaType(
                mediaType: 'multipart/form-data',
                schema: new OA\Schema(
                    required: ['name'],
                    properties: [
                        new OA\Property(property: 'name', type: 'string'),
                        new OA\Property(property: 'image', type: 'string', format: 'binary')
                    ]
                )
            )
        ),
        responses: [
            new OA\Response(response: 200, description: 'Category created successfully'),
            new OA\Response(response: 422, description: 'Validation error')
        ]
    )]
    public function store(StoreCategoryRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('front/photos/categories'), $filename);
            $data['image'] = 'front/photos/categories/' . $filename;
        }

        $category = $this->categoryService->createCategory($data);
        return new CategoryResource($category);
    }

    #[OA\Put(
        path: '/admin/categories/{id}',
        summary: 'Update a category (Admin)',
        description: 'Update an existing category.',
        tags: ['Admin - Categories'],
        security: [['bearerAuth' => []]],
        parameters: [
            new OA\Parameter(
                name: 'id',
                in: 'path',
                required: true,
                description: 'Category ID',
                schema: new OA\Schema(type: 'integer')
            )
        ],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\MediaType(
                mediaType: 'multipart/form-data',
                schema: new OA\Schema(
                    properties: [
                        new OA\Property(property: 'name', type: 'string'),
                        new OA\Property(property: 'image', type: 'string', format: 'binary')
                    ]
                )
            )
        ),
        responses: [
            new OA\Response(response: 200, description: 'Category updated successfully'),
            new OA\Response(response: 422, description: 'Validation error')
        ]
    )]
    public function update(UpdateCategoryRequest $request, $id)
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('front/photos/categories'), $filename);
            $data['image'] = 'front/photos/categories/' . $filename;
        }

        $category = $this->categoryService->updateCategory($id, $data);
        return new CategoryResource($category);
    }

    #[OA\Delete(
        path: '/admin/categories/{id}',
        summary: 'Delete a category (Admin)',
        description: 'Delete a category from the database.',
        tags: ['Admin - Categories'],
        security: [['bearerAuth' => []]],
        parameters: [
            new OA\Parameter(
                name: 'id',
                in: 'path',
                required: true,
                description: 'Category ID',
                schema: new OA\Schema(type: 'integer')
            )
        ],
        responses: [
            new OA\Response(response: 200, description: 'Category deleted successfully')
        ]
    )]
    public function destroy($id)
    {
        $this->categoryService->deleteCategory($id);
        return response()->json(['message' => 'Category deleted successfully']);
    }
}
