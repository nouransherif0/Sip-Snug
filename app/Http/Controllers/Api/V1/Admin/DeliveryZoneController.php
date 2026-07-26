<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\DeliveryZones\StoreDeliveryZoneRequest;
use App\Http\Requests\DeliveryZones\UpdateDeliveryZoneRequest;
use App\Http\Resources\DeliveryZones\DeliveryZoneResource;
use App\Services\DeliveryZones\DeliveryZoneService;
use OpenApi\Attributes as OA;

class DeliveryZoneController extends Controller
{
    public function __construct(protected DeliveryZoneService $deliveryZoneService) {}

    #[OA\Get(
        path: '/admin/delivery-zones',
        summary: 'Get all delivery zones (Admin)',
        description: 'Retrieve a list of all delivery zones for the admin panel.',
        tags: ['Admin DeliveryZones'],
        security: [['bearerAuth' => []]],
        responses: [
            new OA\Response(response: 200, description: 'Successful operation')
        ]
    )]
    public function index()
    {
        $zones = $this->deliveryZoneService->getAllZones();
        return DeliveryZoneResource::collection($zones);
    }

    #[OA\Post(
        path: '/admin/delivery-zones',
        summary: 'Create a new delivery zone',
        description: 'Create a new delivery zone (Admin only).',
        tags: ['Admin DeliveryZones'],
        security: [['bearerAuth' => []]],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\MediaType(
                mediaType: 'application/json',
                schema: new OA\Schema(
                    required: ['name', 'delivery_fee', 'minimum_order_value'],
                    properties: [
                        new OA\Property(property: 'name', type: 'string', example: 'Downtown'),
                        new OA\Property(property: 'delivery_fee', type: 'number', format: 'float', example: 5.00),
                        new OA\Property(property: 'minimum_order_value', type: 'number', format: 'float', example: 15.00),
                        new OA\Property(property: 'estimated_time', type: 'string', example: '30-45 mins')
                    ]
                )
            )
        ),
        responses: [
            new OA\Response(response: 201, description: 'Delivery zone created successfully'),
            new OA\Response(response: 422, description: 'Validation error')
        ]
    )]
    public function store(StoreDeliveryZoneRequest $request)
    {
        $data = $request->validated();
        $zone = $this->deliveryZoneService->createZone($data);
        return new DeliveryZoneResource($zone);
    }

    #[OA\Put(
        path: '/admin/delivery-zones/{id}',
        summary: 'Update an existing delivery zone',
        description: 'Update the details of a delivery zone (Admin only).',
        tags: ['Admin DeliveryZones'],
        security: [['bearerAuth' => []]],
        parameters: [
            new OA\Parameter(
                name: 'id',
                in: 'path',
                required: true,
                description: 'Delivery Zone ID',
                schema: new OA\Schema(type: 'integer')
            )
        ],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\MediaType(
                mediaType: 'application/json',
                schema: new OA\Schema(
                    properties: [
                        new OA\Property(property: 'name', type: 'string', example: 'Downtown'),
                        new OA\Property(property: 'delivery_fee', type: 'number', format: 'float', example: 5.50),
                        new OA\Property(property: 'minimum_order_value', type: 'number', format: 'float', example: 20.00),
                        new OA\Property(property: 'estimated_time', type: 'string', example: '40-50 mins')
                    ]
                )
            )
        ),
        responses: [
            new OA\Response(response: 200, description: 'Delivery zone updated successfully'),
            new OA\Response(response: 404, description: 'Delivery zone not found'),
            new OA\Response(response: 422, description: 'Validation error')
        ]
    )]
    public function update(UpdateDeliveryZoneRequest $request, $id)
    {
        $data = $request->validated();
        $zone = $this->deliveryZoneService->updateZone($id, $data);
        return new DeliveryZoneResource($zone);
    }

    #[OA\Delete(
        path: '/admin/delivery-zones/{id}',
        summary: 'Delete a delivery zone',
        description: 'Delete a delivery zone (Admin only).',
        tags: ['Admin DeliveryZones'],
        security: [['bearerAuth' => []]],
        parameters: [
            new OA\Parameter(
                name: 'id',
                in: 'path',
                required: true,
                description: 'Delivery Zone ID',
                schema: new OA\Schema(type: 'integer')
            )
        ],
        responses: [
            new OA\Response(response: 200, description: 'Delivery zone deleted successfully'),
            new OA\Response(response: 404, description: 'Delivery zone not found')
        ]
    )]
    public function destroy($id)
    {
        $this->deliveryZoneService->deleteZone($id);
        return response()->json(['message' => 'Delivery zone deleted successfully']);
    }
}