<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\DeliveryZone;
use Illuminate\Database\Eloquent\Factories\Factory;

class AddressFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'delivery_zone_id' => DeliveryZone::factory(),
            'street' => $this->faker->streetAddress(),
            'building_number' => $this->faker->buildingNumber(),
            'phone_number' => $this->faker->phoneNumber(),
            'label' => $this->faker->word(),
            'floor' => $this->faker->randomDigitNotNull(),
            'apartment' => $this->faker->randomDigitNotNull(),
            'landmark' => $this->faker->word(),
            'is_default' => false,
        ];
    }
}
