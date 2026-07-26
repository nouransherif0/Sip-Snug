<?php

namespace Tests\Feature\Api\Admin;

use App\Models\StoreLocation;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminStoreLocationApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_get_all_store_locations()
    {
        $user = User::factory()->create(['role' => 'admin']);
        StoreLocation::factory()->count(3)->create();

        $response = $this->actingAs($user)->getJson('/admin/store-locations');

        $response->assertStatus(200)
                 ->assertJsonCount(3, 'data');
    }

    public function test_admin_can_create_a_store_location()
    {
        $user = User::factory()->create(['role' => 'admin']);

        $response = $this->actingAs($user)->postJson('/admin/store-locations', [
            'name' => 'Maadi Branch',
            'badge' => 'Outdoor Patio',
            'address' => 'Road 9, Maadi, Cairo',
            'days_label' => 'Daily',
            'opening_time' => '08:00',
            'closing_time' => '23:00',
            'phone' => '+20 19696 (Ext. 4)',
            'google_maps_url' => 'https://maps.google.com/?q=maadi',
            'status' => 'open',
            'is_active' => true,
        ]);

        $response->assertStatus(201)
                 ->assertJsonPath('data.name', 'Maadi Branch')
                 ->assertJsonPath('data.badge', 'Outdoor Patio')
                 ->assertJsonPath('data.status', 'open');

        $this->assertDatabaseHas('store_locations', [
            'name' => 'Maadi Branch',
            'address' => 'Road 9, Maadi, Cairo',
            'status' => 'open',
        ]);
    }

    public function test_admin_can_update_a_store_location()
    {
        $user = User::factory()->create(['role' => 'admin']);
        $loc = StoreLocation::create([
            'name' => 'Old Branch',
            'address' => 'Old Address',
            'opening_time' => '09:00',
            'closing_time' => '22:00',
            'phone' => '123456',
            'google_maps_url' => 'https://maps.google.com',
            'status' => 'open',
        ]);

        $response = $this->actingAs($user)->putJson("/admin/store-locations/{$loc->id}", [
            'name' => 'Updated Branch Name',
            'status' => 'closed',
        ]);

        $response->assertStatus(200)
                 ->assertJsonPath('data.name', 'Updated Branch Name')
                 ->assertJsonPath('data.status', 'closed');

        $this->assertDatabaseHas('store_locations', [
            'id' => $loc->id,
            'name' => 'Updated Branch Name',
            'status' => 'closed',
        ]);
    }

    public function test_admin_can_delete_a_store_location()
    {
        $user = User::factory()->create(['role' => 'admin']);
        $loc = StoreLocation::create([
            'name' => 'Temp Branch',
            'address' => 'Temp Address',
            'opening_time' => '09:00',
            'closing_time' => '22:00',
            'phone' => '123456',
            'google_maps_url' => 'https://maps.google.com',
            'status' => 'open',
        ]);

        $response = $this->actingAs($user)->deleteJson("/admin/store-locations/{$loc->id}");

        $response->assertStatus(200);
        $this->assertDatabaseMissing('store_locations', ['id' => $loc->id]);
    }
}
