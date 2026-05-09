<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PackageLogicTest extends TestCase
{
    use RefreshDatabase;

    public function test_client_can_see_their_packages()
    {
        $user = User::create([
            'name' => 'Jan Testowy',
            'email' => 'jan@test.pl',
            'password' => bcrypt('password'),
            'role' => 'client',
        ]);

        // POPRAWKA: Używamy nazwy trasy z Twojego web.php
        $response = $this->actingAs($user)->get(route('packages.my'));

        $response->assertStatus(200);
    }
}