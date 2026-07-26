<?php

namespace Tests\Feature\Api\Customer;

use App\Models\AddOn;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AddOnApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_customer_can_get_all_add_ons()
    {
        AddOn::factory()->count(2)->create();

        $response = $this->getJson('/add-ons');

        $response->assertStatus(200)
                 ->assertJsonCount(2, 'data');
    }
}
