<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CustomerRoutesTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test the profile page requires authentication.
     */
    public function test_profile_page_redirects_guests_to_login(): void
    {
        $response = $this->get('/profile');
        $response->assertRedirect('/login');
    }

    /**
     * Test the cart page requires authentication.
     */
    public function test_cart_page_redirects_guests_to_login(): void
    {
        $response = $this->get('/cart');
        $response->assertRedirect('/login');
    }

    /**
     * Test the checkout page requires authentication.
     */
    public function test_checkout_page_redirects_guests_to_login(): void
    {
        $response = $this->get('/checkout');
        $response->assertRedirect('/login');
    }

    /**
     * Test an authenticated user can access the profile.
     */
    public function test_authenticated_user_can_access_profile(): void
    {
        $user = User::factory()->create(['role' => 'customer']);

        $response = $this->actingAs($user)->get('/profile');
        $response->assertStatus(200);
    }

    /**
     * Test an authenticated user can access the cart.
     */
    public function test_authenticated_user_can_access_cart(): void
    {
        $user = User::factory()->create(['role' => 'customer']);

        $response = $this->actingAs($user)->get('/cart');
        $response->assertStatus(200);
    }

    /**
     * Test an authenticated user can access checkout.
     */
    public function test_authenticated_user_can_access_checkout(): void
    {
        $user = User::factory()->create(['role' => 'customer']);

        $response = $this->actingAs($user)->get('/checkout');
        $response->assertStatus(200);
    }
}
