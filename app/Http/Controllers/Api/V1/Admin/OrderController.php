<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Orders\UpdateOrderStatusRequest;
use App\Http\Resources\Orders\OrderResource;
use App\Models\Order;
use App\Services\Orders\OrderService;
use Illuminate\Http\Request;
use OpenApi\Attributes as OA;

class OrderController extends Controller
{
    public function __construct(protected OrderService $orderService) {}

    #[OA\Get(
        path: '/admin/orders',
        summary: 'Get all orders (Admin)',
        description: 'Retrieve a paginated list of all orders.',
        tags: ['Admin - Orders'],
        security: [['bearerAuth' => []]],
        responses: [
            new OA\Response(response: 200, description: 'Successful operation')
        ]
    )]
    public function index()
    {
        $orders = Order::with(['orderItems.product', 'address.deliveryZone'])
            ->orderBy('created_at', 'desc')
            ->paginate(20);
            
        return OrderResource::collection($orders);
    }

    #[OA\Put(
        path: '/admin/orders/{id}/status',
        summary: 'Update order status (Admin)',
        description: 'Update the status of an existing order.',
        tags: ['Admin - Orders'],
        security: [['bearerAuth' => []]],
        parameters: [
            new OA\Parameter(
                name: 'id',
                in: 'path',
                required: true,
                description: 'Order ID',
                schema: new OA\Schema(type: 'string')
            )
        ],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                required: ['status'],
                properties: [
                    new OA\Property(property: 'status', type: 'string', description: 'New status (e.g. pending, confirmed, processing, shipped, delivered, cancelled)')
                ]
            )
        ),
        responses: [
            new OA\Response(response: 200, description: 'Status updated successfully'),
            new OA\Response(response: 422, description: 'Validation error')
        ]
    )]
    public function update(UpdateOrderStatusRequest $request, $id)
    {
        $order = $this->orderService->updateStatus($id, $request->status);
        return new OrderResource($order->load(['orderItems.product', 'address.deliveryZone']));
    }
}
