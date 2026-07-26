<?php

namespace Tests\Feature\Api\Admin;

use App\Models\Category;
use App\Models\Subcategory;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminSubcategoryApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_create_a_subcategory()
    {
        $user = User::factory()->create(['role' => 'admin']);
        $category = Category::factory()->create();

        \Illuminate\Support\Facades\Storage::fake('public');
        $file = \Illuminate\Http\UploadedFile::fake()->create('subcat.jpg', 100, 'image/jpeg');

        $response = $this->actingAs($user)->postJson('/admin/subcategories', [
            'category_id' => $category->id,
            'name' => 'New Subcategory',
            'image' => $file,
        ]);

        $response->assertStatus(201)
                 ->assertJsonPath('data.name', 'New Subcategory');

        $this->assertDatabaseHas('subcategories', ['name' => 'New Subcategory']);
    }

    public function test_admin_can_update_a_subcategory()
    {
        $user = User::factory()->create(['role' => 'admin']);
        $subcategory = Subcategory::factory()->create();
        $newCategory = Category::factory()->create();

        $response = $this->actingAs($user)->putJson("/admin/subcategories/{$subcategory->id}", [
            'category_id' => $newCategory->id,
            'name' => 'Updated Subcategory',
        ]);

        $response->assertStatus(200)
                 ->assertJsonPath('data.name', 'Updated Subcategory');

        $this->assertDatabaseHas('subcategories', ['name' => 'Updated Subcategory']);
    }

    public function test_admin_can_delete_a_subcategory()
    {
        $user = User::factory()->create(['role' => 'admin']);
        $subcategory = Subcategory::factory()->create();

        $response = $this->actingAs($user)->deleteJson("/admin/subcategories/{$subcategory->id}");

        $response->assertStatus(200);
        $this->assertDatabaseMissing('subcategories', ['id' => $subcategory->id]);
    }
}
