<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\Client;
use Illuminate\Support\Facades\Auth;

class InvoiceController extends Controller
{
    /**
     * Lista faktur zalogowanego klienta.
     */
    public function index()
    {
        // Zakładamy, że model User ma relację z modelem Client lub szukamy po user_id
        // Pobieramy faktury tylko dla zalogowanego użytkownika
        $invoices = Invoice::whereHas('client', function($query) {
            $query->where('user_id', Auth::id());
        })->latest()->get();

        // Pobieramy dane klienta do nagłówka widoku
        $client = Client::where('user_id', Auth::id())->first();

        return view('client.invoices.index', [
            'invoices' => $invoices,
            'client' => $client
        ]);
    }

    /**
     * Szczegóły konkretnej faktury (z zabezpieczeniem).
     */
    public function show(Invoice $invoice)
    {
        // Zabezpieczenie: Klient nie może podejrzeć faktury kogoś innego
        $client = Client::where('user_id', Auth::id())->first();
        
        if ($invoice->client_id !== $client->id) {
            abort(403, 'Nie masz uprawnień do wyświetlenia tej faktury.');
        }

        return view('client.invoices.show', [
            'invoice' => $invoice->load('items.package')
        ]);
    }
}