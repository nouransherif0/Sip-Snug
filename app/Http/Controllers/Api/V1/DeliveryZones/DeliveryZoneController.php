<?php

namespace App\Http\Controllers\Api\V1\DeliveryZones;

use App\Http\Controllers\Controller;
use App\Http\Resources\DeliveryZones\DeliveryZoneResource;
use App\Services\DeliveryZones\DeliveryZoneService;
use OpenApi\Attributes as OA;

class DeliveryZoneController extends Controller
{
    public function __construct(protected DeliveryZoneService $deliveryZoneService) {}

    #[OA\Get(
        path: '/delivery-zones',
        summary: 'Get all delivery zones',
        description: 'Retrieve a list of all available delivery zones.',
        tags: ['DeliveryZones'],
        responses: [
            new OA\Response(response: 200, description: 'Successful operation')
        ]
    )]
    public function index()
    {
        $zones = $this->deliveryZoneService->getAllZones();
        return DeliveryZoneResource::collection($zones);
    }
}