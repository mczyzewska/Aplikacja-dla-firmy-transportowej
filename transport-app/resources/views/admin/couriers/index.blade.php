@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6 max-w-7xl">
    {{-- 1. NAGŁÓWEK SYSTEMOWY (Zasada: Postrzegalność - logiczna struktura) --}}
    <div class="mb-10 border-b-4 border-blue-800 pb-4">
        <h1 class="text-4xl font-black text-gray-900 uppercase tracking-tighter">
            Zarządzanie Flotą: Kierowcy i Pojazdy
        </h1>
        <p class="text-gray-600 font-bold uppercase text-[10px] tracking-[0.3em] mt-1">
            Panel administracyjny zasobów ludzkich i technicznych 
        </p>
    </div>

    {{-- 2. KOMUNIKATY BŁĘDÓW (Zasada: Zrozumiałość - role="alert") --}}
    @if ($errors->any())
        <div role="alert" class="mb-8 bg-red-50 border-l-8 border-red-600 p-4 rounded-md shadow-sm">
            <div class="flex items-center mb-2">
                <span class="text-xl mr-2" aria-hidden="true">⚠️</span>
                <h3 class="text-red-900 font-black uppercase tracking-tight">Wymagana interwencja w formularzu: </h3>
            </div>
            <ul class="text-xs text-red-700 font-bold uppercase tracking-wider space-y-1">
                @foreach ($errors->all() as $error)
                    <li>• {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
        
        {{-- LEWA KOLUMNA: Formularz (Zasada: Zrozumiałość - powiązanie etykiet) --}}
        <div class="lg:col-span-1">
            <div class="bg-white p-6 rounded-xl shadow-xl border-2 border-gray-100 border-t-[12px] border-t-blue-800">
                <h2 class="text-lg font-black mb-6 text-gray-900 uppercase tracking-tight">
                    🚛 Rejestracja Kierowcy
                </h2>
                
                <form action="{{ route('admin.couriers.store') }}" method="POST" class="space-y-5" novalidate>
                    @csrf
                    <div>
                        <label for="name" class="block text-[10px] font-black text-gray-600 uppercase tracking-widest mb-2">
                            Imię i Nazwisko 
                        </label>
                        <input id="name" type="text" name="name" required aria-required="true"
                               class="w-full border-2 border-gray-100 rounded-lg p-3 font-bold text-gray-900 focus:border-blue-800 focus:ring-4 focus:ring-blue-100 outline-none transition-all">
                    </div>

                    <div>
                        <label for="vehicle_number" class="block text-[10px] font-black text-gray-600 uppercase tracking-widest mb-2">
                            Numer Rejestracyjny
                        </label>
                        <input id="vehicle_number" type="text" name="vehicle_number" required aria-required="true"
                               placeholder="NP. GD 12345"
                               class="w-full border-2 border-gray-100 rounded-lg p-3 font-mono font-bold italic text-gray-900 focus:border-blue-800 focus:ring-4 focus:ring-blue-100 outline-none transition-all">
                    </div>

                    <div>
                        <label for="phone" class="block text-[10px] font-black text-gray-600 uppercase tracking-widest mb-2">
                            Telefon Służbowy
                        </label>
                        <input id="phone" type="tel" name="phone" required aria-required="true"
                               class="w-full border-2 border-gray-100 rounded-lg p-3 font-bold text-gray-900 focus:border-blue-800 focus:ring-4 focus:ring-blue-100 outline-none transition-all">
                    </div>

                    <button type="submit" class="w-full bg-blue-800 hover:bg-black text-white font-black py-4 rounded-lg shadow-lg uppercase text-xs tracking-[0.2em] transition transform hover:-translate-y-1 active:scale-95">
                        ➕ Dodaj do floty
                    </button>
                </form>
            </div>
        </div>

        {{-- PRAWA KOLUMNA: Tabela (Zasada: Solidność - dostępność tabel) --}}
        <div class="lg:col-span-3">
            <div class="bg-white shadow-xl rounded-xl overflow-hidden border-2 border-gray-100">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead class="bg-gray-900 text-white uppercase text-[10px] tracking-[0.3em] font-black">
                            <tr>
                                <th scope="col" class="p-5">Kierowca </th>
                                <th scope="col" class="p-5">Pojazd</th>
                                <th scope="col" class="p-5">Kontakt</th>
                                <th scope="col" class="p-5 text-center">Zarządzanie</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y-2 divide-gray-50 text-sm">
                            @forelse($couriers as $c)
                            <tr class="hover:bg-blue-50 transition-colors">
                                <td class="p-5 font-black text-gray-900 uppercase tracking-tight">{{ $c->name }}</td>
                                <td class="p-5">
                                    <span class="bg-gray-100 border-2 border-gray-200 px-3 py-1 rounded font-mono text-xs font-black text-gray-700 italic shadow-sm">
                                        {{ $c->vehicle_number }}
                                    </span>
                                </td>
                                <td class="p-5 font-bold text-gray-700">{{ $c->phone }}</td>
                                <td class="p-5">
                                    <div class="flex justify-center">
                                        <form action="{{ route('admin.couriers.destroy', $c) }}" method="POST" 
                                              onsubmit="return confirm('Czy na pewno chcesz usunąć kierowcę {{ $c->name }} z floty?')">
                                            @csrf @method('DELETE')
                                            <button aria-label="Usuń kierowcę: {{ $c->name }}" 
                                                    class="bg-red-700 text-white px-5 py-2 rounded font-black uppercase text-[10px] tracking-widest hover:bg-black shadow-md transition transform hover:-translate-y-0.5 active:scale-90">
                                                Usuń 
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="p-16 text-center text-gray-400 italic font-bold uppercase tracking-widest text-xs">
                                    Brak aktywnych jednostek we flocie
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection