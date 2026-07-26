<?php

namespace Tests\Feature\Api\Customer;

use App\Models\DeliveryZone;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DeliveryZoneApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_customer_can_get_all_delivery_zones()
    {
        DeliveryZone::factory()->count(2)->create();

        $response = $this->getJson('/delivery-zones');

        $response->assertStatus(200)
                 ->assertJsonCount(2, 'data');
    }
}
