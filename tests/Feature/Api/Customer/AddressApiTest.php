<?php

namespace Tests\Feature\Api\Customer;

use App\Models\Address;
use App\Models\DeliveryZone;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AddressApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_get_own_addresses()
    {
        $user = User::factory()->create();
        Address::factory()->count(2)->create(['user_id' => $user->id]);
        
        // Other user's address
        Address::factory()->create();

        $response = $this->actingAs($user)->getJson('/addresses');

        $response->assertStatus(200)
                 ->assertJsonCount(2, 'data');
    }

    public function test_user_can_add_address()
    {
        $user = User::factory()->create();
        $zone = DeliveryZone::factory()->create();

        $response = $this->actingAs($user)->postJson('/addresses', [
            'delivery_zone_id' => $zone->id,
            'street' => 'Test Street',
            'building_number' => '10A',
            'phone_number' => '01012345678',
            'is_default' => true,
        ]);

        $response->assertStatus(201)
                 ->assertJsonPath('data.street', 'Test Street');

        $this->assertDatabaseHas('addresses', [
            'user_id' => $user->id,
            'street' => 'Test Street',
            'is_default' => 1
        ]);
    }

    public function test_user_can_update_address()
    {
        $user = User::factory()->create();
        $address = Address::factory()->create(['user_id' => $user->id, 'street' => 'Old Street']);

        $response = $this->actingAs($user)->putJson("/addresses/{$address->id}", [
            'street' => 'New Street',
            'is_default' => false,
        ]);

        $response->assertStatus(200)
                 ->assertJsonPath('data.street', 'New Street');

        $this->assertDatabaseHas('addresses', [
            'id' => $address->id,
            'street' => 'New Street',
        ]);
    }

    public function test_user_can_delete_address()
    {
        $user = User::factory()->create();
        $address = Address::factory()->create(['user_id' => $user->id]);

        $response = $this->actingAs($user)->deleteJson("/addresses/{$address->id}");

        $response->assertStatus(200);
        $this->assertDatabaseMissing('addresses', ['id' => $address->id]);
    }
}
