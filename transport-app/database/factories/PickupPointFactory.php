<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PickupPointFactory extends Factory
{
    public function definition(): array
    {
        return [
            // Przykładowe nazwy: Punkt Paczka - Gdynia, itp.
            'name' => 'Punkt ' . $this->faker->company() . ' - ' . $this->faker->city(),
            'location' => $this->faker->address(),
        ];
    }
}