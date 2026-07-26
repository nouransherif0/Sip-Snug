<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddOns\StoreAddOnRequest;
use App\Http\Requests\AddOns\UpdateAddOnRequest;
use App\Http\Resources\AddOns\AddOnResource;
use App\Services\AddOns\AddOnService;
use OpenApi\Attributes as OA;

class AddOnController extends Controller
{
    public function __construct(protected AddOnService $addOnService) {}

    #[OA\Get(
        path: '/admin/add-ons',
        summary: 'Get all add-ons (Admin)',
        description: 'Retrieve a list of all add-ons for the admin panel.',
        tags: ['Admin AddOns'],
        security: [['bearerAuth' => []]],
        responses: [
            new OA\Response(response: 200, description: 'Successful operation')
        ]
    )]
    public function index()
    {
        $addOns = $this->addOnService->getAllAddOns();
        return AddOnResource::collection($addOns);
    }

    #[OA\Post(
        path: '/admin/add-ons',
        summary: 'Create a new add-on',
        description: 'Create a new add-on (Admin only).',
        tags: ['Admin AddOns'],
        security: [['bearerAuth' => []]],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\MediaType(
                mediaType: 'application/json',
                schema: new OA\Schema(
                    required: ['name', 'price_adjustment'],
                    properties: [
                        new OA\Property(property: 'name', type: 'string', example: 'Extra Cheese'),
                        new OA\Property(property: 'price_adjustment', type: 'number', format: 'float', example: 1.50)
                    ]
                )
            )
        ),
        responses: [
            new OA\Response(response: 201, description: 'Add-on created successfully'),
            new OA\Response(response: 422, description: 'Validation error')
        ]
    )]
    public function store(StoreAddOnRequest $request)
    {
        $data = $request->validated();
        $addOn = $this->addOnService->createAddOn($data);
        return new AddOnResource($addOn);
    }

    #[OA\Put(
        path: '/admin/add-ons/{id}',
        summary: 'Update an existing add-on',
        description: 'Update the details of an add-on (Admin only).',
        tags: ['Admin AddOns'],
        security: [['bearerAuth' => []]],
        parameters: [
            new OA\Parameter(
                name: 'id',
                in: 'path',
                required: true,
                description: 'Add-on ID',
                schema: new OA\Schema(type: 'integer')
            )
        ],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\MediaType(
                mediaType: 'application/json',
                schema: new OA\Schema(
                    properties: [
                        new OA\Property(property: 'name', type: 'string', example: 'Extra Cheese'),
                        new OA\Property(property: 'price_adjustment', type: 'number', format: 'float', example: 2.00)
                    ]
                )
            )
        ),
        responses: [
            new OA\Response(response: 200, description: 'Add-on updated successfully'),
            new OA\Response(response: 404, description: 'Add-on not found'),
            new OA\Response(response: 422, description: 'Validation error')
        ]
    )]
    public function update(UpdateAddOnRequest $request, $id)
    {
        $data = $request->validated();
        $addOn = $this->addOnService->updateAddOn($id, $data);
        return new AddOnResource($addOn);
    }

    #[OA\Delete(
        path: '/admin/add-ons/{id}',
        summary: 'Delete an add-on',
        description: 'Delete an add-on (Admin only).',
        tags: ['Admin AddOns'],
        security: [['bearerAuth' => []]],
        parameters: [
            new OA\Parameter(
                name: 'id',
                in: 'path',
                required: true,
                description: 'Add-on ID',
                schema: new OA\Schema(type: 'integer')
            )
        ],
        responses: [
            new OA\Response(response: 200, description: 'Add-on deleted successfully'),
            new OA\Response(response: 404, description: 'Add-on not found')
        ]
    )]
    public function destroy($id)
    {
        $this->addOnService->deleteAddOn($id);
        return response()->json(['message' => 'Add-on deleted successfully']);
    }
}