<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
{
    // 1. Walidacja z DODANYMI komunikatami (to naprawi brak informacji)
    $request->validate([
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        'password' => ['required', 'confirmed', 'min:8'],
    ], [
        // Tutaj definiujemy polskie napisy dla błędów
        'required' => 'To pole musi zostać uzupełnione.',
        'password.min' => 'Hasło jest za krótkie – musi mieć co najmniej 8 znaków.',
        'password.confirmed' => 'Hasła w obu polach muszą być identyczne.',
        'email.unique' => 'Ten adres e-mail jest już zajęty.',
    ]);

    // 2. Tworzenie użytkownika z szyfrowaniem (Hash::make)
    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password), // DODANO SZYFROWANIE
        'role' => 'client',
    ]);

    event(new Registered($user));
    Auth::login($user);

    return redirect()->route('dashboard');
}
}
