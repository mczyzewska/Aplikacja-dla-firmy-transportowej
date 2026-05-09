<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class WarehouseFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => 'Main Warehouse',
            'location' => $this->faker->city(),
            'is_main' => true,
        ];
    }
}
