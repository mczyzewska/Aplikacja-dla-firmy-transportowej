<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProfileUpdateTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_update_profile_with_client_data()
    {
        $this->withoutMiddleware();

        $user = User::factory()->create([
            'name' => 'Stary Profil',
            'role' => 'client',
        ]);

        $response = $this->actingAs($user)->patch(route('profile.update'), [
            'name' => 'Nowa Firma',
            'email' => $user->email,
            'nip' => '1234567890',
            'phone' => '123123123',
            'address' => 'ul. Testowa 5',
        ]);

        $response->assertStatus(302);
        
        // Sprawdzamy, czy imię faktycznie się zmieniło w bazie
        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'name' => 'Nowa Firma'
        ]);
    }
}