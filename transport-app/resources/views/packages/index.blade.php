@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6 max-w-7xl">
    {{-- 1. NAGŁÓWEK SYSTEMOWY (Zasada: Postrzegalność - logiczna struktura nagłówków)  --}}
    <header class="mb-10 border-b-4 border-blue-800 pb-4">
        <h1 id="page-title" class="text-4xl font-black text-gray-900 uppercase tracking-tighter">
            Logistyka Przesyłek (PL ➔ NO)
        </h1>
        <p class="text-gray-600 font-bold uppercase text-[10px] tracking-[0.3em] mt-1">
            Zarządzanie transportem międzynarodowym i ewidencja TRK
        </p>
    </header>


    {{-- 3. FORMULARZ PRZYJĘCIA (Styl: górny pas 12px - Niebieski Logistyka) --}}
    <section aria-labelledby="form-heading" class="bg-white p-8 rounded-xl shadow-xl mb-10 border-2 border-gray-100 border-t-[12px] border-t-blue-800">
        <h2 id="form-heading" class="text-xl font-black mb-8 text-gray-900 uppercase tracking-tighter flex items-center italic">
            <span class="mr-3 text-blue-800" aria-hidden="true">📦</span> Przyjmij nową jednostkę transportową
        </h2>
        
        <form action="{{ route('admin.packages.store') }}" method="POST" class="space-y-8" novalidate>
            @csrf
            <input type="hidden" name="status" value="odebrana">

            {{-- Pierwsza linia formularza (Zasada: Powiązanie Label-Input)  --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <div>
                    <label for="tracking_number" class="block text-[10px] font-black text-gray-700 uppercase mb-2 tracking-widest">
                        Numer TRK <span class="text-red-600" aria-hidden="true">*</span>
                    </label>
                    <input type="text" id="tracking_number" name="tracking_number" 
                           value="{{ old('tracking_number', $suggestedNumber ?? '') }}" 
                           required aria-required="true"
                           class="w-full border-2 border-gray-100 rounded-lg p-3 font-black text-gray-900 focus:border-blue-800 focus:ring-4 focus:ring-blue-100 outline-none transition-all shadow-sm">
                </div>

                <div>
                    <label for="client_id" class="block text-[10px] font-black text-gray-700 uppercase mb-2 tracking-widest">
                        Zleceniodawca (Klient) <span class="text-red-600" aria-hidden="true">*</span>
                    </label>
                    <select id="client_id" name="client_id" required aria-required="true"
                            class="w-full border-2 border-gray-100 rounded-lg p-3 font-black text-gray-900 focus:border-blue-800 outline-none uppercase text-xs">
                        <option value="" disabled selected>— WYBIERZ KONTRAHENTA —</option>
                        @foreach($clients as $c) 
                            <option value="{{ $c->id }}" {{ old('client_id') == $c->id ? 'selected' : '' }}>
                                {{ $c->user->name ?? $c->name }}
                            </option> 
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="warehouse_id" class="block text-[10px] font-black text-gray-700 uppercase mb-2 tracking-widest">
                        Magazyn Przyjęcia (PL) <span class="text-red-600" aria-hidden="true">*</span>
                    </label>
                    <select id="warehouse_id" name="warehouse_id" required aria-required="true"
                            class="w-full border-2 border-gray-100 rounded-lg p-3 font-black text-gray-900 focus:border-blue-800 outline-none uppercase text-xs">
                        @foreach($warehouses as $w)
                            <option value="{{ $w->id }}">{{ $w->name }} ({{ $w->city }})</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="courier_id" class="block text-[10px] font-black text-gray-700 uppercase mb-2 tracking-widest">
                        Kierowca / Pojazd <span class="text-red-600" aria-hidden="true">*</span>
                    </label>
                    <select id="courier_id" name="courier_id" required aria-required="true"
                            class="w-full border-2 border-gray-100 rounded-lg p-3 font-black text-gray-900 focus:border-blue-800 outline-none uppercase text-xs">
                        <option value="" disabled selected>— PRZYPISZ TRANSPORT —</option>
                        @foreach($couriers as $cr) 
                            <option value="{{ $cr->id }}">
                                {{ $cr->name }} [{{ $cr->vehicle_number ?? $cr->company }}]
                            </option> 
                        @endforeach
                    </select>
                </div>
            </div>

            {{-- Druga linia formularza --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 items-end border-t-2 border-gray-50 pt-8">
                <div>
                    <label for="weight" class="block text-[10px] font-black text-gray-700 uppercase mb-2 tracking-widest">
                        Waga (KG) <span class="text-red-600" aria-hidden="true">*</span>
                    </label>
                    <input type="number" id="weight" name="weight" step="0.01" required aria-required="true"
                           class="w-full border-2 border-gray-100 rounded-lg p-3 font-black text-gray-900 focus:border-blue-800 focus:ring-4 focus:ring-blue-100 outline-none">
                </div>
                <div>
                    <label for="pickup_point_id" class="block text-[10px] font-black text-gray-700 uppercase mb-2 tracking-widest">
                        Punkt Docelowy (NO) <span class="text-red-600" aria-hidden="true">*</span>
                    </label>
                    <select id="pickup_point_id" name="pickup_point_id" required aria-required="true"
                            class="w-full border-2 border-gray-100 rounded-lg p-3 font-black text-gray-900 focus:border-blue-800 outline-none uppercase text-xs">
                        @foreach($pickupPoints as $p) 
                            <option value="{{ $p->id }}">{{ $p->city }} ({{ $p->code }})</option> 
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="bg-blue-800 hover:bg-black text-white font-black py-4 rounded-xl shadow-xl transition-all transform hover:-translate-y-1 active:scale-95 uppercase tracking-[0.2em] text-xs">
                    ➕ Zarejestruj Przesyłkę
                </button>
            </div>
        </form>
    </section>

    {{-- 4. TABELA OPERACYJNA (Zasada: Solidność - nagłówki scope="col")  --}}
    <section aria-labelledby="table-heading">
        <h2 id="table-heading" class="sr-only">Lista aktualnych przesyłek</h2>
        <div class="bg-white shadow-2xl rounded-xl overflow-hidden border-2 border-gray-100">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead class="bg-gray-900 text-white uppercase text-[10px] tracking-[0.3em] font-black">
                        <tr>
                            <th scope="col" class="p-5">ID / Numer TRK</th>
                            <th scope="col" class="p-5">Klient</th>
                            <th scope="col" class="p-5">Punkt PL</th>
                            <th scope="col" class="p-5">Flota / Transport</th>
                            <th scope="col" class="p-5">Waga</th>
                            <th scope="col" class="p-5">Cel (NO)</th>
                            <th scope="col" class="p-5">Status</th>
                            <th scope="col" class="p-5 text-center">Akcje</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y-2 divide-gray-50 text-sm">
                        @foreach($packages as $package)
                        <tr class="hover:bg-blue-50 transition-colors font-bold text-gray-700">
                            <td class="p-5 font-mono font-black text-blue-800 text-sm">
                                {{ $package->tracking_number }}
                            </td>
                            <td class="p-5 uppercase tracking-tight">
                                {{ $package->client->user->name ?? $package->client->name }}
                            </td>
                            <td class="p-5">
                                <span class="bg-gray-100 px-3 py-1 rounded text-[10px] font-black uppercase text-gray-600 border border-gray-200 shadow-sm">
                                    {{ $package->warehouse->city ?? '—' }}
                                </span>
                            </td>
                            <td class="p-5">
                                @if($package->courier)
                                    <div class="text-[10px] font-black text-gray-900 uppercase leading-tight">{{ $package->courier->name }}</div>
                                    <div class="font-mono text-[9px] text-blue-700 italic tracking-tighter">
                                        {{ $package->courier->vehicle_number ?? $package->courier->company }}
                                    </div>
                                @else
                                    <span class="text-red-600 italic text-[10px] font-black uppercase">Brak przypisania</span>
                                @endif
                            </td>
                            <td class="p-5 font-black text-gray-900 uppercase">
                                {{ number_format($package->weight, 2) }} KG
                            </td>
                            <td class="p-5">
                                @if($package->pickupPoint)
                                    <span class="bg-blue-50 px-3 py-1 rounded text-[10px] font-black uppercase text-blue-800 border border-blue-100 shadow-sm">
                                        {{ $package->pickupPoint->city }}
                                    </span>
                                @else
                                    <span class="text-gray-400 italic text-[10px] uppercase">Brak punktu</span>
                                @endif
                            </td>
                            <td class="p-5">
                                @php
                                    $color = match($package->status) {
                                        'dostarczona' => 'bg-green-100 text-green-800 border-green-300',
                                        'odebrana' => 'bg-blue-100 text-blue-800 border-blue-300',
                                        default => 'bg-yellow-100 text-yellow-800 border-yellow-300'
                                    };
                                @endphp
                                <span role="status" class="px-3 py-1 rounded-lg text-[9px] font-black uppercase border-2 shadow-sm {{ $color }}">
                                    {{ str_replace('_', ' ', $package->status) }}
                                </span>
                            </td>
                            <td class="p-5">
                                <div class="flex justify-center items-center gap-2">
                                    <a href="{{ route('admin.packages.edit', $package) }}" 
                                       [cite_start]aria-label="Edytuj przesyłkę: {{ $package->tracking_number }}" {{-- Zasada: Opis akcji [cite: 289, 372] --}}
                                       class="bg-blue-800 hover:bg-black text-white px-4 py-2 rounded-lg text-[10px] font-black uppercase transition shadow-md">
                                        Edycja
                                    </a>
                                    
                                    <form action="{{ route('admin.packages.destroy', $package) }}" method="POST" 
                                          onsubmit="return confirm('Trwale usunąć rekord przesyłki {{ $package->tracking_number }}?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" 
                                                [cite_start]aria-label="Usuń przesyłkę: {{ $package->tracking_number }}" {{-- Zasada: Opis akcji [cite: 380] --}}
                                                class="bg-red-700 hover:bg-black text-white px-4 py-2 rounded-lg text-[10px] font-black uppercase transition shadow-md">
                                            Usuń
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>
@endsection