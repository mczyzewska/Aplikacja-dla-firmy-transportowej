<x-guest-layout>
    <div class="container mx-auto p-6 max-w-xl">
        {{-- Nagłówek systemowy --}}
        <div class="mb-10 border-b-4 border-blue-800 pb-4 text-center">
            <h1 class="text-4xl font-black text-gray-900 uppercase tracking-tighter">
                Rejestracja Profilu
            </h1>
            <p class="text-gray-500 font-bold uppercase text-[10px] tracking-[0.3em] mt-1">
                Utwórz konto w systemie Transport App PL-NO
            </p>
        </div>

        {{-- Karta rejestracji --}}
        <div class="bg-white p-8 rounded-xl shadow-xl border-2 border-gray-100 border-t-[12px] border-t-blue-800">
            
            {{-- 1. KRÓTKIE POWIADOMIENIE O BŁĘDACH (WCAG: role="alert") --}}
            @if ($errors->any())
                <div role="alert" class="mb-8 bg-red-50 border-l-8 border-red-600 p-4 rounded-md shadow-sm">
                    <div class="flex items-center">
                        <span class="text-xl mr-2" aria-hidden="true">⚠️</span>
                        <h3 class="text-red-900 font-black uppercase tracking-tight text-sm">
                            Formularz zawiera błędy. Popraw pola zaznaczone na czerwono.
                        </h3>
                    </div>
                </div>
            @endif

            <form method="POST" action="{{ route('register') }}" class="space-y-6" novalidate>
                @csrf

                {{-- Imię i Nazwisko --}}
                <div>
                    <label for="name" class="block text-[10px] font-black text-gray-500 uppercase tracking-[0.2em] mb-2">
                        Imię i Nazwisko
                    </label>
                    <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus 
                           aria-required="true"
                           aria-invalid="{{ $errors->has('name') ? 'true' : 'false' }}"
                           class="w-full border-2 border-gray-100 rounded-lg p-3 font-bold text-gray-900 focus:border-blue-800 focus:ring-0 transition-all shadow-sm">
                    <x-input-error :messages="$errors->get('name')" class="mt-2 text-[10px] font-black uppercase text-red-600" />
                </div>

                {{-- Email --}}
                <div>
                    <label for="email" class="block text-[10px] font-black text-gray-500 uppercase tracking-[0.2em] mb-2">
                        Adres E-mail
                    </label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required 
                           aria-required="true"
                           aria-invalid="{{ $errors->has('email') ? 'true' : 'false' }}"
                           class="w-full border-2 border-gray-100 rounded-lg p-3 font-bold text-gray-900 focus:border-blue-800 focus:ring-0 transition-all shadow-sm">
                    <x-input-error :messages="$errors->get('email')" class="mt-2 text-[10px] font-black uppercase text-red-600" />
                </div>

                {{-- Hasło --}}
                <div>
                    <label for="password" class="block text-[10px] font-black text-gray-500 uppercase tracking-[0.2em] mb-2">
                        Hasło
                    </label>
                    <div class="relative">
                        <input id="password" type="password" name="password" required 
                               aria-required="true"
                               class="w-full border-2 border-gray-100 rounded-lg p-3 pr-12 font-bold text-gray-900 focus:border-blue-800 focus:ring-0 transition-all shadow-sm">
                        <button type="button" onclick="togglePassword('password', this)" 
                                class="absolute right-3 top-1/2 -translate-y-1/2 text-xl grayscale hover:grayscale-0 transition-all"
                                aria-label="Pokaż lub ukryj hasło">
                            👁
                        </button>
                    </div>
                    <x-input-error :messages="$errors->get('password')" class="mt-2 text-[10px] font-black uppercase text-red-600" />
                </div>

                {{-- Potwierdź Hasło --}}
                <div>
                    <label for="password_confirmation" class="block text-[10px] font-black text-gray-500 uppercase tracking-[0.2em] mb-2">
                        Potwierdź Hasło
                    </label>
                    <div class="relative">
                        <input id="password_confirmation" type="password" name="password_confirmation" required 
                               aria-required="true"
                               class="w-full border-2 border-gray-100 rounded-lg p-3 pr-12 font-bold text-gray-900 focus:border-blue-800 focus:ring-0 transition-all shadow-sm">
                        <button type="button" onclick="togglePassword('password_confirmation', this)" 
                                class="absolute right-3 top-1/2 -translate-y-1/2 text-xl grayscale hover:grayscale-0 transition-all"
                                aria-label="Pokaż lub ukryj potwierdzenie hasła">
                            👁
                        </button>
                    </div>
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-[10px] font-black uppercase text-red-600" />
                </div>

                {{-- Przyciski --}}
                <div class="flex items-center justify-between pt-4 border-t-2 border-gray-50">
                    <a class="text-[10px] font-black text-gray-400 uppercase tracking-widest hover:text-blue-800 transition-colors" href="{{ route('login') }}">
                        Masz już konto? Zaloguj →
                    </a>

                    <button type="submit" class="bg-blue-800 text-white px-8 py-3 rounded-lg font-black uppercase text-xs tracking-[0.2em] hover:bg-black hover:shadow-2xl transition-all transform hover:-translate-y-1 active:scale-95">
                        Zarejestruj się
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>