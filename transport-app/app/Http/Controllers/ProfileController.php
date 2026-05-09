<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Wyświetla formularz profilu wraz z danymi klienta.
     */
    public function edit(Request $request): View
    {
        $request->user()->load('client');

        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Aktualizuje dane użytkownika oraz opcjonalnie dane klienta.
     */
    public function update(Request $request): RedirectResponse
    {
        $user = $request->user();

        // Polska walidacja z niestandardowymi komunikatami
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users,email,' . $user->id],
            'phone' => ['nullable', 'string', 'max:20'],
            'address' => ['nullable', 'string', 'max:255'],
            'nip' => ['nullable', 'string', 'max:15'],
        ], [
            // Niestandardowe komunikaty (Zasada: Zrozumiałość)
            'required' => 'Pole :attribute jest wymagane.',
            'email' => 'Podany adres e-mail jest nieprawidłowy.',
            'unique' => 'Ten :attribute jest już zajęty przez innego użytkownika.',
            'max' => 'Pole :attribute nie może być dłuższe niż :max znaków.',
            'string' => 'Pole :attribute musi być tekstem.',
        ], [
            // Nazwy pól wyświetlane w błędach
            'name' => 'Imię i Nazwisko / Firma',
            'email' => 'Adres E-mail',
            'phone' => 'Numer Telefonu',
            'address' => 'Adres Siedziby',
            'nip' => 'Numer NIP',
        ]);

        // 1. Aktualizacja danych podstawowych
        $user->fill([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        // 2. Aktualizacja danych dodatkowych (tabela clients) - tylko dla roli klient
        if ($user->role === 'client') {
            $user->client()->updateOrCreate(
                ['user_id' => $user->id],
                [
                    'phone' => $request->phone,
                    'address' => $request->address,
                    'nip' => $request->nip,
                ]
            );
        }

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Usuwanie konta (bez zmian).
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ], [
            'password.required' => 'Hasło jest wymagane do usunięcia konta.',
            'current_password' => 'Podane hasło jest nieprawidłowe.'
        ]);

        $user = $request->user();
        Auth::logout();
        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}