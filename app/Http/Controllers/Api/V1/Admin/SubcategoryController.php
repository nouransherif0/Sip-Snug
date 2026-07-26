<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Subcategories\StoreSubcategoryRequest;
use App\Http\Requests\Subcategories\UpdateSubcategoryRequest;
use App\Http\Resources\Subcategories\SubcategoryResource;
use App\Services\Subcategories\SubcategoryService;
use Illuminate\Http\Request;
use OpenApi\Attributes as OA;

class SubcategoryController extends Controller
{
    public function __construct(protected SubcategoryService $subcategoryService) {}

    #[OA\Post(
        path: '/admin/subcategories',
        summary: 'Create a new subcategory (Admin)',
        description: 'Add a new subcategory.',
        tags: ['Admin - Subcategories'],
        security: [['bearerAuth' => []]],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                required: ['category_id', 'name'],
                properties: [
                    new OA\Property(property: 'category_id', type: 'integer'),
                    new OA\Property(property: 'name', type: 'string')
                ]
            )
        ),
        responses: [
            new OA\Response(response: 200, description: 'Subcategory created successfully'),
            new OA\Response(response: 422, description: 'Validation error')
        ]
    )]
    public function store(StoreSubcategoryRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('front/photos/subcategories'), $filename);
            $data['image'] = 'front/photos/subcategories/' . $filename;
        }

        $subcategory = $this->subcategoryService->createSubcategory($data);
        return new SubcategoryResource($subcategory);
    }

    #[OA\Put(
        path: '/admin/subcategories/{id}',
        summary: 'Update a subcategory (Admin)',
        description: 'Update an existing subcategory.',
        tags: ['Admin - Subcategories'],
        security: [['bearerAuth' => []]],
        parameters: [
            new OA\Parameter(
                name: 'id',
                in: 'path',
                required: true,
                description: 'Subcategory ID',
                schema: new OA\Schema(type: 'integer')
            )
        ],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                properties: [
                    new OA\Property(property: 'category_id', type: 'integer'),
                    new OA\Property(property: 'name', type: 'string')
                ]
            )
        ),
        responses: [
            new OA\Response(response: 200, description: 'Subcategory updated successfully'),
            new OA\Response(response: 422, description: 'Validation error')
        ]
    )]
    public function update(UpdateSubcategoryRequest $request, $id)
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('front/photos/subcategories'), $filename);
            $data['image'] = 'front/photos/subcategories/' . $filename;
        }

        $subcategory = $this->subcategoryService->updateSubcategory($id, $data);
        return new SubcategoryResource($subcategory);
    }

    #[OA\Delete(
        path: '/admin/subcategories/{id}',
        summary: 'Delete a subcategory (Admin)',
        description: 'Delete a subcategory from the database.',
        tags: ['Admin - Subcategories'],
        security: [['bearerAuth' => []]],
        parameters: [
            new OA\Parameter(
                name: 'id',
                in: 'path',
                required: true,
                description: 'Subcategory ID',
                schema: new OA\Schema(type: 'integer')
            )
        ],
        responses: [
            new OA\Response(response: 200, description: 'Subcategory deleted successfully')
        ]
    )]
    public function destroy($id)
    {
        $this->subcategoryService->deleteSubcategory($id);
        return response()->json(['message' => 'Subcategory deleted successfully']);
    }
}
