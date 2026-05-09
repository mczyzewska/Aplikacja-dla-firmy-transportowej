<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Invoice;
use App\Models\InvoiceItem;
use App\Models\Client;
use App\Models\Package;

class InvoiceSeeder extends Seeder
{
    public function run(): void
{
    foreach (Client::all() as $client) {
        // 1. Tworzymy szkielet faktury - DODAJEMY 'nip' => $client->nip
        $invoice = Invoice::create([
            'client_id'   => $client->id,
            'nip'         => $client->nip, // Pobiera NIP z modelu Client i zapisuje w Invoice
            'total_price' => 0,
            'issue_date'  => now(),
            'due_date'    => now()->addDays(14),
            'status'      => 'unpaid'
        ]);

        $packages = Package::where('client_id', $client->id)->take(2)->get();
        $sum = 0;

        foreach ($packages as $package) {
            $itemPrice = rand(30, 90);
            $sum += $itemPrice;

            InvoiceItem::create([
                'invoice_id' => $invoice->id,
                'package_id' => $package->id,
                'price'      => $itemPrice,
            ]);
        }

        // 2. Aktualizacja sumy
        $invoice->update(['total_price' => $sum]);
    }
}
}
