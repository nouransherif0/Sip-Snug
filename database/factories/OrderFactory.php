<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Address;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'address_id' => Address::factory(),
            'status' => $this->faker->randomElement(['pending', 'confirmed', 'preparing', 'out_for_delivery', 'delivered', 'cancelled']),
            'total_price' => $this->faker->randomFloat(2, 100, 1500),
            'delivery_fee' => $this->faker->randomFloat(2, 20, 100),
            'payment_method' => $this->faker->randomElement(['cash', 'credit_card']),
        ];
    }
}
