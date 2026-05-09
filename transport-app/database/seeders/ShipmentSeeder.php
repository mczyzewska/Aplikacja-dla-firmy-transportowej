<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Shipment;
use App\Models\Package;
use App\Models\PickupPoint;

class ShipmentSeeder extends Seeder
{
    public function run(): void
    {
        $pickup = PickupPoint::first();

        foreach (Package::all() as $package) {
            Shipment::create([
                'package_id' => $package->id,
                'pickup_point_id' => $pickup->id,
                'departure_date' => now()->subDays(rand(1,5)),
                'arrival_date' => null,
                'transport_method' => 'truck'
            ]);
        }
    }
}
