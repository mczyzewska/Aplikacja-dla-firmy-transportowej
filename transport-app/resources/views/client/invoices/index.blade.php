@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6 max-w-7xl">
    {{-- 1. NAGŁÓWEK SYSTEMOWY (Zasada: Postrzegalność - logiczna struktura nagłówków)  --}}
    <header class="mb-10 border-b-4 border-blue-800 pb-4">
        <h1 id="page-title" class="text-4xl font-black text-gray-900 uppercase tracking-tighter">
            Moje Faktury: {{ $client->user->name ?? $client->name ?? 'Mój Profil' }}
        </h1>
        <p class="text-gray-600 font-bold uppercase text-[10px] tracking-[0.3em] mt-1">
            Ewidencja dokumentów finansowych i statusów płatności
        </p>
    </header>

    {{-- 2. TABELA FAKTUR (Zasada: Solidność - dostępność tabel) [cite: 286, 287] --}}
    <div class="bg-white shadow-2xl rounded-xl overflow-hidden border-2 border-gray-100">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse" aria-labelledby="page-title">
                <thead class="bg-gray-900 text-white uppercase text-[10px] tracking-[0.3em] font-black">
                    <tr>
                        {{-- Atrybut scope="col" pozwala czytnikom ekranu poprawnie kojarzyć dane  --}}
                        <th scope="col" class="p-5 border-b border-gray-800">Numer Dokumentu</th>
                        <th scope="col" class="p-5 border-b border-gray-800">Data Wystawienia</th>
                        <th scope="col" class="p-5 border-b border-gray-800">Kwota do zapłaty</th>
                        <th scope="col" class="p-5 border-b border-gray-800 text-center">Status</th>
                        <th scope="col" class="p-5 border-b border-gray-800 text-center">Zarządzanie</th>
                    </tr>
                </thead>
                <tbody class="divide-y-2 divide-gray-50">
                    @forelse ($invoices as $invoice)
                    <tr class="hover:bg-blue-50 transition-colors">
                        {{-- Styl brutalistyczny dla numeru faktury --}}
                        <td class="p-5 font-mono font-black text-blue-800 text-base uppercase tracking-tighter">
                            FV/{{ $invoice->id }}
                        </td>
                        
                        <td class="p-5 font-black text-gray-900 uppercase text-xs tracking-widest">
                            {{ \Carbon\Carbon::parse($invoice->issue_date)->format('d.m.Y') }}
                        </td>

                        <td class="p-5 font-mono font-black text-gray-900 text-base">
                            {{ number_format($invoice->total_price, 2) }} PLN
                        </td>
                        
                        <td class="p-5 text-center">
                            @php
                                $statusLower = strtolower($invoice->status);
                                $isPaid = in_array($statusLower, ['opłacona', 'paid']);
                            @endphp
                            {{-- Role="status" informuje o dynamicznej zmianie stanu [cite: 280] --}}
                            <span role="status" class="inline-block px-4 py-1 rounded-lg text-[9px] font-black uppercase border-2 shadow-sm 
                                {{ $isPaid 
                                    ? 'bg-green-100 text-green-900 border-green-300' 
                                    : 'bg-red-100 text-red-900 border-red-300' }}">
                                <span class="mr-1" aria-hidden="true">{{ $isPaid ? '●' : '○' }}</span>
                                {{ $invoice->status }}
                            </span>
                        </td>

                        <td class="p-5">
                            <div class="flex justify-center">
                                <a href="{{ route('client.invoices.show', $invoice) }}" 
                                   [cite_start]aria-label="Szczegóły faktury numer FV/{{ $invoice->id }}" {{-- Zasada: Wyraźny opis akcji [cite: 289, 372] --}}
                                   class="bg-blue-800 hover:bg-black text-white px-6 py-2 rounded-lg font-black uppercase text-[10px] tracking-widest shadow-md transition-all transform hover:-translate-y-0.5">
                                    Szczegóły
                                </a>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="p-20 text-center bg-gray-50">
                            <div class="flex flex-col items-center">
                                <span class="text-5xl mb-4 grayscale" aria-hidden="true">🧾</span>
                                <p class="text-gray-500 font-black uppercase tracking-[0.4em] text-xs italic">
                                    Nie posiadasz jeszcze wystawionych faktur
                                </p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection