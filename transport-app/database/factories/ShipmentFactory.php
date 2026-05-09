<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\PickupPoint;
use App\Models\Package;

class ShipmentFactory extends Factory
{
    public function definition(): array
    {
        return [
            'package_id' => Package::inRandomOrder()->first()?->id ?? Package::factory(),
            'pickup_point_id' => PickupPoint::inRandomOrder()->first()?->id ?? PickupPoint::factory(),
            'departure_date' => now()->subDays(rand(1, 5)),
            'arrival_date' => null,
            'transport_method' => 'truck',
        ];
    }
}
