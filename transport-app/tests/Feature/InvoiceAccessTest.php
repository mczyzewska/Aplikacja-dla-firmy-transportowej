<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class InvoiceAccessTest extends TestCase
{
    use RefreshDatabase;

    public function test_invoice_page_is_accessible()
    {
        $user = User::create([
            'name' => 'Firma Testowa',
            'email' => 'finanse@test.pl',
            'password' => bcrypt('password'),
            'role' => 'client',
        ]);

        $response = $this->actingAs($user)->get('/client/invoices');

        $response->assertStatus(200);
    }
}