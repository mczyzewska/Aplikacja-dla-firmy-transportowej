@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6 max-w-7xl">
    {{-- 1. NAGŁÓWEK SYSTEMOWY (Zasada: Postrzegalność - logiczna struktura)  --}}
    <header class="mb-10 border-b-4 border-blue-800 pb-4">
        <h1 id="page-title" class="text-4xl font-black text-gray-900 uppercase tracking-tighter">
            Moje Przesyłki
        </h1>
        <p class="text-gray-600 font-bold uppercase text-[10px] tracking-[0.3em] mt-1">
            Podgląd statusów i punktów odbioru dla Twoich zleceń (PL ➔ NO)
        </p>
    </header>

    {{-- 2. TABELA PRZESYŁEK (Zasada: Solidność - dostępność tabel) [cite: 285, 286, 287] --}}
    <div class="bg-white shadow-2xl rounded-xl overflow-hidden border-2 border-gray-100">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse" aria-labelledby="page-title">
                <thead class="bg-gray-900 text-white uppercase text-[10px] tracking-[0.3em] font-black">
                    <tr>
                        {{-- Atrybut scope="col" pozwala czytnikom ekranu poprawnie kojarzyć dane  --}}
                        <th scope="col" class="p-5 border-b border-gray-800">Numer Trackingowy TRK</th>
                        <th scope="col" class="p-5 border-b border-gray-800">Punkt Odbioru (NO)</th>
                        <th scope="col" class="p-5 border-b border-gray-800 text-center">Status Operacyjny</th>
                        <th scope="col" class="p-5 border-b border-gray-800 text-center">Ostatnia Aktualizacja</th>
                    </tr>
                </thead>
                <tbody class="divide-y-2 divide-gray-50">
                    @forelse($packages as $package)
                    <tr class="hover:bg-blue-50 transition-colors">
                        {{-- Numer trackingowy w stylu brutalistycznym --}}
                        <td class="p-5 font-mono font-black text-blue-800 text-base uppercase tracking-tighter">
                            {{ $package->tracking_number }}
                        </td>
                        
                        <td class="p-5">
                            @if($package->pickupPoint)
                                <div class="font-black text-gray-900 uppercase text-xs tracking-tight">
                                    {{ $package->pickupPoint->code }}
                                </div>
                                <div class="text-[10px] text-blue-700 font-black uppercase tracking-widest mt-1">
                                    {{ $package->pickupPoint->city }}
                                </div>
                            @else
                                <span class="text-gray-400 font-bold italic uppercase text-[10px]">Brak danych o punkcie</span>
                            @endif
                        </td>

                        <td class="p-5 text-center">
                            @php
                                $colors = [
                                    'dostarczona' => 'bg-green-100 text-green-900 border-green-300',
                                    'w_punkcie' => 'bg-purple-100 text-purple-900 border-purple-300',
                                    'w_transporcie' => 'bg-yellow-100 text-yellow-900 border-yellow-400',
                                    'odebrana' => 'bg-blue-100 text-blue-900 border-blue-300'
                                ];
                                $badge = $colors[$package->status] ?? 'bg-gray-100 text-gray-900 border-gray-300';
                            @endphp
                            {{-- Role="status" informuje o dynamicznej zmianie stanu [cite: 280] --}}
                            <span role="status" class="px-4 py-1 rounded-lg text-[9px] font-black uppercase border-2 shadow-sm {{ $badge }}">
                                {{ str_replace('_', ' ', $package->status) }}
                            </span>
                        </td>

                        <td class="p-5 text-center font-black text-gray-700 text-xs uppercase tracking-widest">
                            {{ $package->updated_at->format('d.m.Y') }}
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="p-20 text-center bg-gray-50">
                            <div class="flex flex-col items-center">
                                <span class="text-5xl mb-4 grayscale" aria-hidden="true">📦</span>
                                <p class="text-gray-500 font-black uppercase tracking-[0.4em] text-xs italic">
                                    Nie posiadasz jeszcze zarejestrowanych przesyłek
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