<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RoleAccessTest extends TestCase
{
    use RefreshDatabase;

    public function test_client_cannot_access_admin_panel()
    {
        $client = User::create([
            'name' => 'Zwykły Klient',
            'email' => 'klient@transport.pl',
            'password' => bcrypt('password'),
            'role' => 'client',
        ]);

        // Próba wejścia do kontrolera Warehouse (Admin)
        $response = $this->actingAs($client)->get('/admin/warehouses');
        
        // Oczekujemy błędu 403 (brak dostępu)
        $response->assertStatus(403);
    }
}