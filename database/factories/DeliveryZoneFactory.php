<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class DeliveryZoneFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => $this->faker->city(),
            'delivery_fee' => $this->faker->randomFloat(2, 20, 100),
            'minimum_order_value' => $this->faker->randomFloat(2, 100, 500),
            'estimated_time' => $this->faker->numberBetween(15, 60) . ' mins',
        ];
    }
}
