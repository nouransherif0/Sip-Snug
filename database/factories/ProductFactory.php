<?php

namespace Database\Factories;

use App\Models\Subcategory;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    public function definition(): array
    {
        return [
            'subcategory_id' => Subcategory::factory(),
            'name' => $this->faker->words(3, true),
            'description' => $this->faker->sentence(),
            'price' => $this->faker->randomFloat(2, 90, 200),
            'stock' => $this->faker->numberBetween(10, 100),
            'image' => $this->faker->imageUrl(),
        ];
    }
}
