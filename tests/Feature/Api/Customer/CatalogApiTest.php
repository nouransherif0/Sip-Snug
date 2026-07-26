<?php

namespace Tests\Feature\Api\Customer;

use App\Models\Category;
use App\Models\Product;
use App\Models\Subcategory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CatalogApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_get_all_categories()
    {
        Category::factory()->count(3)->create();

        $response = $this->getJson('/categories');

        $response->assertStatus(200)
                 ->assertJsonCount(3, 'data');
    }

    public function test_can_get_category_by_id()
    {
        $category = Category::factory()->create();

        $response = $this->getJson("/categories/{$category->id}");

        $response->assertStatus(200)
                 ->assertJsonPath('data.id', $category->id);
    }

    public function test_can_get_subcategories_by_category()
    {
        $category = Category::factory()->create();
        Subcategory::factory()->count(2)->create(['category_id' => $category->id]);

        $response = $this->getJson("/subcategories?category_id={$category->id}");

        $response->assertStatus(200)
                 ->assertJsonCount(2, 'data');
    }

    public function test_can_get_all_products()
    {
        Product::factory()->count(4)->create();

        $response = $this->getJson('/products');

        $response->assertStatus(200)
                 ->assertJsonCount(4, 'data');
    }

    public function test_can_get_product_by_id()
    {
        $product = Product::factory()->create();

        $response = $this->getJson("/products/{$product->id}");

        $response->assertStatus(200)
                 ->assertJsonPath('data.id', $product->id);
    }
}
