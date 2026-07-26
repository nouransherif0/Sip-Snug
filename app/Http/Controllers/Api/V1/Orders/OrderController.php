<?php

namespace App\Http\Controllers\Api\V1\Orders;

use App\Http\Controllers\Controller;
use App\Http\Requests\Orders\CheckoutRequest;
use App\Http\Resources\Orders\OrderResource;
use App\Services\Orders\OrderService;
use Illuminate\Http\Request;
use OpenApi\Attributes as OA;

class OrderController extends Controller
{
    public function __construct(protected OrderService $orderService) {}

    #[OA\Get(
        path: '/orders',
        summary: 'Get user orders',
        description: 'Retrieve all orders for the authenticated user.',
        tags: ['Orders'],
        security: [['bearerAuth' => []]],
        responses: [
            new OA\Response(response: 200, description: 'Successful operation')
        ]
    )]
    public function index(Request $request)
    {
        $orders = $this->orderService->getUserOrders($request->user()->id);
        return OrderResource::collection($orders);
    }

    #[OA\Post(
        path: '/orders',
        summary: 'Place a new order',
        description: 'Place an order using the items currently in the user\'s cart.',
        tags: ['Orders'],
        security: [['bearerAuth' => []]],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                required: ['address_id', 'payment_method'],
                properties: [
                    new OA\Property(property: 'address_id', type: 'string', description: 'User\'s address ID'),
                    new OA\Property(property: 'payment_method', type: 'string', description: 'Payment method used')
                ]
            )
        ),
        responses: [
            new OA\Response(response: 200, description: 'Order placed successfully'),
            new OA\Response(response: 400, description: 'Bad Request (e.g. empty cart)'),
            new OA\Response(response: 422, description: 'Validation error')
        ]
    )]
    public function store(CheckoutRequest $request)
    {
        try {
            $order = $this->orderService->placeOrder($request->user()->id, $request->validated());
            return new OrderResource($order);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }

    #[OA\Get(
        path: '/orders/{id}',
        summary: 'Get order details',
        description: 'Retrieve the details of a specific order.',
        tags: ['Orders'],
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
        responses: [
            new OA\Response(response: 200, description: 'Successful operation'),
            new OA\Response(response: 404, description: 'Order not found')
        ]
    )]
    public function show(Request $request, $id)
    {
        $order = $this->orderService->getUserOrders($request->user()->id)->where('id', $id)->first();
        
        if (!$order) {
            return response()->json(['message' => 'Order not found.'], 404);
        }

        return new OrderResource($order);
    }

    public function reorder(Request $request, $id)
    {
        $order = \App\Models\Order::with('orderItems.orderItemAddons')->where('id', $id)->where('user_id', $request->user()->id)->first();
        
        if (!$order) {
            return response()->json(['message' => 'Order not found.'], 404);
        }

        $cartService = app(\App\Services\Carts\CartService::class);
        $cart = $cartService->getOrCreateCart($request->user()->id);

        foreach ($order->orderItems as $item) {
            // Re-add to cart
            $cartItem = \App\Models\CartItem::create([
                'cart_id' => $cart->id,
                'product_id' => $item->product_id,
                'quantity' => $item->quantity,
            ]);

            // Try to re-add addons
            $addons = [];
            foreach ($item->orderItemAddons as $addon) {
                if ($addon->addon_id) {
                    $addons[] = [
                        'id' => $addon->addon_id,
                        'price_adjustment' => $addon->price_adjustment
                    ];
                }
            }
            if (count($addons) > 0) {
                $cartItem->add_ons = $addons;
                $cartItem->save();
            }
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Items from order #'.$order->id.' have been added to your cart.'
        ]);
    }
}
