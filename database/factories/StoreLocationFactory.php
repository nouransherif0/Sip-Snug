<?php

namespace Database\Factories;

use App\Models\StoreLocation;
use Illuminate\Database\Eloquent\Factories\Factory;

class StoreLocationFactory extends Factory
{
    protected $model = StoreLocation::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->city() . ' Branch',
            'badge' => $this->faker->randomElement(['Flagship Store', 'Co-Working Friendly', 'Garden Seating', null]),
            'address' => $this->faker->address(),
            'working_hours' => 'Daily: 08:00 AM - 11:00 PM',
            'phone' => '+20 ' . $this->faker->phoneNumber(),
            'google_maps_url' => 'https://maps.google.com',
            'is_active' => true,
        ];
    }
}
