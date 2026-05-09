@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6 max-w-7xl">
    {{-- 1. NAGŁÓWEK SYSTEMOWY (Zasada: Postrzegalność - struktura nagłówków) --}}
    <div class="mb-10 border-b-4 border-blue-800 pb-4">
        <h1 class="text-4xl font-black text-gray-900 uppercase tracking-tighter">
            Faktury i Rozliczenia
        </h1>
        <p class="text-gray-600 font-bold uppercase text-[10px] tracking-[0.3em] mt-1">
            Ewidencja dokumentów finansowych i statusów płatności
        </p>
    </div>

    {{-- 2. AKCJE GŁÓWNE --}}
    <div class="mb-8">
        <a href="{{ route('admin.invoices.create') }}"
           class="inline-flex items-center bg-green-700 hover:bg-black text-white px-8 py-4 rounded-xl font-black shadow-xl transition-all transform hover:-translate-y-1 active:scale-95 uppercase tracking-[0.2em] text-xs">
            <span class="mr-3 text-xl" aria-hidden="true">➕</span> Nowa faktura
        </a>
    </div>

    {{-- 3. TABELA FAKTUR (Zasada: Solidność - dostępność tabel) --}}
    <div class="bg-white shadow-2xl rounded-xl overflow-hidden border-2 border-gray-100 border-t-[12px]">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead class="bg-gray-900 text-white uppercase text-[10px] tracking-[0.3em] font-black">
                    <tr>
                        <th scope="col" class="p-5 border-b border-gray-800">Numer</th>
                        <th scope="col" class="p-5 border-b border-gray-800">Zleceniodawca</th>
                        <th scope="col" class="p-5 border-b border-gray-800 text-right">Kwota Brutto</th>
                        <th scope="col" class="p-5 border-b border-gray-800 text-center">Status</th>
                        <th scope="col" class="p-5 border-b border-gray-800 text-center">Zarządzanie</th>
                    </tr>
                </thead>
                <tbody class="divide-y-2 divide-gray-50 text-sm">
                    @forelse ($invoices as $invoice)
                    <tr class="hover:bg-green-50 transition-colors">
                        <td class="p-5 font-mono font-black text-blue-800 text-base">
                            FV/{{ $invoice->id }}
                        </td>
                        <td class="p-5 font-black text-gray-900 uppercase tracking-tight">
                            {{ $invoice->client->user->name ?? 'Klient nieznany' }}
                        </td>
                        <td class="p-5 font-mono font-black text-gray-900 text-right">
                            {{ number_format($invoice->total_price, 2) }} PLN
                        </td>
                        
                        <td class="p-5 text-center">
                            @php
                                $statusLower = strtolower($invoice->status);
                                $isPaid = in_array($statusLower, ['opłacona', 'paid']);
                            @endphp
                            <span class="inline-block px-4 py-1 rounded-lg text-[10px] font-black uppercase border-2 
                                {{ $isPaid 
                                    ? 'bg-green-100 text-green-800 border-green-200' 
                                    : 'bg-red-100 text-red-800 border-red-200' }}">
                                <span class="mr-1" aria-hidden="true">{{ $isPaid ? '●' : '○' }}</span>
                                {{ $invoice->status }}
                            </span>
                        </td>

                        <td class="p-5">
                            <div class="flex justify-center items-center gap-2">
                                {{-- Podgląd --}}
                                <a href="{{ route('admin.invoices.show', $invoice) }}" 
                                   aria-label="Podgląd faktury FV/{{ $invoice->id }}"
                                   class="bg-blue-800 text-white px-4 py-2 rounded font-black uppercase text-[10px] tracking-widest hover:bg-black transition shadow-md">
                                    Szczegóły
                                </a>

                                {{-- Edytuj --}}
                                <a href="{{ route('admin.invoices.edit', $invoice) }}" 
                                   aria-label="Edytuj fakturę FV/{{ $invoice->id }}"
                                   class="bg-yellow-600 text-white px-4 py-2 rounded font-black uppercase text-[10px] tracking-widest hover:bg-black transition shadow-md">
                                    Edycja
                                </a>

                                {{-- Usuń --}}
                                @if(auth()->user() && auth()->user()->role === 'admin')
                                    <form action="{{ route('admin.invoices.destroy', $invoice) }}"
                                          method="POST"
                                          onsubmit="return confirm('Czy na pewno chcesz usunąć fakturę FV/{{ $invoice->id }}?')">
                                        @csrf
                                        @method('DELETE')
                                        <button aria-label="Usuń fakturę FV/{{ $invoice->id }}"
                                                class="bg-red-700 text-white px-4 py-2 rounded font-black uppercase text-[10px] tracking-widest hover:bg-black transition shadow-md">
                                            Usuń
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="p-20 text-center">
                            <div class="flex flex-col items-center">
                                <span class="text-6xl mb-4 grayscale" aria-hidden="true">📑</span>
                                <p class="text-gray-400 font-black uppercase tracking-[0.4em] text-xs italic">
                                    Brak wystawionych dokumentów w systemie
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