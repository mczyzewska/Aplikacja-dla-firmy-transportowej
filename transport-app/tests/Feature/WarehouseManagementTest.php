<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class WarehouseManagementTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_add_warehouse()
{
    $this->withoutMiddleware();
    $admin = User::factory()->create(['role' => 'admin']);

    $response = $this->actingAs($admin)->post(route('admin.warehouses.store'), [
        'name' => 'Magazyn Centralny',
        'location' => 'ul. Logistyczna 1', // Poprawiono z 'address' na 'location'
        'is_main' => 1,
    ]);

    $response->assertSessionHasNoErrors();
    $response->assertStatus(302);
    $response->assertRedirect(route('admin.warehouses.index'));

    $this->assertDatabaseHas('warehouses', [
        'name' => 'Magazyn Centralny',
        'location' => 'ul. Logistyczna 1'
    ]);
}
}