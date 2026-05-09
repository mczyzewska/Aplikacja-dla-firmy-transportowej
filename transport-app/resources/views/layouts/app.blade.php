<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="utf-8">
    <title>@yield('title', 'Panel') – Transport App</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <script src="https://cdn.tailwindcss.com"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 text-gray-900 min-h-screen flex flex-col">

<a href="#main-content"
   class="sr-only focus:not-sr-only focus:fixed focus:top-2 focus:left-2
          bg-white text-black p-2 z-50 border-2 border-black">
    Przejdź do treści głównej
</a>

<header class="bg-white shadow-md border-b-2 border-gray-200">
    <nav class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center"
         aria-label="Główna nawigacja">

        <div class="flex gap-6 items-center">
            <span class="font-bold text-xl text-blue-800">
                🚚 Transport App
            </span>

            {{-- Zostawiamy tylko Dashboard --}}
            <a href="{{ route('dashboard') }}" class="font-black uppercase tracking-widest hover:text-blue-700 focus:outline text-sm">
                Dashboard
            </a>

            {{-- USUNIĘTO: Sekcję @if(auth()->check() && auth()->user()->role !== 'client') --}}
        </div>

        <div class="flex items-center gap-4">
            @auth
                <div class="text-right mr-2">
                    <div class="text-sm font-black text-black leading-tight">{{ auth()->user()->name }}</div>
                    <div class="text-[10px] text-blue-600 uppercase font-black tracking-tighter">{{ auth()->user()->role }}</div>
                </div>
            @endauth

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                    class="px-6 py-2 bg-red-700 text-white rounded font-black uppercase text-xs
                           hover:bg-red-800 focus:ring-2 focus:ring-offset-2 focus:ring-red-500 shadow-md transition">
                    Wyloguj
                </button>
            </form>
        </div>
    </nav>
</header>

<main id="main-content" tabindex="-1" class="flex-1 max-w-7xl mx-auto p-6 w-full outline-none">
    
    {{-- POWIADOMIENIA SYSTEMOWE (WCAG) --}}
    <section aria-label="Powiadomienia systemowe">
        @if(session('success'))
            <div class="mb-6 bg-green-100 border-l-8 border-green-800 p-4 shadow-lg rounded-r-lg" 
                 role="alert" 
                 aria-live="polite">
                <div class="flex items-center">
                    <span class="text-3xl mr-4" aria-hidden="true">✅</span>
                    <p class="text-green-900 font-extrabold text-lg">
                        {{ session('success') }}
                    </p>
                </div>
            </div>
        @endif

        @if($errors->any())
            <div class="mb-6 bg-red-100 border-l-8 border-red-800 p-4 shadow-lg rounded-r-lg" 
                 role="alert">
                <div class="flex">
                    <span class="text-3xl mr-4" aria-hidden="true">⚠️</span>
                    <div>
                        <p class="text-red-900 font-extrabold text-lg mb-2 uppercase">Wystąpiły błędy:</p>
                        <ul class="list-disc list-inside text-red-800 font-bold">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        @endif
    </section>

    @yield('content')
</main>

<footer class="bg-white text-center text-gray-800 font-bold text-sm p-6 border-t-2 border-gray-200 uppercase tracking-widest text-[10px]">
    © {{ date('Y') }} System Transportowy PL-NO – Dostępność WCAG 2.1
</footer>

</body>
</html>