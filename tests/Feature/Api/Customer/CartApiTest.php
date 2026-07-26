<?php

namespace Tests\Feature\Api\Customer;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CartApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_view_cart()
    {
        $user = User::factory()->create();
        $cart = Cart::factory()->create(['user_id' => $user->id]);
        CartItem::factory()->count(2)->create(['cart_id' => $cart->id]);

        $response = $this->actingAs($user)->getJson('/cart');

        $response->assertStatus(200)
                 ->assertJsonCount(2, 'data.items');
    }

    public function test_user_can_add_item_to_cart()
    {
        $user = User::factory()->create();
        $product = Product::factory()->create();

        $response = $this->actingAs($user)->postJson('/cart/items', [
            'product_id' => $product->id,
            'quantity' => 2,
        ]);

        $response->assertStatus(200)
                 ->assertJsonPath('item.quantity', 2)
                 ->assertJsonPath('item.product.id', $product->id);

        $this->assertDatabaseHas('cart_items', [
            'product_id' => $product->id,
            'quantity' => 2,
        ]);
    }

    public function test_user_can_update_cart_item_quantity()
    {
        $user = User::factory()->create();
        $cart = Cart::factory()->create(['user_id' => $user->id]);
        $cartItem = CartItem::factory()->create(['cart_id' => $cart->id, 'quantity' => 1]);

        $response = $this->actingAs($user)->putJson("/cart/items/{$cartItem->id}", [
            'quantity' => 5,
        ]);

        $response->assertStatus(200)
                 ->assertJsonPath('item.quantity', 5);

        $this->assertDatabaseHas('cart_items', [
            'id' => $cartItem->id,
            'quantity' => 5,
        ]);
    }

    public function test_user_can_remove_item_from_cart()
    {
        $user = User::factory()->create();
        $cart = Cart::factory()->create(['user_id' => $user->id]);
        $cartItem = CartItem::factory()->create(['cart_id' => $cart->id]);

        $response = $this->actingAs($user)->deleteJson("/cart/items/{$cartItem->id}");

        $response->assertStatus(200);
        
        $this->assertDatabaseMissing('cart_items', [
            'id' => $cartItem->id,
        ]);
    }
}
