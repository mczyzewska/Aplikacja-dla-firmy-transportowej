<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\Client;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function update(Request $request, Invoice $invoice)
    {
        $validated = $request->validate([
            'client_id'  => 'required|exists:clients,id',
            'issue_date' => 'required|date',
            'due_date'   => 'required|date|after_or_equal:issue_date',
            'status'     => 'required|string',
        ], [
            // Polskie komunikaty błędów
            'client_id.required'     => 'Musisz wybrać klienta, dla którego wystawiana jest faktura.',
            'client_id.exists'       => 'Wybrany klient nie widnieje w naszej bazie danych.',
            
            'issue_date.required'    => 'Data wystawienia faktury jest wymagana.',
            'issue_date.date'        => 'Wprowadź poprawną datę wystawienia.',
            
            'due_date.required'      => 'Termin płatności musi zostać uzupełniony.',
            'due_date.date'          => 'Wprowadź poprawną datę terminu płatności.',
            'due_date.after_or_equal' => 'Termin płatności nie może być datą wcześniejszą niż data wystawienia faktury.',
            
            'status.required'        => 'Status płatności (np. opłacona/nieopłacona) musi zostać wybrany.',
            'status.string'          => 'Nieprawidłowy format statusu.',
        ]);

        $invoice->update($validated);

        // ZMIANA: Dodano admin. przed invoices.index dla spójności z Twoim web.php
        return redirect()
            ->route('admin.invoices.index')
            ->with('success', 'Dane faktury zostały pomyślnie zaktualizowane.');
    }
}