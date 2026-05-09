<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Courier;

class CourierSeeder extends Seeder
{
    public function run(): void
    {
        $drivers = [
            ['name' => 'Robert Mazurek', 'vehicle_number' => 'GD 8877A', 'phone' => '601-200-300'],
            ['name' => 'Janusz Pawlak', 'vehicle_number' => 'PO 12345', 'phone' => '722-444-555'],
            ['name' => 'Krzysztof Król', 'vehicle_number' => 'WA 99821', 'phone' => '500-100-200'],
        ];

        foreach ($drivers as $d) {
            Courier::create($d);
        }
    }
}