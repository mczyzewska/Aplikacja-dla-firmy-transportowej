<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Package;
use App\Models\Client;
use App\Models\Courier;
use App\Models\Warehouse;
use App\Models\PickupPoint;
use App\Models\PackageStatus;

class PackageSeeder extends Seeder
{
    public function run(): void
    {
        $clients = Client::all();
        $couriers = Courier::all();
        // ZMIANA: Pobieramy wszystkie magazyny, a nie tylko pierwszy
        $warehouses = Warehouse::all(); 
        $points = PickupPoint::all();

        if ($clients->isEmpty() || $couriers->isEmpty() || $points->isEmpty() || $warehouses->isEmpty()) {
            $this->command->error("Brak danych w tabelach pomocniczych!");
            return;
        }

        for ($i = 0; $i < 200; $i++) {
            $status = collect(['odebrana', 'w_transporcie', 'w_punkcie', 'dostarczona'])->random();
            
            $package = Package::create([
                'client_id' => $clients->random()->id,
                'pickup_point_id' => $points->random()->id,
                'courier_id' => $couriers->random()->id,
                // ZMIANA: Losujemy magazyn dla każdej paczki z osobna
                'warehouse_id' => $warehouses->random()->id, 
                'tracking_number' => 'TRK' . (200000 + $i),
                'weight' => rand(1, 20),
                'status' => $status,
            ]);

            PackageStatus::create([
                'package_id' => $package->id,
                'status' => $status,
                'changed_at' => now(),
            ]);
        }
    }
}