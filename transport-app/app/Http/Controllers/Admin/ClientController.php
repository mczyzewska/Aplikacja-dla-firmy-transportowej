<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index()
    {
        return view('admin.clients.index', [
            'clients' => Client::all()
        ]);
    }

    public function create()
    {
        return view('admin.clients.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email|unique:clients,email',
            'phone'   => 'required|string|max:20',
            'address' => 'required|string',
            'nip'     => 'nullable|string|max:20'
        ], [
            // Polskie komunikaty błędów
            'name.required'    => 'Imię i nazwisko lub nazwa firmy musi zostać uzupełniona.',
            'email.required'   => 'Adres e-mail jest wymagany do kontaktu i logowania.',
            'email.email'      => 'Wprowadź poprawny format adresu e-mail (np. nazwa@domena.pl).',
            'email.unique'     => 'Ten adres e-mail jest już przypisany do innego klienta.',
            'phone.required'   => 'Numer telefonu jest niezbędny dla kuriera.',
            'address.required' => 'Adres dostawy/siedziby musi zostać uzupełniony.',
            'nip.max'          => 'Numer NIP nie może być dłuższy niż 20 znaków.',
            'string'           => 'To pole musi zawierać tekst.',
        ]);

        Client::create($validated);

        return redirect()->route('admin.clients.index')
            ->with('success', 'Klient został pomyślnie dodany do systemu.');
    }

    public function edit(Client $client)
    {
        return view('admin.clients.edit', compact('client'));
    }

    public function update(Request $request, Client $client)
    {
        $validated = $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email|unique:clients,email,' . $client->id,
            'phone'   => 'required|string|max:20',
            'address' => 'required|string',
            'nip'     => 'nullable|string|max:20'
        ], [
            // Polskie komunikaty błędów przy edycji
            'required' => 'To pole musi zostać uzupełnione.',
            'email'    => 'Wprowadź poprawny adres e-mail.',
            'unique'   => 'Ten adres e-mail jest już zajęty przez innego klienta.',
            'max'      => 'Przekroczono maksymalną liczbę znaków dla tego pola.',
        ]);

        $client->update($validated);

        return redirect()->route('admin.clients.index')
            ->with('success', 'Dane klienta zostały zaktualizowane.');
    }

    public function destroy(Client $client)
    {
        $client->delete();
        return back()->with('success', 'Klient został usunięty z bazy danych.');
    }

    public function show(Client $client)
{
    // Ładujemy dane użytkownika oraz faktury klienta od najnowszych
    $client->load(['user', 'invoices' => function($query) {
        $query->latest();
    }]);

    return view('admin.clients.show', compact('client'));
}
}