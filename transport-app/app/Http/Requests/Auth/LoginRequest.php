<?php

namespace App\Http\Requests\Auth;

use Illuminate\Auth\Events\Lockout;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class LoginRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * DODANO: Polskie dymki dla pól e-mail i hasło
     */
    public function messages(): array
    {
        return [
            'email.required' => 'To pole musi zostać uzupełnione.',
            'email.email' => 'Wprowadź poprawny adres e-mail.',
            'password.required' => 'To pole musi zostać uzupełnione.',
        ];
    }

    public function rules(): array
    {
        return [
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ];
    }

    /**
     * Naprawa komunikatu "auth.failed"
     */
    public function authenticate(): void
    {
        $this->ensureIsNotRateLimited();

        if (! Auth::attempt($this->only('email', 'password'), $this->boolean('remember'))) {
            RateLimiter::hit($this->throttleKey());

            throw ValidationException::withMessages([
                // ZAMIEŃ TO: 'email' => trans('auth.failed'),
                'email' => 'Błędny adres e-mail lub hasło.', 
            ]);
        }

        RateLimiter::clear($this->throttleKey());
    }

    /**
     * Naprawa komunikatu o blokadzie (throttle)
     */
    public function ensureIsNotRateLimited(): void
    {
        if (! RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        event(new Lockout($this));

        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw ValidationException::withMessages([
            // ZAMIEŃ TO: 'email' => trans('auth.throttle', [...]),
            'email' => "Zbyt wiele prób logowania. Spróbuj ponownie za $seconds sekund.",
        ]);
    }

    public function throttleKey(): string
    {
        return Str::transliterate(Str::lower($this->string('email')).'|'.$this->ip());
    }
}