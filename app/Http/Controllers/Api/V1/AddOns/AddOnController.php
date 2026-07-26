<?php

namespace App\Http\Controllers\Api\V1\AddOns;

use App\Http\Controllers\Controller;
use App\Http\Resources\AddOns\AddOnResource;
use App\Services\AddOns\AddOnService;
use OpenApi\Attributes as OA;

class AddOnController extends Controller
{
    public function __construct(protected AddOnService $addOnService) {}

    #[OA\Get(
        path: '/add-ons',
        summary: 'Get all add-ons',
        description: 'Retrieve a list of all available add-ons.',
        tags: ['AddOns'],
        responses: [
            new OA\Response(response: 200, description: 'Successful operation')
        ]
    )]
    public function index()
    {
        $addOns = $this->addOnService->getAllAddOns();
        return AddOnResource::collection($addOns);
    }
}