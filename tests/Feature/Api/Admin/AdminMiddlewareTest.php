<?php

namespace Tests\Feature\Api\Admin;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminMiddlewareTest extends TestCase
{
    use RefreshDatabase;

    public function test_regular_user_cannot_access_admin_routes()
    {
        $user = User::factory()->create(['role' => 'customer']);

        $response = $this->actingAs($user)->getJson('/admin/orders');
        
        $response->assertStatus(403)
                 ->assertJsonPath('message', 'Unauthorized. Admin access required.');
    }
    
    public function test_admin_user_can_access_admin_routes()
    {
        $user = User::factory()->create(['role' => 'admin']);

        $response = $this->actingAs($user)->getJson('/admin/orders');
        
        // As long as it's not 403, it means middleware passed (e.g., 200 OK)
        $response->assertStatus(200);
    }
}
