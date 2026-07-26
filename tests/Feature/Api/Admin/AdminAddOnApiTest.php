<?php

namespace Tests\Feature\Api\Admin;

use App\Models\AddOn;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminAddOnApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_get_all_add_ons()
    {
        $user = User::factory()->create(['role' => 'admin']);
        AddOn::factory()->count(3)->create();

        $response = $this->actingAs($user)->getJson('/admin/add-ons');

        $response->assertStatus(200)
                 ->assertJsonCount(3, 'data');
    }

    public function test_admin_can_create_an_add_on()
    {
        $user = User::factory()->create(['role' => 'admin']);

        $response = $this->actingAs($user)->postJson('/admin/add-ons', [
            'name' => 'Extra Cheese',
            'price_adjustment' => 1.50,
        ]);

        $response->assertStatus(201)
                 ->assertJsonPath('data.name', 'Extra Cheese')
                 ->assertJsonPath('data.price_adjustment', '1.50');

        $this->assertDatabaseHas('add_ons', ['name' => 'Extra Cheese', 'price_adjustment' => 1.50]);
    }

    public function test_admin_cannot_create_an_add_on_with_invalid_data()
    {
        $user = User::factory()->create(['role' => 'admin']);

        $response = $this->actingAs($user)->postJson('/admin/add-ons', [
            'name' => '', // Invalid name
            'price_adjustment' => -5, // Invalid price (min 0)
        ]);

        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['name', 'price_adjustment']);
    }

    public function test_admin_can_update_an_add_on()
    {
        $user = User::factory()->create(['role' => 'admin']);
        $addOn = AddOn::factory()->create(['name' => 'Old Name', 'price_adjustment' => 1.00]);

        $response = $this->actingAs($user)->putJson("/admin/add-ons/{$addOn->id}", [
            'name' => 'Updated Name',
            'price_adjustment' => 2.50,
        ]);

        $response->assertStatus(200)
                 ->assertJsonPath('data.name', 'Updated Name')
                 ->assertJsonPath('data.price_adjustment', '2.50');

        $this->assertDatabaseHas('add_ons', ['name' => 'Updated Name', 'price_adjustment' => 2.50]);
    }

    public function test_admin_can_delete_an_add_on()
    {
        $user = User::factory()->create(['role' => 'admin']);
        $addOn = AddOn::factory()->create();

        $response = $this->actingAs($user)->deleteJson("/admin/add-ons/{$addOn->id}");

        $response->assertStatus(200);
        $this->assertDatabaseMissing('add_ons', ['id' => $addOn->id]);
    }
<<<<<<< HEAD
=======

    public function test_admin_can_create_scoped_add_on()
    {
        $user = User::factory()->create(['role' => 'admin']);
        $category = \App\Models\Category::factory()->create();

        $response = $this->actingAs($user)->postJson('/admin/add-ons', [
            'name' => 'Category Syrup',
            'price_adjustment' => 5.00,
            'scope' => 'category',
            'category_id' => $category->id,
        ]);

        $response->assertStatus(201)
                 ->assertJsonPath('data.name', 'Category Syrup')
                 ->assertJsonPath('data.scope', 'category')
                 ->assertJsonPath('data.category_id', $category->id);

        $this->assertDatabaseHas('add_ons', [
            'name' => 'Category Syrup',
            'scope' => 'category',
            'category_id' => $category->id,
        ]);
    }

    public function test_add_on_for_product_filtering()
    {
        $category = \App\Models\Category::factory()->create();
        $otherCategory = \App\Models\Category::factory()->create();
        $subcategory = \App\Models\Subcategory::factory()->create(['category_id' => $category->id]);
        $product = \App\Models\Product::factory()->create(['subcategory_id' => $subcategory->id]);

        $globalAddon = AddOn::factory()->create(['scope' => 'global']);
        $categoryAddon = AddOn::factory()->create(['scope' => 'category', 'category_id' => $category->id]);
        $otherCategoryAddon = AddOn::factory()->create(['scope' => 'category', 'category_id' => $otherCategory->id]);
        $productAddon = AddOn::factory()->create(['scope' => 'product', 'product_id' => $product->id]);

        $applicable = AddOn::forProduct($product);

        $this->assertTrue($applicable->contains($globalAddon));
        $this->assertTrue($applicable->contains($categoryAddon));
        $this->assertTrue($applicable->contains($productAddon));
        $this->assertFalse($applicable->contains($otherCategoryAddon));
    }

    public function test_admin_can_create_multi_select_scoped_add_on()
    {
        $user = User::factory()->create(['role' => 'admin']);
        $cat1 = \App\Models\Category::factory()->create();
        $cat2 = \App\Models\Category::factory()->create();

        $response = $this->actingAs($user)->postJson('/admin/add-ons', [
            'name' => 'Multi Cat Syrup',
            'price_adjustment' => 3.00,
            'scope' => 'category',
            'category_ids' => [$cat1->id, $cat2->id],
        ]);

        $response->assertStatus(201)
                 ->assertJsonPath('data.name', 'Multi Cat Syrup')
                 ->assertJsonPath('data.scope', 'category');

        $this->assertDatabaseHas('addon_category', ['category_id' => $cat1->id]);
        $this->assertDatabaseHas('addon_category', ['category_id' => $cat2->id]);
    }
>>>>>>> 243a993cfb520c2a7a67eb35395e0e8a4216dc64
}
