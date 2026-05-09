<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index()
    {
        return view('admin.users.index', [
            'admins' => User::where('role', 'admin')->get(),
            'employees' => User::where('role', 'employee')->get(),
            'clients' => User::where('role', 'client')->with('client')->get(),
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
            'role' => 'required|in:admin,employee,client',
            'phone' => 'nullable|string',
            'nip' => 'nullable|string',
            'address' => 'nullable|string',
        ], [
            // Naprawa błędu ze screena
            'password.min' => 'Hasło musi być solidne – wprowadź co najmniej 8 znaków.',
            'password.required' => 'Nie możesz utworzyć użytkownika bez hasła.',
            
            // Standardowe polskie komunikaty
            'name.required' => 'Imię i nazwisko (lub nazwa użytkownika) jest wymagana.',
            'email.required' => 'Adres e-mail jest niezbędny do logowania.',
            'email.email' => 'Wprowadź poprawny format e-mail.',
            'email.unique' => 'Ten e-mail jest już zajęty przez innego użytkownika.',
            'role.required' => 'Musisz określić rolę (Admin, Pracownik lub Klient).',
            'role.in' => 'Wybrano nieprawidłową rolę użytkownika.',
        ]);

        DB::transaction(function () use ($validated) {
            $user = User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']),
                'role' => $validated['role'],
            ]);

            if ($user->role === 'client') {
                Client::create([
                    'user_id' => $user->id,
                    'phone' => $validated['phone'] ?? null,
                    'nip' => $validated['nip'] ?? null,
                    'address' => $validated['address'] ?? null,
                ]);
            }
        });

        return redirect()->back()->with('success', 'Użytkownik został dodany do systemu.');
    }

    public function edit(User $user)
    {
        $user->load('client');
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'phone' => 'nullable|string',
            'nip' => 'nullable|string',
            'address' => 'nullable|string',
        ], [
            // Uniwersalny komunikat
            'required' => 'To pole musi zostać uzupełnione.',
            'email.unique' => 'Ten e-mail jest już używany przez kogoś innego.',
            'email.email' => 'Format adresu e-mail jest niepoprawny.',
        ]);

        DB::transaction(function () use ($user, $validated) {
            $user->update([
                'name' => $validated['name'],
                'email' => $validated['email'],
            ]);

            if ($user->role === 'client') {
                $user->client()->updateOrCreate(
                    ['user_id' => $user->id],
                    [
                        'phone' => $validated['phone'],
                        'nip' => $validated['nip'],
                        'address' => $validated['address'],
                    ]
                );
            }
        });

        return redirect()->route('admin.users.index')->with('success', 'Dane użytkownika zostały zaktualizowane.');
    }

    public function destroy(User $user)
    {
        if ($user->id === auth()->id()) {
            return redirect()->back()->with('error', 'Bezpieczeństwo: Nie możesz usunąć własnego konta!');
        }
        $user->delete();
        return redirect()->back()->with('success', 'Użytkownik został usunięty z systemu.');
    }
}