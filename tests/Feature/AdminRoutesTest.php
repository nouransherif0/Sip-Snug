<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminRoutesTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test admin dashboard redirects guests to login.
     */
    public function test_admin_dashboard_redirects_guests(): void
    {
        $response = $this->get('/admin');
        $response->assertRedirect('/login');
    }

    /**
     * Test admin dashboard forbids regular customers.
     */
    public function test_admin_dashboard_forbids_customers(): void
    {
        $user = User::factory()->create(['role' => 'customer']);

        $response = $this->actingAs($user)->get('/admin');
        // Admin middleware typically returns 403 Forbidden or redirects
        // Depending on implementation. Let's assert it is not 200.
        $this->assertNotEquals(200, $response->status());
    }

    /**
     * Test an authenticated admin can access the admin dashboard.
     */
    public function test_admin_can_access_dashboard(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);

        $response = $this->actingAs($admin)->get('/admin');
        $response->assertStatus(200);
    }
}
