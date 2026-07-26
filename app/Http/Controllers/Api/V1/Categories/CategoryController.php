<?php

namespace App\Http\Controllers\Api\V1\Categories;

use App\Http\Controllers\Controller;
use App\Http\Resources\Categories\CategoryResource;
use App\Services\Categories\CategoryService;
use Illuminate\Http\Request;
use OpenApi\Attributes as OA;

class CategoryController extends Controller
{
    public function __construct(protected CategoryService $categoryService) {}

    #[OA\Get(
        path: '/categories',
        summary: 'Get all categories',
        description: 'Retrieve a list of all categories including their subcategories.',
        tags: ['Categories'],
        responses: [
            new OA\Response(response: 200, description: 'Successful operation')
        ]
    )]
    public function index()
    {
        $categories = $this->categoryService->getAllCategories();
        return CategoryResource::collection($categories);
    }

    #[OA\Get(
        path: '/categories/{id}',
        summary: 'Get a specific category',
        description: 'Retrieve details of a category by its ID.',
        tags: ['Categories'],
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
            new OA\Response(response: 200, description: 'Successful operation'),
            new OA\Response(response: 404, description: 'Category not found')
        ]
    )]
    public function show($id)
    {
        $category = $this->categoryService->getCategoryDetails($id);
        return new CategoryResource($category);
    }
}
