@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6 max-w-7xl">
    {{-- Nagłówek systemowy --}}
    <div class="mb-10 border-b-4 border-blue-800 pb-4">
        <h1 class="text-4xl font-black text-gray-900 uppercase tracking-tighter">
            Panel Operacyjny Pracownika
        </h1>
        <p class="text-gray-500 font-bold uppercase text-[10px] tracking-[0.3em] mt-1">Witaj w panelu pracowniczym Transport App</p>
    </div>

    {{-- Siatka kafelków (2 kolumny na MD, 2 kolumny na LG - dla lepszego rozkładu 4 elementów) --}}
    <ul class="grid grid-cols-1 md:grid-cols-2 gap-8">
        
        {{-- 1. PRZESYŁKI --}}
        <li class="group bg-white p-8 rounded-xl shadow-xl border-2 border-gray-100 border-t-[12px] border-t-blue-800 hover:shadow-2xl transition-all transform hover:-translate-y-1">
            <a href="{{ route('admin.packages.index') }}" class="block">
                <div class="flex justify-between items-start mb-4">
                    <div class="text-4xl filter grayscale group-hover:grayscale-0 transition">📦</div>
                    <span class="bg-blue-100 text-blue-800 text-[10px] font-black px-3 py-1 rounded-full uppercase">Logistyka</span>
                </div>
                <h3 class="text-xl font-black text-gray-900 uppercase tracking-tight mb-2 group-hover:text-blue-800 transition">Przesyłki (PL ➔ NO)</h3>
                <p class="text-xs text-gray-500 font-bold leading-relaxed">Zarządzaj procesem transportowym, statusami i przypisaniem do pojazdów.</p>
                <div class="mt-6 flex items-center text-blue-800 font-black text-[10px] uppercase tracking-widest">
                    Zarządzaj paczkami →
                </div>
            </a>
        </li>

        {{-- 2. FAKTURY --}}
        <li class="group bg-white p-8 rounded-xl shadow-xl border-2 border-gray-100 border-t-[12px] border-t-green-600 hover:shadow-2xl transition-all transform hover:-translate-y-1">
            <a href="{{ route('admin.invoices.index') }}" class="block">
                <div class="flex justify-between items-start mb-4">
                    <div class="text-4xl filter grayscale group-hover:grayscale-0 transition">🧾</div>
                    <span class="bg-green-100 text-green-800 text-[10px] font-black px-3 py-1 rounded-full uppercase">Finanse</span>
                </div>
                <h3 class="text-xl font-black text-gray-900 uppercase tracking-tight mb-2 group-hover:text-green-600 transition">Faktury i Rozliczenia</h3>
                <p class="text-xs text-gray-500 font-bold leading-relaxed">Wystawianie dokumentów FV i monitorowanie statusów płatności.</p>
                <div class="mt-6 flex items-center text-green-600 font-black text-[10px] uppercase tracking-widest">
                    Przejdź do faktur →
                </div>
            </a>
        </li>

        {{-- 3. MAGAZYNY --}}
        <li class="group bg-white p-8 rounded-xl shadow-xl border-2 border-gray-100 border-t-[12px] border-t-orange-600 hover:shadow-2xl transition-all transform hover:-translate-y-1">
            <a href="{{ route('admin.warehouses.index') }}" class="block">
                <div class="flex justify-between items-start mb-4">
                    <div class="text-4xl filter grayscale group-hover:grayscale-0 transition">🏢</div>
                    <span class="bg-orange-100 text-orange-800 text-[10px] font-black px-3 py-1 rounded-full uppercase">Infrastruktura</span>
                </div>
                <h3 class="text-xl font-black text-gray-900 uppercase tracking-tight mb-2 group-hover:text-orange-600 transition">Magazyny (PL)</h3>
                <p class="text-xs text-gray-500 font-bold leading-relaxed">Zarządzanie punktami przeładunkowymi i stanami magazynowymi.</p>
                <div class="mt-6 flex items-center text-orange-600 font-black text-[10px] uppercase tracking-widest">
                    Punkty przeładunku →
                </div>
            </a>
        </li>

        {{-- 4. KIEROWCY / FLOTA --}}
        <li class="group bg-white p-8 rounded-xl shadow-xl border-2 border-gray-100 border-t-[12px] border-t-pink-600 hover:shadow-2xl transition-all transform hover:-translate-y-1">
            <a href="{{ route('admin.couriers.index') }}" class="block">
                <div class="flex justify-between items-start mb-4">
                    <div class="text-4xl filter grayscale group-hover:grayscale-0 transition">🚚</div>
                    <span class="bg-pink-100 text-pink-800 text-[10px] font-black px-3 py-1 rounded-full uppercase">Transport</span>
                </div>
                <h3 class="text-xl font-black text-gray-900 uppercase tracking-tight mb-2 group-hover:text-pink-600 transition">Kierowcy i Flota</h3>
                <p class="text-xs text-gray-500 font-bold leading-relaxed">Zarządzanie pojazdami oraz przypisywanie kierowców do tras.</p>
                <div class="mt-6 flex items-center text-pink-600 font-black text-[10px] uppercase tracking-widest">
                    Zarządzaj flotą →
                </div>
            </a>
        </li>
    </ul>
</div>
@endsection