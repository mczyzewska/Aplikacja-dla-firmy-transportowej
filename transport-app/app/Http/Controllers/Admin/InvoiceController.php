<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\Client;
use App\Models\Package;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InvoiceController extends Controller
{
    /**
     * Lista wszystkich faktur.
     */
    public function index()
    {
        return view('admin.invoices.index', [
            'invoices' => Invoice::with('client')->latest()->get()
        ]);
    }

    /**
     * METODA CREATE: Rozwiązuje błąd 500 przy tworzeniu
     */
    public function create(Request $request)
{
    $clientId = $request->query('client_id');
    $clients = Client::orderBy('name')->get();

    // Pobieramy paczki tylko jeśli wybrano klienta
    $packages = collect();
    $selectedClient = null;

    if ($clientId) {
        $selectedClient = Client::find($clientId);
        // Pobieramy paczki przypisane TYLKO do tego klienta, które nie mają faktury
        $packages = Package::where('client_id', $clientId)
            ->whereDoesntHave('invoiceItems')
            ->get();
    }

    return view('admin.invoices.create', compact('clients', 'packages', 'selectedClient'));
}

    /**
     * Zapisuje nową fakturę w bazie.
     */
    /**
 * Zapisuje nową fakturę w bazie.
 */
public function store(Request $request)
{
    // 1. Wstępna walidacja podstawowych pól
    $request->validate([
        'client_id'  => 'required|exists:clients,id',
        'nip'        => 'nullable|string|max:20', 
        'issue_date' => 'required|date',
        'due_date'   => 'required|date|after_or_equal:issue_date',
        'status'     => 'required|in:paid,unpaid',
        'items'      => 'required|array',
    ], [
        'client_id.required'  => 'Proszę wybrać klienta z listy.',
        'items.required'      => 'Faktura musi zawierać co najmniej jedną paczkę.',
    ]);

    // 2. FILTROWANIE: Wybieramy tylko te pozycje, które użytkownik zaznaczył (checkbox)
    // i które mają wpisaną cenę.
    $selectedItems = collect($request->items)->filter(function($item) {
        return isset($item['package_id']) && !empty($item['price']);
    });

    // 3. Sprawdzamy czy po odfiltrowaniu mamy co zapisywać
    if ($selectedItems->isEmpty()) {
        return back()->withErrors(['items' => 'Musisz zaznaczyć przynajmniej jedną paczkę i podać jej cenę.'])->withInput();
    }

    // 4. Transakcja DB
    return DB::transaction(function () use ($request, $selectedItems) {
        $client = Client::findOrFail($request->client_id);
        
        // Sumujemy ceny tylko zaznaczonych paczek
        $totalPrice = $selectedItems->sum('price');

        // Tworzymy fakturę
        $invoice = Invoice::create([
            'client_id'   => $request->client_id,
            'nip'         => $request->nip ?? $client->nip,
            'issue_date'  => $request->issue_date,
            'due_date'    => $request->due_date,
            'status'      => $request->status,
            'total_price' => $totalPrice,
        ]);

        // Zapisujemy pozycje (tylko te zaznaczone)
        foreach ($selectedItems as $item) {
            $invoice->items()->create([
                'package_id' => $item['package_id'],
                'price'      => $item['price'],
            ]);
        }

        return redirect()
            ->route('admin.invoices.show', $invoice)
            ->with('success', 'Nowa faktura została pomyślnie wystawiona.');
    });
}

    /**
     * Formularz edycji istniejącej faktury.
     */
    public function edit(Invoice $invoice)
    {
        return view('admin.invoices.edit', [
            'invoice' => $invoice->load('items.package'),
            'clients' => Client::all(),
            // Paczki dostępne do dodania (te bez faktury)
            'availablePackages' => Package::whereDoesntHave('invoiceItems')->get(),
        ]);
    }

    /**
     * Aktualizacja faktury i jej pozycji.
     */
    public function update(Request $request, Invoice $invoice)
    {
        $data = $request->validate([
            'client_id'  => 'required|exists:clients,id',
            'status'     => 'required|in:paid,unpaid',
            'issue_date' => 'required|date',
            'due_date'   => 'required|date|after_or_equal:issue_date',
            'items'      => 'nullable|array',
            'items.*.price' => 'required|numeric|min:0',
            'new_item.package_id' => 'nullable|exists:packages,id',
            'new_item.price'      => 'nullable|numeric|min:0',
            'delete_items'        => 'nullable|array',
        ], [
            'required' => 'To pole musi zostać uzupełnione.',
            'items.*.price.min' => 'Cena nie może być ujemna!',
        ]);

        DB::transaction(function() use ($invoice, $data) {
            // 1. Aktualizacja istniejących pozycji
            if (!empty($data['items'])) {
                foreach ($data['items'] as $itemId => $itemData) {
                    $invoice->items()->where('id', $itemId)->update(['price' => $itemData['price']]);
                }
            }

            // 2. Usuwanie pozycji
            if (!empty($data['delete_items'])) {
                $invoice->items()->whereIn('id', $data['delete_items'])->delete();
            }

            // 3. Dodawanie nowej pozycji
            if (!empty($data['new_item']['package_id']) && isset($data['new_item']['price'])) {
                $invoice->items()->create([
                    'package_id' => $data['new_item']['package_id'],
                    'price'      => $data['new_item']['price'],
                ]);
            }

            // 4. Przeliczenie sumy i aktualizacja nagłówka
            $invoice->update([
                'client_id'   => $data['client_id'],
                'status'      => $data['status'],
                'issue_date'  => $data['issue_date'],
                'due_date'    => $data['due_date'],
                'total_price' => $invoice->items()->sum('price'),
            ]);
        });

        return redirect()->route('admin.invoices.index')->with('success', 'Dane faktury i pozycje zostały zaktualizowane.');
    }

    /**
     * Szczegóły faktury (podgląd).
     */
    public function show(Invoice $invoice)
    {
        return view('admin.invoices.show', [
            'invoice' => $invoice->load('items.package', 'client')
        ]);
    }

    /**
     * Usuwanie faktury.
     */
    public function destroy(Invoice $invoice)
    {
        $invoice->delete();
        return redirect()->route('admin.invoices.index')->with('success', 'Faktura została usunięta.');
    }
}