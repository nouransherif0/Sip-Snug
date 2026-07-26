<?php

namespace App\Http\Controllers\Api\V1\Carts;

use App\Http\Controllers\Controller;
use App\Http\Requests\Carts\AddToCartRequest;
use App\Http\Requests\Carts\UpdateCartItemRequest;
use App\Http\Resources\Carts\CartResource;
use App\Http\Resources\Carts\CartItemResource;
use App\Services\Carts\CartService;
use Illuminate\Http\Request;
use OpenApi\Attributes as OA;


class CartController extends Controller
{
    public function __construct(protected CartService $cartService) {}

    #[OA\Get(
        path: '/cart',
        summary: 'Get user cart',
        description: 'Retrieve the current user\'s cart and its items.',
        tags: ['Carts'],
        security: [['bearerAuth' => []]],
        responses: [
            new OA\Response(response: 200, description: 'Successful operation')
        ]
    )]
    public function show(Request $request)
    {
        $cart = $this->cartService->getOrCreateCart($request->user()->id)->load('cartItems.product');
        return new CartResource($cart);
    }

    #[OA\Post(
        path: '/cart/items',
        summary: 'Add item to cart',
        description: 'Add a new product to the user\'s cart.',
        tags: ['Carts'],
        security: [['bearerAuth' => []]],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                required: ['product_id', 'quantity'],
                properties: [
                    new OA\Property(property: 'product_id', type: 'integer'),
                    new OA\Property(property: 'quantity', type: 'integer'),
                    new OA\Property(
                        property: 'add_ons',
                        type: 'array',
                        items: new OA\Items(type: 'integer')
                    )
                ]
            )
        ),
        responses: [
            new OA\Response(response: 200, description: 'Item added successfully'),
            new OA\Response(response: 422, description: 'Validation error')
        ]
    )]
    public function add(AddToCartRequest $request)
    {
        $item = $this->cartService->addItem($request->user()->id, $request->validated());
        return response()->json([
            'message' => 'Item added to cart successfully',
            'item' => new CartItemResource($item->load('product'))
        ]);
    }

    #[OA\Put(
        path: '/cart/items/{id}',
        summary: 'Update cart item quantity',
        description: 'Update the quantity of an existing item in the cart.',
        tags: ['Carts'],
        security: [['bearerAuth' => []]],
        parameters: [
            new OA\Parameter(
                name: 'id',
                in: 'path',
                required: true,
                description: 'Cart Item ID',
                schema: new OA\Schema(type: 'integer')
            )
        ],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                required: ['quantity'],
                properties: [
                    new OA\Property(property: 'quantity', type: 'integer')
                ]
            )
        ),
        responses: [
            new OA\Response(response: 200, description: 'Item updated successfully'),
            new OA\Response(response: 422, description: 'Validation error')
        ]
    )]
    public function update(UpdateCartItemRequest $request, $itemId)
    {
        $item = $this->cartService->updateItemQuantity($itemId, $request->quantity, $request->user()->id);
        return response()->json([
            'message' => 'Cart item updated successfully',
            'item' => new CartItemResource($item->load('product'))
        ]);
    }

    #[OA\Delete(
        path: '/cart/items/{id}',
        summary: 'Remove item from cart',
        description: 'Remove a specific item from the user\'s cart.',
        tags: ['Carts'],
        security: [['bearerAuth' => []]],
        parameters: [
            new OA\Parameter(
                name: 'id',
                in: 'path',
                required: true,
                description: 'Cart Item ID',
                schema: new OA\Schema(type: 'integer')
            )
        ],
        responses: [
            new OA\Response(response: 200, description: 'Item removed successfully')
        ]
    )]
    public function remove(Request $request, $itemId)
    {
        $this->cartService->removeItem($itemId, $request->user()->id);
        return response()->json(['message' => 'Item removed from cart successfully']);
    }
}
