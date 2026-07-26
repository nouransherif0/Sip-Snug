<?php

namespace App\Http\Controllers\Api\V1\Subcategories;

use App\Http\Controllers\Controller;
use App\Http\Resources\Subcategories\SubcategoryResource;
use App\Services\Subcategories\SubcategoryService;
use Illuminate\Http\Request;
use App\Http\Requests\Customer\FilterSubcategoriesRequest;
use OpenApi\Attributes as OA;

class SubcategoryController extends Controller
{
    public function __construct(protected SubcategoryService $subcategoryService) {}

    #[OA\Get(
        path: '/subcategories',
        summary: 'Get subcategories by category',
        description: 'Retrieve a list of subcategories belonging to a specific category.',
        tags: ['Subcategories'],
        parameters: [
            new OA\Parameter(
                name: 'category_id',
                in: 'query',
                required: true,
                description: 'Category ID',
                schema: new OA\Schema(type: 'integer')
            )
        ],
        responses: [
            new OA\Response(response: 200, description: 'Successful operation'),
            new OA\Response(response: 422, description: 'Validation error')
        ]
    )]
    public function index(FilterSubcategoriesRequest $request)
    {
        
        $subcategories = $this->subcategoryService->getSubcategoriesByCategory($request->category_id);
        return SubcategoryResource::collection($subcategories);
    }
}
