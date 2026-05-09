<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Client;
use App\Models\Courier;
use App\Models\Warehouse;
use App\Models\PickupPoint;

class PackageFactory extends Factory
{
    public function definition(): array
    {
        return [
            'client_id' => Client::factory(),
            'courier_id' => Courier::factory(),
            'warehouse_id' => Warehouse::factory(),
            'pickup_point_id' => PickupPoint::factory(), // Dodano to pole
            'tracking_number' => 'TRK' . $this->faker->unique()->numberBetween(100000, 999999),
            'weight' => $this->faker->numberBetween(1, 20),
            'description' => $this->faker->sentence(),
            'status' => $this->faker->randomElement(['odebrana', 'w_transporcie', 'w_punkcie', 'dostarczona']),
        ];
    }
}