<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Invoice;
use App\Models\InvoiceItem;
use App\Models\Package;
use Illuminate\Http\Request;
use Carbon\Carbon;

class InvoiceController extends Controller
{
    public function create(Client $client)
    {
        return view('employee.invoices.create', [
            'client' => $client,
            'packages' => Package::where('client_id', $client->id)->get()
        ]);
    }

    public function store(Request $request)
    {
        $invoice = Invoice::create($request->validate([
            'client_id' => 'required',
            'total_price' => 'required|numeric',
            'issue_date' => 'required|date',
            'due_date' => 'required|date',
            'status' => 'required'
        ]));

        foreach ($request->items as $item) {
            InvoiceItem::create([
                'invoice_id' => $invoice->id,
                'package_id' => $item['package_id'],
                'price' => $item['price'],
                'quantity' => $item['quantity']
            ]);
        }

        return redirect()->route('employee.invoices.index')
            ->with('success', 'Invoice created');
    }
}
