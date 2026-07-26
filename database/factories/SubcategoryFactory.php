<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class SubcategoryFactory extends Factory
{
    public function definition(): array
    {
        return [
            'category_id' => Category::factory(),
            'name' => $this->faker->words(2, true),
            'image' => $this->faker->randomElement([
                'front/photos/coffee/coffee cate.jpg',
                'front/photos/coffee/esspresso.jpg',
                'front/photos/coffee/hot amrecano.jpg',
                'front/photos/coffee/hot coffee category .jpg',
                'front/photos/coffee/hot dark mocha.jpg',
                'front/photos/coffee/hot latte.jpg',
                'front/photos/coffee/iced amrecano.jpg',
                'front/photos/coffee/iced coffee category .jpg',
                'front/photos/coffee/iced cold brew.jpg',
                'front/photos/coffee/iced dark mocha.jpg',
                'front/photos/coffee/iced latte.jpg'
            ]),
        ];
    }
}
