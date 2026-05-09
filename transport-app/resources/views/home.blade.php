<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>TransportApp – Zarządzanie Transportem w Nowym Standardzie</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700;900&display=swap" rel="stylesheet">
    
    <style>
        body { font-family: 'Inter', sans-serif; }
        /* WCAG: Wyraźny wskaźnik fokusu (Zasada: Funkcjonalność) */
        :focus {
            outline: 4px solid #1e40af !important;
            outline-offset: 2px;
        }
        .bg-subtle { background-color: #f8fafc; }
    </style>
</head>

<body class="bg-subtle text-gray-900 antialiased">

<a href="#main" class="sr-only focus:not-sr-only focus:fixed focus:top-4 focus:left-4 bg-blue-800 text-white p-4 font-black uppercase text-xs z-50 shadow-2xl border-2 border-white">
    Skocz do treści głównej
</a>

<header class="bg-white border-b-4 border-gray-100 shadow-sm">
    <nav class="max-w-6xl mx-auto px-6 h-24 flex justify-between items-center" aria-label="Główna nawigacja">
        <div class="flex items-center gap-3">
            <div class="p-2 bg-blue-800 text-white rounded shadow-sm" aria-hidden="true">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 17a2 2 0 11-4 0 2 2 0 014 0zM19 17a2 2 0 11-4 0 2 2 0 014 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1m-6-1a1 1 0 001 1h1m-4 0h1m-2 4h1"/>
                </svg>
            </div>
            <span class="text-2xl font-black tracking-tighter uppercase text-blue-800">TransportApp</span>
        </div>

        <div class="flex items-center gap-8">
            <a href="/login" class="text-xs font-black uppercase tracking-widest hover:text-blue-800 transition-colors">Zaloguj</a>
            <a href="/register" class="bg-blue-800 text-white px-6 py-3 rounded font-black uppercase text-xs tracking-widest hover:bg-black transition-all transform hover:-translate-y-1 shadow-md">
                Rejestracja
            </a>
        </div>
    </nav>
</header>

<main id="main" tabindex="-1" class="outline-none">

    <section class="max-w-6xl mx-auto px-6 py-24 grid md:grid-cols-2 gap-16 items-center">
        <div>
            <h1 class="text-6xl font-black leading-[0.9] mb-8 tracking-tighter uppercase italic text-gray-900">
                Zarządzanie transportem <br>
                <span class="text-blue-800">w nowym standardzie.</span>
            </h1>

            <p class="text-xl text-gray-700 mb-10 leading-relaxed font-medium">
                Nowoczesna platforma logistyczna optymalizująca procesy przesyłek i relacje z klientami. Skup się na dostawach, my zajmiemy się technologią.
            </p>

            <div class="flex flex-wrap gap-4">
                <a href="/login" class="bg-black text-white px-10 py-5 rounded-lg font-black uppercase text-sm tracking-widest shadow-xl hover:bg-blue-800 transition-all transform hover:-translate-y-1">
                    Zaloguj się
                </a>
                <a href="/register" class="border-4 border-gray-200 px-10 py-5 rounded-lg font-black uppercase text-sm tracking-widest hover:bg-white hover:border-blue-800 transition-all transform hover:-translate-y-1">
                    Utwórz konto
                </a>
            </div>
        </div>

        <div class="relative">
            <div class="absolute -inset-4 border-4 border-blue-800 rounded-xl transform rotate-2 -z-10" aria-hidden="true"></div>
            <img
                src="https://images.unsplash.com/photo-1586528116311-ad8dd3c8310d?auto=format&fit=crop&q=80&w=1200"
                alt="Biała ciężarówka transportowa podczas załadunku pod magazynem"
                class="relative rounded-xl shadow-2xl border-4 border-white grayscale-[20%]"
            >
        </div>
    </section>

    <section class="bg-white border-y-4 border-gray-100 py-24">
        <div class="max-w-6xl mx-auto px-6 grid md:grid-cols-3 gap-12">

            <div class="space-y-6 p-8 rounded-xl bg-gray-50 border-t-[12px] border-t-blue-800 shadow-lg">
                <div class="w-12 h-12 bg-blue-100 flex items-center justify-center rounded text-blue-800" aria-hidden="true">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                </div>
                <h2 class="text-xl font-black uppercase tracking-tight">Zarządzanie przesyłkami</h2>
                <p class="text-gray-600 font-bold text-sm leading-relaxed">
                    Kompletny system monitorowania i edycji zamówień.
                </p>
            </div>

            <div class="space-y-6 p-8 rounded-xl bg-gray-50 border-t-[12px] border-t-green-600 shadow-lg">
                <div class="w-12 h-12 bg-green-100 flex items-center justify-center rounded text-green-800" aria-hidden="true">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                </div>
                <h2 class="text-xl font-black uppercase tracking-tight">Klienci i role</h2>
                <p class="text-gray-600 font-bold text-sm leading-relaxed">
                    Precyzyjna kontrola uprawnień dla pracowników i partnerów biznesowych.
                </p>
            </div>

            <div class="space-y-6 p-8 rounded-xl bg-gray-50 border-t-[12px] border-t-purple-600 shadow-lg">
                <div class="w-12 h-12 bg-purple-100 flex items-center justify-center rounded text-purple-800" aria-hidden="true">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04 Pelna-0.003 0 00-3.382 10.24 11.954 11.954 0 007.362 10.64l.638.26.638-.26a11.954 11.954 0 007.362-10.64z"/></svg>
                </div>
                <h2 class="text-xl font-black uppercase tracking-tight">Dostępność WCAG</h2>
                <p class="text-gray-600 font-bold text-sm leading-relaxed">
                    Interfejs zoptymalizowany pod kątem standardów dostępności cyfrowej.
                </p>
            </div>

        </div>
    </section>

</main>

<footer class="py-16 bg-white border-t-4 border-gray-100">
    <div class="max-w-6xl mx-auto px-6 flex justify-between items-center text-[10px] text-gray-400 font-black uppercase tracking-[0.3em]">
        <span>© 2026 TransportApp – System Logistyczny</span>
          </div>
</footer>

</body>
</html>