<?php $__env->startSection('content'); ?>
<div class="container mx-auto p-6 max-w-7xl">
    
    <header class="mb-10 border-b-4 border-blue-800 pb-4">
        <h1 class="text-4xl font-black text-gray-900 uppercase tracking-tighter">
            Centrum Zarządzania Systemem
        </h1>
        <p class="text-gray-700 font-bold uppercase text-[10px] tracking-[0.3em] mt-1">
            Witaj w panelu administracyjnym Transport App
        </p>
    </header>

    
    <nav aria-label="Menu główne modułów systemowych">
        <ul class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            
            
            <li class="group bg-white p-8 rounded-xl shadow-xl border-2 border-gray-100 border-t-[12px] border-t-blue-800 hover:shadow-2xl transition-all transform hover:-translate-y-1">
                <a href="<?php echo e(route('admin.packages.index')); ?>" class="block focus:outline-none focus:ring-4 focus:ring-blue-200 rounded-lg" aria-labelledby="title-packages">
                    <div class="flex justify-between items-start mb-4">
                        
                        <div class="text-4xl filter grayscale group-hover:grayscale-0 transition" aria-hidden="true">📦</div>
                        <span class="bg-blue-100 text-blue-800 text-[10px] font-black px-3 py-1 rounded-full uppercase">Logistyka</span>
                    </div>
                    <h2 id="title-packages" class="text-xl font-black text-gray-900 uppercase tracking-tight mb-2 group-hover:text-blue-800 transition">
                        Przesyłki (PL ➔ NO)
                    </h2>
                    <p class="text-xs text-gray-700 font-bold leading-relaxed">
                        Zarządzaj pełnym procesem transportowym, numerami TRK, wagą i przypisaniem do pojazdów.
                    </p>
                    <div class="mt-6 flex items-center text-blue-800 font-black text-[10px] uppercase tracking-widest" aria-hidden="true">
                        Otwórz moduł →
                    </div>
                </a>
            </li>

            
            <li class="group bg-white p-8 rounded-xl shadow-xl border-2 border-gray-100 border-t-[12px] border-t-green-600 hover:shadow-2xl transition-all transform hover:-translate-y-1">
                <a href="<?php echo e(route('admin.invoices.index')); ?>" class="block focus:outline-none focus:ring-4 focus:ring-green-200 rounded-lg" aria-labelledby="title-invoices">
                    <div class="flex justify-between items-start mb-4">
                        <div class="text-4xl filter grayscale group-hover:grayscale-0 transition" aria-hidden="true">🧾</div>
                        <span class="bg-green-100 text-green-800 text-[10px] font-black px-3 py-1 rounded-full uppercase">Finanse</span>
                    </div>
                    <h2 id="title-invoices" class="text-xl font-black text-gray-900 uppercase tracking-tight mb-2 group-hover:text-green-600 transition">
                        Faktury i Rozliczenia
                    </h2>
                    <p class="text-xs text-gray-700 font-bold leading-relaxed">
                        Wystawianie dokumentów FV, monitorowanie statusów płatności i zestawienia dla klientów.
                    </p>
                    <div class="mt-6 flex items-center text-green-600 font-black text-[10px] uppercase tracking-widest" aria-hidden="true">
                        Sprawdź płatności →
                    </div>
                </a>
            </li>

            
            <li class="group bg-white p-8 rounded-xl shadow-xl border-2 border-gray-100 border-t-[12px] border-t-purple-600 hover:shadow-2xl transition-all transform hover:-translate-y-1">
                <a href="<?php echo e(route('admin.users.index')); ?>" class="block focus:outline-none focus:ring-4 focus:ring-purple-200 rounded-lg" aria-labelledby="title-users">
                    <div class="flex justify-between items-start mb-4">
                        <div class="text-4xl filter grayscale group-hover:grayscale-0 transition" aria-hidden="true">👥</div>
                        <span class="bg-purple-100 text-purple-800 text-[10px] font-black px-3 py-1 rounded-full uppercase">Kadry</span>
                    </div>
                    <h2 id="title-users" class="text-xl font-black text-gray-900 uppercase tracking-tight mb-2 group-hover:text-purple-600 transition">
                        Baza Użytkowników
                    </h2>
                    <p class="text-xs text-gray-700 font-bold leading-relaxed">
                        Zarządzaj kontami klientów, pracowników i administratorów. Edycja danych NIP i uprawnień.
                    </p>
                    <div class="mt-6 flex items-center text-purple-600 font-black text-[10px] uppercase tracking-widest" aria-hidden="true">
                        Zarządzaj rolami →
                    </div>
                </a>
            </li>

            
            <li class="group bg-white p-8 rounded-xl shadow-xl border-2 border-gray-100 border-t-[12px] border-t-orange-600 hover:shadow-2xl transition-all transform hover:-translate-y-1">
                <a href="<?php echo e(route('admin.warehouses.index')); ?>" class="block focus:outline-none focus:ring-4 focus:ring-orange-200 rounded-lg" aria-labelledby="title-warehouses">
                    <div class="flex justify-between items-start mb-4">
                        <div class="text-4xl filter grayscale group-hover:grayscale-0 transition" aria-hidden="true">🏢</div>
                        <span class="bg-orange-100 text-orange-800 text-[10px] font-black px-3 py-1 rounded-full uppercase">Infrastruktura</span>
                    </div>
                    <h2 id="title-warehouses" class="text-xl font-black text-gray-900 uppercase tracking-tight mb-2 group-hover:text-orange-600 transition">
                        Magazyny (PL)
                    </h2>
                    <p class="text-xs text-gray-700 font-bold leading-relaxed">
                        Lista punktów przeładunkowych, Magazyn Centralny oraz oddziały regionalne w Polsce.
                    </p>
                    <div class="mt-6 flex items-center text-orange-600 font-black text-[10px] uppercase tracking-widest" aria-hidden="true">
                        Punkty przeładunku →
                    </div>
                </a>
            </li>

            
            <li class="group bg-white p-8 rounded-xl shadow-xl border-2 border-gray-100 border-t-[12px] border-t-pink-600 hover:shadow-2xl transition-all transform hover:-translate-y-1">
                <a href="<?php echo e(route('admin.couriers.index')); ?>" class="block focus:outline-none focus:ring-4 focus:ring-pink-200 rounded-lg" aria-labelledby="title-couriers">
                    <div class="flex justify-between items-start mb-4">
                        <div class="text-4xl filter grayscale group-hover:grayscale-0 transition" aria-hidden="true">🚚</div>
                        <span class="bg-pink-100 text-pink-800 text-[10px] font-black px-3 py-1 rounded-full uppercase">Transport</span>
                    </div>
                    <h2 id="title-couriers" class="text-xl font-black text-gray-900 uppercase tracking-tight mb-2 group-hover:text-pink-600 transition">
                        Kierowcy i Flota
                    </h2>
                    <p class="text-xs text-gray-700 font-bold leading-relaxed">
                        Zarządzanie własną flotą pojazdów, numerami rejestracyjnymi i przypisywaniem kierowców.
                    </p>
                    <div class="mt-6 flex items-center text-pink-600 font-black text-[10px] uppercase tracking-widest" aria-hidden="true">
                        Zarządzaj flotą →
                    </div>
                </a>
            </li>

            
            <li class="group bg-white p-8 rounded-xl shadow-xl border-2 border-gray-100 border-t-[12px] border-t-yellow-500 hover:shadow-2xl transition-all transform hover:-translate-y-1">
                <a href="<?php echo e(route('admin.stats.index')); ?>" class="block focus:outline-none focus:ring-4 focus:ring-yellow-200 rounded-lg" aria-labelledby="title-stats">
                    <div class="flex justify-between items-start mb-4">
                        <div class="text-4xl filter grayscale group-hover:grayscale-0 transition" aria-hidden="true">📊</div>
                        <span class="bg-yellow-100 text-yellow-800 text-[10px] font-black px-3 py-1 rounded-full uppercase">Analiza</span>
                    </div>
                    <h2 id="title-stats" class="text-xl font-black text-gray-900 uppercase tracking-tight mb-2 group-hover:text-yellow-600 transition">
                        Raporty i Wydajność
                    </h2>
                    <p class="text-xs text-gray-700 font-bold leading-relaxed">
                        Statystyki przewozów, wydajność transportu oraz podsumowania finansowe okresu.
                    </p>
                    <div class="mt-6 flex items-center text-yellow-600 font-black text-[10px] uppercase tracking-widest" aria-hidden="true">
                        Zobacz raporty →
                    </div>
                </a>
            </li>
        </ul>
    </nav>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/magda/transport-app/resources/views/dashboards/admin.blade.php ENDPATH**/ ?>