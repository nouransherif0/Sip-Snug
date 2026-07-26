<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ApiEndpointsTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test products API returns a successful response.
     */
    public function test_products_api_returns_success(): void
    {
        $response = $this->getJson('/api/v1/products');
        $response->assertStatus(200);
    }

    /**
     * Test categories API returns a successful response.
     */
    public function test_categories_api_returns_success(): void
    {
        $response = $this->getJson('/api/v1/categories');
        $response->assertStatus(200);
    }

    /**
     * Test subcategories API returns a successful response.
     */
    public function test_subcategories_api_returns_success(): void
    {
        $category = \App\Models\Category::factory()->create();
        $response = $this->getJson('/api/v1/subcategories?category_id=' . $category->id);
        $response->assertStatus(200);
    }

    /**
     * Test add-ons API returns a successful response.
     */
    public function test_addons_api_returns_success(): void
    {
        $response = $this->getJson('/api/v1/add-ons');
        $response->assertStatus(200);
    }

    /**
     * Test delivery zones API returns a successful response.
     */
    public function test_delivery_zones_api_returns_success(): void
    {
        $response = $this->getJson('/api/v1/delivery-zones');
        $response->assertStatus(200);
    }
}
