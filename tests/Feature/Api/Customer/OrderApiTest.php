<?php

namespace Tests\Feature\Api\Customer;

use App\Models\Address;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class OrderApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_get_own_orders()
    {
        $user = User::factory()->create();
        Order::factory()->count(3)->create(['user_id' => $user->id]);

        $response = $this->actingAs($user)->getJson('/orders');

        $response->assertStatus(200)
                 ->assertJsonCount(3, 'data');
    }

    public function test_user_can_get_order_details()
    {
        $user = User::factory()->create();
        $order = Order::factory()->create(['user_id' => $user->id]);

        $response = $this->actingAs($user)->getJson("/orders/{$order->id}");

        $response->assertStatus(200)
                 ->assertJsonPath('data.id', $order->id);
    }

    public function test_cannot_checkout_empty_cart()
    {
        $user = User::factory()->create();
        $address = Address::factory()->create(['user_id' => $user->id]);
        
        // Cart is implicitly empty because we didn't add items

        $response = $this->actingAs($user)->postJson('/orders', [
            'address_id' => $address->id,
            'payment_method' => 'cash',
        ]);

        $response->assertStatus(400)
                 ->assertJsonPath('message', 'Cart is empty.');
    }

    public function test_user_can_checkout_successfully()
    {
        $user = User::factory()->create();
        $address = Address::factory()->create(['user_id' => $user->id]);
        $product = Product::factory()->create(['price' => 100]);
        
        $cart = Cart::factory()->create(['user_id' => $user->id]);
        CartItem::factory()->create([
            'cart_id' => $cart->id,
            'product_id' => $product->id,
            'quantity' => 2
        ]); // Total 200

        $response = $this->actingAs($user)->postJson('/orders', [
            'address_id' => $address->id,
            'payment_method' => 'cash',
        ]);

        $response->assertStatus(201); // Assuming 201 for OrderResource from store

        // Check if order was created
        $this->assertDatabaseHas('orders', [
            'user_id' => $user->id,
            'address_id' => $address->id,
            'status' => 'pending',
            'payment_method' => 'cash',
        ]);

        // Check if cart was cleared
        $this->assertDatabaseMissing('cart_items', [
            'cart_id' => $cart->id,
        ]);
    }
}
