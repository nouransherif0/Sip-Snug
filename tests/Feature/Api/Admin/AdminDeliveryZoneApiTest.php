<?php

namespace Tests\Feature\Api\Admin;

use App\Models\DeliveryZone;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminDeliveryZoneApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_get_all_delivery_zones()
    {
        $user = User::factory()->create(['role' => 'admin']);
        DeliveryZone::factory()->count(3)->create();

        $response = $this->actingAs($user)->getJson('/admin/delivery-zones');

        $response->assertStatus(200)
                 ->assertJsonCount(3, 'data');
    }

    public function test_admin_can_create_a_delivery_zone()
    {
        $user = User::factory()->create(['role' => 'admin']);

        $response = $this->actingAs($user)->postJson('/admin/delivery-zones', [
            'name' => 'Downtown',
            'delivery_fee' => 5.00,
            'minimum_order_value' => 15.00,
            'estimated_time' => '30-45 mins',
        ]);

        $response->assertStatus(201)
                 ->assertJsonPath('data.name', 'Downtown')
                 ->assertJsonPath('data.delivery_fee', '5.00')
                 ->assertJsonPath('data.minimum_order_value', '15.00')
                 ->assertJsonPath('data.estimated_time', '30-45 mins');

        $this->assertDatabaseHas('delivery_zones', ['name' => 'Downtown', 'delivery_fee' => 5.00]);
    }

    public function test_admin_cannot_create_a_delivery_zone_with_invalid_data()
    {
        $user = User::factory()->create(['role' => 'admin']);

        $response = $this->actingAs($user)->postJson('/admin/delivery-zones', [
            'name' => '', // Invalid name
            'delivery_fee' => -10, // Invalid fee
        ]);

        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['name', 'delivery_fee', 'minimum_order_value']);
    }

    public function test_admin_can_update_a_delivery_zone()
    {
        $user = User::factory()->create(['role' => 'admin']);
        $zone = DeliveryZone::factory()->create(['name' => 'Old Zone', 'delivery_fee' => 1.00, 'minimum_order_value' => 10.00]);

        $response = $this->actingAs($user)->putJson("/admin/delivery-zones/{$zone->id}", [
            'name' => 'Updated Zone',
            'delivery_fee' => 2.50,
            'minimum_order_value' => 20.00,
            'estimated_time' => '15 mins',
        ]);

        $response->assertStatus(200)
                 ->assertJsonPath('data.name', 'Updated Zone')
                 ->assertJsonPath('data.delivery_fee', '2.50');

        $this->assertDatabaseHas('delivery_zones', ['name' => 'Updated Zone', 'delivery_fee' => 2.50]);
    }

    public function test_admin_can_delete_a_delivery_zone()
    {
        $user = User::factory()->create(['role' => 'admin']);
        $zone = DeliveryZone::factory()->create();

        $response = $this->actingAs($user)->deleteJson("/admin/delivery-zones/{$zone->id}");

        $response->assertStatus(200);
        $this->assertDatabaseMissing('delivery_zones', ['id' => $zone->id]);
    }
}
