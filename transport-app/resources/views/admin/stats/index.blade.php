@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6 max-w-7xl">
    {{-- 1. NAGŁÓWEK SYSTEMOWY (Zasada: Logiczna struktura nagłówków) --}}
    <div class="mb-10 border-b-4 border-blue-800 pb-4">
        <h1 class="text-4xl font-black text-gray-900 uppercase tracking-tighter">
            Centrum Analityczne Systemu
        </h1>
        <p class="text-gray-600 font-bold uppercase text-[10px] tracking-[0.3em] mt-1">
            Monitorowanie wolumenu operacyjnego i bazy danych Transport App
        </p>
    </div>

    {{-- 2. SIATKA KAFELKÓW STATYSTYK --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-12" role="region" aria-label="Podsumowanie statystyk">
        
        {{-- Karta: Użytkownicy (Kolor Fioletowy - Kadry) --}}
        <div class="bg-white p-8 rounded-xl shadow-xl border-2 border-gray-100 border-t-[12px] border-t-purple-600 transition-all hover:-translate-y-1">
            <h2 class="text-[10px] uppercase font-black text-gray-500 tracking-[0.2em] mb-4">
                Baza Klientów i Personelu
            </h2>
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-5xl font-black text-gray-900 tracking-tighter">{{ $users }}</p>
                    <p class="text-[9px] font-black text-purple-600 uppercase mt-2 tracking-widest italic">Aktywne konta</p>
                </div>
                <span class="text-5xl grayscale opacity-30" aria-hidden="true">👤</span>
            </div>
        </div>

        {{-- Karta: Przesyłki (Kolor Niebieski - Logistyka) --}}
        <div class="bg-white p-8 rounded-xl shadow-xl border-2 border-gray-100 border-t-[12px] border-t-blue-800 transition-all hover:-translate-y-1">
            <h2 class="text-[10px] uppercase font-black text-gray-500 tracking-[0.2em] mb-4">
                Wolumen Przesyłek PL-NO
            </h2>
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-5xl font-black text-gray-900 tracking-tighter">{{ $packages }}</p>
                    <p class="text-[9px] font-black text-blue-800 uppercase mt-2 tracking-widest italic">Wszystkie zlecenia</p>
                </div>
                <span class="text-5xl grayscale opacity-30" aria-hidden="true">📦</span>
            </div>
        </div>

        {{-- Karta: Faktury (Kolor Zielony - Finanse) --}}
        <div class="bg-white p-8 rounded-xl shadow-xl border-2 border-gray-100 border-t-[12px] border-t-green-600 transition-all hover:-translate-y-1">
            <h2 class="text-[10px] uppercase font-black text-gray-500 tracking-[0.2em] mb-4">
                Wystawione Faktury
            </h2>
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-5xl font-black text-gray-900 tracking-tighter">{{ $invoices }}</p>
                    <p class="text-[9px] font-black text-green-700 uppercase mt-2 tracking-widest italic">Dokumenty obciążeniowe</p>
                </div>
                <span class="text-5xl grayscale opacity-30" aria-hidden="true">🧾</span>
            </div>
        </div>
    </div>

    {{-- 3. SEKCJA AKCJI (Zasada: Funkcjonalność - wyraźny fokus) --}}
    <div class="mt-12 flex justify-center border-t-4 border-gray-100 pt-10">
        <a href="{{ route('admin.packages.index') }}" 
           class="bg-blue-800 hover:bg-black text-white px-16 py-5 rounded-xl font-black shadow-2xl transition-all transform hover:-translate-y-1 active:scale-95 uppercase tracking-[0.2em] text-sm focus:ring-4 focus:ring-blue-200 outline-none">
            Otwórz Zarządzanie Przesyłkami
        </a>
    </div>
</div>
@endsection