<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Client;

class InvoiceFactory extends Factory
{
    public function definition(): array
    {
        return [
            'client_id' => Client::inRandomOrder()->first()?->id ?? Client::factory(),
            'total_price' => $this->faker->numberBetween(100, 500),
            'issue_date' => now(),
            'due_date' => now()->addDays(14),
            'status' => 'unpaid',
        ];
    }
}
