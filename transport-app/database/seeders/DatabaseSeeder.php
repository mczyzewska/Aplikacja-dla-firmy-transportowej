<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            UserSeeder::class,      // Najpierw tworzymy użytkowników (w tym role 'client')
            ClientSeeder::class,    // Potem dopisujemy im dane NIP/adres
            CourierSeeder::class,
            WarehouseSeeder::class,
            PickupPointSeeder::class,
            PackageSeeder::class,   // Paczki na końcu, bo potrzebują klientów i punktów
            PackageStatusSeeder::class,
            InvoiceSeeder::class,
        ]);
    }
}