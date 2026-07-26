<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class AddOnFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => $this->faker->word(),
            'price_adjustment' => $this->faker->randomFloat(2, 20, 100),
        ];
    }
}
