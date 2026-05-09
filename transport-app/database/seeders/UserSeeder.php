<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Tworzymy 5 Pracowników
        User::factory()->count(5)->create([
            'role' => 'employee',
        ]);

        // Tworzymy 15 Klientów (same konta w tabeli users)
        User::factory()->count(15)->create([
            'role' => 'client',
        ]);
    }
}