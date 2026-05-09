<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Invoice;
use App\Models\Package;

class InvoiceItemFactory extends Factory
{
    public function definition(): array
    {
        return [
            'invoice_id' => Invoice::inRandomOrder()->first()?->id ?? Invoice::factory(),
            'package_id' => Package::inRandomOrder()->first()?->id ?? Package::factory(),
            'price' => $this->faker->numberBetween(30, 90),
            'quantity' => 1,
        ];
    }
}
