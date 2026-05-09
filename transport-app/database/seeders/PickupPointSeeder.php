<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PickupPoint;

class PickupPointSeeder extends Seeder
{
    public function run(): void
    {
        // Dane dostosowane do modelu logistyki Polska -> Norwegia
        $points = [
            [
                'code' => 'NO-OSL-01',
                'city' => 'Oslo',
                'address' => 'Karl Johans gate 1',
                'country' => 'Norwegia'
            ],
            [
                'code' => 'NO-BGO-02',
                'city' => 'Bergen',
                'address' => 'Strømgaten 4',
                'country' => 'Norwegia'
            ],
            [
                'code' => 'NO-TRD-03',
                'city' => 'Trondheim',
                'address' => 'Kongens gate 2',
                'country' => 'Norwegia'
            ],
            [
                'code' => 'NO-SVG-04',
                'city' => 'Stavanger',
                'address' => 'Linstowsgate 3',
                'country' => 'Norwegia'
            ],
            [
                'code' => 'NO-DRM-05',
                'city' => 'Drammen',
                'address' => 'Grønland 1',
                'country' => 'Norwegia'
            ],
        ];

        foreach ($points as $point) {
            // updateOrCreate zapobiega duplikatom przy ponownym uruchomieniu
            PickupPoint::updateOrCreate(
                ['code' => $point['code']], 
                $point
            );
        }
    }
}