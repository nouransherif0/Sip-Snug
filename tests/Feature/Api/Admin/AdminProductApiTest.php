<?php

namespace Tests\Feature\Api\Admin;

use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use App\Models\Subcategory;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminProductApiTest extends TestCase
{
    use RefreshDatabase;



    public function test_admin_can_create_a_product()
    {
        $user = User::factory()->create(['role' => 'admin']);
        $subcategory = Subcategory::factory()->create();

        Storage::fake('public');
        $file = \Illuminate\Http\UploadedFile::fake()->create('product.jpg', 100, 'image/jpeg');

        $response = $this->actingAs($user)->postJson('/admin/products', [
            'subcategory_id' => $subcategory->id,
            'name' => 'New Product',
            'description' => 'A nice product',
            'price' => 100.50,
            'stock' => 50,
            'image' => $file,
        ]);

        $response->assertStatus(201)
                 ->assertJsonPath('data.name', 'New Product');

        $this->assertDatabaseHas('products', ['name' => 'New Product']);
    }

    public function test_admin_can_update_a_product()
    {
        $user = User::factory()->create(['role' => 'admin']);
        $product = Product::factory()->create(['name' => 'Old Product']);

        $response = $this->actingAs($user)->putJson("/admin/products/{$product->id}", [
            'subcategory_id' => $product->subcategory_id,
            'name' => 'Updated Product',
            'description' => 'Updated description',
            'price' => 200,
            'stock' => 10,
        ]);

        $response->assertStatus(200)
                 ->assertJsonPath('data.name', 'Updated Product');

        $this->assertDatabaseHas('products', ['name' => 'Updated Product']);
    }

    public function test_admin_can_delete_a_product()
    {
        $user = User::factory()->create(['role' => 'admin']);
        $product = Product::factory()->create();

        $response = $this->actingAs($user)->deleteJson("/admin/products/{$product->id}");

        $response->assertStatus(200);
        $this->assertDatabaseMissing('products', ['id' => $product->id]);
    }
}
