<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Warehouse;

class WarehouseSeeder extends Seeder
{
    public function run(): void
    {
        $warehouses = [
            [
                'name' => 'Magazyn Centralny - Warszawa',
                'city' => 'Warszawa', // DODANO: Tego szuka widok
                'location' => 'Pruszków, ul. Logistyczna 5',
                'is_main' => true
            ],
            [
                'name' => 'Magazyn Poznań',
                'city' => 'Poznań', // DODANO
                'location' => 'Sady k. Poznania, ul. Amerykańska 1',
                'is_main' => false
            ],
            [
                'name' => 'Magazyn Gdynia',
                'city' => 'Gdynia', // DODANO
                'location' => 'Gdynia, ul. Portowa 10',
                'is_main' => false
            ],
            [
                'name' => 'Magazyn Sosnowiec',
                'city' => 'Sosnowiec', // DODANO
                'location' => 'Sosnowiec, ul. Inwestycyjna 2',
                'is_main' => false
            ],
            [
                'name' => 'Magazyn Szczecin',
                'city' => 'Szczecin', // DODANO
                'location' => 'Kołbaskowo 120',
                'is_main' => false
            ],
        ];

        foreach ($warehouses as $w) {
            Warehouse::updateOrCreate(['name' => $w['name']], $w);
        }
    }
}