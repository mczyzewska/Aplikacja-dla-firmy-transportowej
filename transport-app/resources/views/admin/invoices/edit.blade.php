@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6 max-w-5xl">
    {{-- 1. NAGŁÓWEK SYSTEMOWY (Zasada: Postrzegalność - struktura nagłówków) [cite: 70, 208] --}}
    <div class="mb-10 border-b-4 border-blue-800 pb-4">
        <h1 class="text-4xl font-black text-gray-900 uppercase tracking-tighter">
            Edycja Dokumentu: FV/{{ $invoice->id }}
        </h1>
        <p class="text-gray-600 font-bold uppercase text-[10px] tracking-[0.3em] mt-1">
            Panel modyfikacji danych finansowych i pozycji transportowych
        </p>
    </div>

    

    <div class="bg-white p-8 rounded-xl shadow-xl border-2 border-gray-100 border-t-[12px] border-t-blue-800">
        <form action="{{ route('admin.invoices.update', $invoice) }}" method="POST" novalidate>
            @csrf @method('PUT')

            {{-- Dane Podstawowe --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-10">
                <div>
                    <label for="client_id" class="block text-[10px] font-black text-gray-700 uppercase mb-2 tracking-widest">
                        Zleceniodawca (Klient) *
                    </label>
                    <select id="client_id" name="client_id" required aria-required="true"
                            class="w-full border-2 border-gray-100 rounded-lg p-3 font-black text-sm bg-gray-50 focus:border-blue-800 focus:ring-4 focus:ring-blue-100 transition-all outline-none uppercase">
                        @foreach($clients as $c)
                            <option value="{{ $c->id }}" {{ $invoice->client_id == $c->id ? 'selected' : '' }}>
                                {{ $c->user->name ?? $c->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="status" class="block text-[10px] font-black text-blue-800 uppercase mb-2 tracking-widest">
                        Status Płatności
                    </label>
                    <select id="status" name="status" 
                            class="w-full border-2 border-blue-100 rounded-lg p-3 font-black text-sm bg-blue-50 focus:border-blue-800 focus:ring-4 focus:ring-blue-100 transition-all outline-none">
                        <option value="unpaid" {{ $invoice->status == 'unpaid' ? 'selected' : '' }}>🔴 NIEOPŁACONA</option>
                        <option value="paid" {{ $invoice->status == 'paid' ? 'selected' : '' }}>🟢 OPŁACONA</option>
                    </select>
                </div>
            </div>

            {{-- Daty --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-10 pb-10 border-b-4 border-gray-50">
                <div>
                    <label for="issue_date" class="block text-[10px] font-black text-gray-700 uppercase mb-2 tracking-widest">
                        Data Wystawienia
                    </label>
                    <input type="date" id="issue_date" name="issue_date" 
                           value="{{ old('issue_date', $invoice->issue_date->format('Y-m-d')) }}" 
                           class="w-full border-2 border-gray-100 rounded-lg p-3 font-bold bg-gray-50 focus:border-blue-800 focus:ring-4 focus:ring-blue-100 outline-none">
                </div>
                <div>
                    <label for="due_date" class="block text-[10px] font-black text-gray-700 uppercase mb-2 tracking-widest">
                        Termin Płatności
                    </label>
                    <input type="date" id="due_date" name="due_date" 
                           value="{{ old('due_date', $invoice->due_date->format('Y-m-d')) }}" 
                           class="w-full border-2 border-gray-100 rounded-lg p-3 font-bold bg-gray-50 focus:border-blue-800 focus:ring-4 focus:ring-blue-100 outline-none">
                </div>
            </div>

            {{-- Pozycje na fakturze --}}
            <h3 class="text-gray-900 font-black uppercase text-xs mb-6 flex items-center tracking-widest">
                <span class="mr-2" aria-hidden="true">📄</span> Aktualne pozycje faktury
            </h3>
            
            <div class="space-y-4 mb-10">
                @foreach($invoice->items as $item)
                    <div class="flex flex-wrap items-center gap-4 bg-gray-50 p-5 rounded-xl border-2 border-gray-100 hover:border-blue-200 transition-colors">
                        <div class="flex-1 font-black text-sm text-gray-900 uppercase tracking-tight">
                            {{ $item->package->tracking_number }} 
                            <span class="text-[10px] text-gray-500 ml-2 font-bold tracking-widest">
                                WAGA: {{ $item->package->weight }} KG
                            </span>
                        </div>
                        <div class="w-40 relative">
                            <label for="price_{{ $item->id }}" class="sr-only">Cena dla pozycji {{ $item->package->tracking_number }}</label>
                            <input type="number" id="price_{{ $item->id }}" name="items[{{ $item->id }}][price]" 
                                   value="{{ $item->price }}" 
                                   class="w-full border-2 border-gray-200 rounded-lg p-2 font-black text-right text-sm focus:border-blue-800 outline-none" 
                                   step="0.01">
                        </div>
                        <div class="flex items-center ml-4">
                            <input type="checkbox" id="del_{{ $item->id }}" name="delete_items[]" value="{{ $item->id }}" 
                                   class="w-5 h-5 rounded border-gray-300 text-red-600 focus:ring-red-500 shadow-sm cursor-pointer">
                            <label for="del_{{ $item->id }}" class="ml-2 text-red-700 font-black text-[10px] uppercase tracking-widest cursor-pointer hover:text-red-900 transition-colors">
                                Usuń
                            </label>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Dodawanie nowej pozycji --}}
            <div class="bg-blue-50 p-8 rounded-xl border-2 border-blue-100 mb-10 shadow-inner">
                <h4 class="text-blue-800 font-black uppercase text-[11px] mb-4 tracking-[0.2em] flex items-center">
                    <span class="mr-2" aria-hidden="true">➕</span> Dodaj nową paczkę do dokumentu
                </h4>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="new_pkg" class="sr-only">Wybierz paczkę</label>
                        <select id="new_pkg" name="new_item[package_id]" 
                                class="w-full border-2 border-white rounded-lg p-3 font-black text-xs uppercase shadow-sm focus:border-blue-800 outline-none transition-all">
                            <option value="">— WYBIERZ PACZKĘ —</option>
                            @foreach($availablePackages as $p)
                                <option value="{{ $p->id }}">{{ $p->tracking_number }} ({{ $p->weight }} KG)</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label for="new_price" class="sr-only">Cena nowej pozycji</label>
                        <input type="number" id="new_price" name="new_item[price]" placeholder="CENA (PLN)" 
                               class="w-full border-2 border-white rounded-lg p-3 font-black text-xs shadow-sm focus:border-blue-800 outline-none transition-all" step="0.01">
                    </div>
                </div>
            </div>

            {{-- Stopka Formularza --}}
            <div class="flex items-center justify-between border-t-4 border-gray-50 pt-10">
                <a href="{{ route('admin.invoices.index') }}" 
                   class="text-[10px] font-black text-gray-400 uppercase tracking-[0.3em] hover:text-red-600 transition-colors">
                    ← Anuluj zmiany
                </a>
                <button type="submit" 
                        class="bg-blue-800 hover:bg-black text-white px-12 py-5 rounded-xl font-black shadow-xl uppercase tracking-[0.2em] text-xs transition-all transform hover:-translate-y-1 active:scale-95">
                    Zaktualizuj Fakturę
                </button>
            </div>
        </form>
    </div>
</div>
@endsection