<?php

namespace Tests\Feature\Api\Admin;

use App\Models\Order;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminOrderApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_get_all_orders()
    {
        $user = User::factory()->create(['role' => 'admin']);
        Order::factory()->count(5)->create();

        $response = $this->actingAs($user)->getJson('/admin/orders');

        $response->assertStatus(200)
                 ->assertJsonCount(5, 'data');
    }

    public function test_admin_can_update_order_status()
    {
        $user = User::factory()->create(['role' => 'admin']);
        $order = Order::factory()->create(['status' => 'pending']);

        $response = $this->actingAs($user)->putJson("/admin/orders/{$order->id}/status", [
            'status' => 'confirmed'
        ]);

        $response->assertStatus(200)
                 ->assertJsonPath('data.status', 'confirmed');

        $this->assertDatabaseHas('orders', [
            'id' => $order->id,
            'status' => 'confirmed',
        ]);
    }

    public function test_admin_cannot_update_invalid_status()
    {
        $user = User::factory()->create(['role' => 'admin']);
        $order = Order::factory()->create(['status' => 'pending']);

        $response = $this->actingAs($user)->putJson("/admin/orders/{$order->id}/status", [
            'status' => 'invalid_status_xyz'
        ]);

        if ($response->status() === 302) {
            $response->assertSessionHasErrors(['status']);
        } else {
            $response->assertStatus(422)
                     ->assertJsonValidationErrors(['status']);
        }
    }
}
