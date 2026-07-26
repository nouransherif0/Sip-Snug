<?php

namespace Tests\Feature\Api\Admin;

use App\Models\Category;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminCategoryApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_get_all_categories()
    {
        $user = User::factory()->create(['role' => 'admin']);
        Category::factory()->count(3)->create();

        $response = $this->actingAs($user)->getJson('/admin/categories');

        $response->assertStatus(200)
                 ->assertJsonCount(3, 'data');
    }

    public function test_admin_can_create_a_category()
    {
        $user = User::factory()->create(['role' => 'admin']);
        Storage::fake('public');
        $file = \Illuminate\Http\UploadedFile::fake()->create('category.jpg', 100, 'image/jpeg');

        $response = $this->actingAs($user)->postJson('/admin/categories', [
            'name' => 'New Category',
            'image' => $file,
        ]);

        $response->assertStatus(201)
                 ->assertJsonPath('data.name', 'New Category');

        $this->assertDatabaseHas('categories', ['name' => 'New Category']);
    }

    public function test_admin_can_update_a_category()
    {
        $user = User::factory()->create(['role' => 'admin']);
        $category = Category::factory()->create(['name' => 'Old Name']);

        $response = $this->actingAs($user)->putJson("/admin/categories/{$category->id}", [
            'name' => 'Updated Name',
        ]);

        $response->assertStatus(200)
                 ->assertJsonPath('data.name', 'Updated Name');

        $this->assertDatabaseHas('categories', ['name' => 'Updated Name']);
    }

    public function test_admin_can_delete_a_category()
    {
        $user = User::factory()->create(['role' => 'admin']);
        $category = Category::factory()->create();

        $response = $this->actingAs($user)->deleteJson("/admin/categories/{$category->id}");

        $response->assertStatus(200);
        $this->assertDatabaseMissing('categories', ['id' => $category->id]);
    }
}
