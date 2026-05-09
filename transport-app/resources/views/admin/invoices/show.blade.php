@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6 max-w-5xl">

    {{-- 1. NAGŁÓWEK SYSTEMOWY (Zasada: Postrzegalność - logiczna struktura nagłówków) [cite: 70, 208] --}}
    <div class="flex flex-wrap items-center justify-between mb-10 border-b-4 border-blue-800 pb-4 gap-4">
        <h1 class="text-4xl font-black text-gray-900 uppercase tracking-tighter">
            Szczegóły Dokumentu: FV/{{ $invoice->id }}
        </h1>
        <a href="{{ route('admin.invoices.index') }}"
           aria-label="Powrót do listy faktur i rozliczeń"
           class="bg-gray-600 hover:bg-black text-white px-8 py-3 rounded-lg font-black shadow-lg transition transform hover:-translate-y-1 active:scale-95 text-xs uppercase tracking-widest flex items-center">
            <span class="mr-2" aria-hidden="true">←</span> Wróć do ewidencji
        </a>
    </div>

    {{-- GŁÓWNA KARTA DANYCH (Usunięto zielony pasek zgodnie z prośbą) --}}
    <div class="bg-white shadow-2xl rounded-xl overflow-hidden border-2 border-gray-100 p-10 mb-8">
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-12 mb-10 border-b-4 border-gray-50 pb-10">
            {{-- Dane Odbiorcy (Zasada: Postrzegalność - kontrast minimum 4.5:1) [cite: 206] --}}
            <section aria-labelledby="receiver-info">
                <h2 id="receiver-info" class="text-[10px] font-black text-gray-600 uppercase tracking-[0.2em] mb-4">
                    Zleceniodawca / Odbiorca
                </h2>
                <p class="text-2xl font-black text-blue-900 leading-[0.9] uppercase tracking-tighter">
                    {{ $invoice->client->user->name ?? $invoice->client->name }}
                </p>
                <div class="mt-4 space-y-2">
                    @if($invoice->nip)
                        <p class="text-sm font-black text-gray-700 font-mono tracking-tight">
                            NIP: <span class="text-black">{{ $invoice->nip }}</span>
                        </p>
                    @endif
                    @if($invoice->client && $invoice->client->address)
                        <p class="text-sm text-gray-700 font-bold italic leading-relaxed">
                            {{ $invoice->client->address }}
                        </p>
                    @endif
                </div>
            </section>

            {{-- Dane Faktury i Status (Zasada: Zrozumiałość - czytelne komunikaty) [cite: 100, 107] --}}
            <section class="md:text-right" aria-labelledby="payment-info">
                <h2 id="payment-info" class="text-[10px] font-black text-gray-600 uppercase tracking-[0.2em] mb-4">
                    Parametry finansowe
                </h2>
                <div class="space-y-3">
                    <p class="text-sm font-black text-gray-700 uppercase tracking-widest">
                        Wystawiono: 
                        <span class="text-black ml-1">
                            {{ \Carbon\Carbon::parse($invoice->issue_date)->format('d.m.Y') }}
                        </span>
                    </p>
                    <p class="text-sm font-black text-gray-700 uppercase tracking-widest">
                        Termin: 
                        <span class="text-red-700 ml-1">
                            {{ \Carbon\Carbon::parse($invoice->due_date)->format('d.m.Y') }}
                        </span>
                    </p>
                    <div class="mt-6 flex md:justify-end">
                        @php
                            $statusLower = strtolower($invoice->status);
                            $isPaid = in_array($statusLower, ['opłacona', 'paid']);
                        @endphp
                        <div role="status" 
                             class="px-6 py-2 rounded-lg text-[10px] font-black uppercase border-2 shadow-sm 
                            {{ $isPaid 
                                ? 'bg-green-100 text-green-800 border-green-300' 
                                : 'bg-red-100 text-red-800 border-red-300' }}">
                            {{ $isPaid ? '✔ Dokument opłacony' : '✖ Oczekuje na wpłatę' }}
                        </div>
                    </div>
                </div>
            </section>
        </div>

        {{-- Tabela pozycji (Zasada: Solidność - dostępność tabel) [cite: 125, 286] --}}
        <section aria-labelledby="items-title">
            <h2 id="items-title" class="text-2xl font-black text-gray-900 mb-6 uppercase tracking-tighter flex items-center">
                <span class="mr-3 text-blue-800" aria-hidden="true">📄</span> Pozycje rozliczeniowe
            </h2>
            
            <div class="overflow-hidden rounded-xl border-2 border-gray-100 shadow-inner">
                <table class="w-full text-left border-collapse">
                    <thead class="bg-gray-900 text-white uppercase text-[10px] tracking-[0.3em] font-black">
                        <tr>
                            <th scope="col" class="p-5 border-b border-gray-800">Nr przesyłki (Tracking)</th>
                            <th scope="col" class="p-5 border-b border-gray-800 text-right">Kwota netto (PLN)</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y-2 divide-gray-50">
                        @forelse ($invoice->items as $item)
                            <tr class="hover:bg-blue-50 transition-colors">
                                <td class="p-5 text-gray-900 font-mono font-black text-sm uppercase tracking-tighter">
                                    {{ $item->package->tracking_number ?? 'Brak numeru TRK' }}
                                </td>
                                <td class="p-5 text-right font-black text-gray-900 text-lg">
                                    {{ number_format($item->price, 2) }} zł
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="2" class="p-16 text-center text-gray-400 font-black italic uppercase tracking-[0.4em] text-xs">
                                    Brak pozycji zdefiniowanych na fakturze
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                    <tfoot class="bg-gray-50 border-t-[6px] border-gray-100">
                        <tr>
                            <th scope="row" class="p-8 text-right font-black text-gray-600 uppercase tracking-[0.3em] text-xs">
                                Całkowita kwota do zapłaty:
                            </th>
                            <td class="p-8 text-right font-black text-blue-800 text-4xl tracking-tighter shadow-sm">
                                {{ number_format($invoice->total_price, 2) }} PLN
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </section>
    </div>
</div>
@endsection