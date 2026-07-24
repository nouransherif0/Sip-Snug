<?php

namespace App\Services\Orders;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Address;
use App\Services\Carts\CartService;
use Illuminate\Support\Facades\DB;
use Exception;

// Defines the structure and properties of this class
class OrderService
{
    public function __construct(protected CartService $cartService) {}

    public function placeOrder(string $userId, array $checkoutData)
    {
        return DB::transaction(function () use ($userId, $checkoutData) {
            $cart = $this->cartService->getOrCreateCart($userId);
            
            if ($cart->cartItems()->count() === 0) {
                throw new Exception("Cart is empty.");
            }

            $address = Address::with('deliveryZone')->where('id', $checkoutData['address_id'])->firstOrFail();
            $subtotal = $this->cartService->calculateSubtotal($userId);
            $deliveryFee = $address->deliveryZone->delivery_fee ?? 0;
            $totalPrice = $subtotal + $deliveryFee;

            $order = Order::create([
                'user_id' => $userId,
                'address_id' => $checkoutData['address_id'],
                'total_price' => $totalPrice,
                'delivery_fee' => $deliveryFee,
                'status' => 'pending',
                'payment_method' => $checkoutData['payment_method'],
            ]);

            foreach ($cart->cartItems as $item) {
                // Calculate item snapshot price (product price + addons)
                $productPrice = $item->product->price;
                $addonsTotal = 0;
                
                if (is_array($item->add_ons)) {
                    foreach ($item->add_ons as $addon) {
                        $addonsTotal += $addon['price_adjustment'] ?? 0;
                    }
                }
                
                $itemPrice = $productPrice + $addonsTotal;

                $orderItem = OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item->product_id,
                    'quantity' => $item->quantity,
                    'price' => $itemPrice,
                ]);

                if (is_array($item->add_ons)) {
                    foreach ($item->add_ons as $addon) {
                        $orderItem->orderItemAddons()->create([
                            'addon_id' => $addon['id'] ?? null,
                            'price_adjustment' => $addon['price_adjustment'] ?? 0,
                        ]);
                    }
                }
            }

            $cart->cartItems()->delete();
            
            // Add reward points (1 point per 10 currency units spent)
            $user = \App\Models\User::find($userId);
            if ($user) {
                $pointsEarned = (int) ($totalPrice / 10);
                $user->reward_points += max(1, $pointsEarned);
                $user->save();
            }

            return $order->load(['orderItems.product', 'address.deliveryZone']);
        });
    }

    public function getUserOrders(string $userId)
    {
        return Order::with(['orderItems.product', 'address.deliveryZone'])
            ->where('user_id', $userId)
            ->orderBy('created_at', 'desc')
            ->get();
    }

    public function updateStatus(string $orderId, string $status)
    {
        $order = Order::findOrFail($orderId);
        $order->update(['status' => $status]);
        return $order;
    }
}
