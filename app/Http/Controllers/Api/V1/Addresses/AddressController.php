<?php

namespace App\Http\Controllers\Api\V1\Addresses;

use App\Http\Controllers\Controller;
use App\Http\Requests\Addresses\StoreAddressRequest;
use App\Http\Requests\Addresses\UpdateAddressRequest;
use App\Http\Resources\Addresses\AddressResource;
use App\Services\Addresses\AddressService;
use Illuminate\Http\Request;
use OpenApi\Attributes as OA;

class AddressController extends Controller
{
    public function __construct(protected AddressService $addressService) {}

    #[OA\Get(
        path: '/addresses',
        summary: 'Get user addresses',
        description: 'Retrieve all addresses for the authenticated user.',
        tags: ['Addresses'],
        security: [['bearerAuth' => []]],
        responses: [
            new OA\Response(response: 200, description: 'Successful operation')
        ]
    )]
    public function index(Request $request)
    {
        $addresses = $this->addressService->getUserAddresses($request->user()->id);
        return AddressResource::collection($addresses);
    }

    #[OA\Post(
        path: '/addresses',
        summary: 'Add a new address',
        description: 'Add a new delivery address for the user.',
        tags: ['Addresses'],
        security: [['bearerAuth' => []]],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                required: ['delivery_zone_id', 'street', 'building_number', 'phone_number'],
                properties: [
                    new OA\Property(property: 'delivery_zone_id', type: 'string'),
                    new OA\Property(property: 'street', type: 'string'),
                    new OA\Property(property: 'building_number', type: 'string'),
                    new OA\Property(property: 'phone_number', type: 'string'),
                    new OA\Property(property: 'label', type: 'string'),
                    new OA\Property(property: 'floor', type: 'string'),
                    new OA\Property(property: 'apartment', type: 'string'),
                    new OA\Property(property: 'landmark', type: 'string'),
                    new OA\Property(property: 'is_default', type: 'boolean')
                ]
            )
        ),
        responses: [
            new OA\Response(response: 200, description: 'Address added successfully'),
            new OA\Response(response: 422, description: 'Validation error')
        ]
    )]
    public function store(StoreAddressRequest $request)
    {
        $address = $this->addressService->createAddress($request->user()->id, $request->validated());
        return new AddressResource($address->load('deliveryZone'));
    }

    #[OA\Put(
        path: '/addresses/{id}',
        summary: 'Update an address',
        description: 'Update an existing delivery address.',
        tags: ['Addresses'],
        security: [['bearerAuth' => []]],
        parameters: [
            new OA\Parameter(
                name: 'id',
                in: 'path',
                required: true,
                description: 'Address ID',
                schema: new OA\Schema(type: 'string')
            )
        ],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                properties: [
                    new OA\Property(property: 'street', type: 'string'),
                    new OA\Property(property: 'is_default', type: 'boolean')
                ]
            )
        ),
        responses: [
            new OA\Response(response: 200, description: 'Address updated successfully'),
            new OA\Response(response: 422, description: 'Validation error')
        ]
    )]
    public function update(UpdateAddressRequest $request, $id)
    {
        $address = $this->addressService->updateAddress($id, $request->user()->id, $request->validated());
        return new AddressResource($address->load('deliveryZone'));
    }

    #[OA\Delete(
        path: '/addresses/{id}',
        summary: 'Delete an address',
        description: 'Delete a specific address belonging to the user.',
        tags: ['Addresses'],
        security: [['bearerAuth' => []]],
        parameters: [
            new OA\Parameter(
                name: 'id',
                in: 'path',
                required: true,
                description: 'Address ID',
                schema: new OA\Schema(type: 'string')
            )
        ],
        responses: [
            new OA\Response(response: 200, description: 'Address deleted successfully')
        ]
    )]
    public function destroy(Request $request, $id)
    {
        $this->addressService->deleteAddress($id, $request->user()->id);
        return response()->json(['message' => 'Address deleted successfully']);
    }
}
