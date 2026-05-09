<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Client;

class ClientSeeder extends Seeder
{
    public function run(): void
    {
        // Pobieramy wszystkich użytkowników, którzy mają rolę 'client'
        $users = User::where('role', 'client')->get();

        foreach ($users as $user) {
            // Dla każdego użytkownika tworzymy profil klienta
            Client::create([
                'user_id' => $user->id,
                'phone'   => fake()->phoneNumber(),
                'nip'     => fake()->taxpayerIdentificationNumber(),
                'address' => fake()->address(),
            ]);
        }
    }
}