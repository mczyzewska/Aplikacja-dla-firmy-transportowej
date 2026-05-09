<?php $__env->startSection('content'); ?>
<div class="container mx-auto p-6 max-w-6xl">
    
    <div class="mb-10 border-b-4 border-blue-800 pb-4">
        <h1 class="text-4xl font-black text-gray-900 uppercase tracking-tighter">
            Moje Centrum Dowodzenia
        </h1>
        <p class="text-gray-500 font-bold uppercase text-[10px] tracking-[0.3em] mt-1">Witaj w Twoim profilu klienta Transport App</p>
    </div>

    
    <ul class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        
        
        <li class="group bg-white p-8 rounded-xl shadow-xl border-2 border-gray-100 border-t-[12px] border-t-blue-800 hover:shadow-2xl transition-all transform hover:-translate-y-1">
            <a href="<?php echo e(route('packages.my')); ?>" class="block">
                <div class="flex justify-between items-start mb-4">
                    <div class="text-4xl filter grayscale group-hover:grayscale-0 transition">📦</div>
                    <span class="bg-blue-100 text-blue-800 text-[10px] font-black px-3 py-1 rounded-full uppercase">Logistyka</span>
                </div>
                <h3 class="text-xl font-black text-gray-900 uppercase tracking-tight mb-2 group-hover:text-blue-800 transition">Moje Przesyłki</h3>
                <p class="text-xs text-gray-500 font-bold leading-relaxed">Sprawdzaj status swoich paczek na trasie PL ➔ NO, śledź numery TRK i historię doręczeń.</p>
                <div class="mt-6 flex items-center text-blue-800 font-black text-[10px] uppercase tracking-widest">
                    Śledź paczki →
                </div>
            </a>
        </li>

        
        <li class="group bg-white p-8 rounded-xl shadow-xl border-2 border-gray-100 border-t-[12px] border-t-green-600 hover:shadow-2xl transition-all transform hover:-translate-y-1">
            <a href="<?php echo e(route('client.invoices.index')); ?>" class="block">
                <div class="flex justify-between items-start mb-4">
                    <div class="text-4xl filter grayscale group-hover:grayscale-0 transition">🧾</div>
                    <span class="bg-green-100 text-green-800 text-[10px] font-black px-3 py-1 rounded-full uppercase">Finanse</span>
                </div>
                <h3 class="text-xl font-black text-gray-900 uppercase tracking-tight mb-2 group-hover:text-green-600 transition">Moje Faktury</h3>
                <p class="text-xs text-gray-500 font-bold leading-relaxed">Przeglądaj historię faktur, sprawdź terminy płatności za transport i pobierz dokumenty.</p>
                <div class="mt-6 flex items-center text-green-600 font-black text-[10px] uppercase tracking-widest">
                    Płatności i faktury →
                </div>
            </a>
        </li>

        
        <li class="group bg-white p-8 rounded-xl shadow-xl border-2 border-gray-100 border-t-[12px] border-t-purple-600 hover:shadow-2xl transition-all transform hover:-translate-y-1">
            <a href="<?php echo e(route('profile.edit')); ?>" class="block">
                <div class="flex justify-between items-start mb-4">
                    <div class="text-4xl filter grayscale group-hover:grayscale-0 transition">⚙️</div>
                    <span class="bg-purple-100 text-purple-800 text-[10px] font-black px-3 py-1 rounded-full uppercase">Profil</span>
                </div>
                <h3 class="text-xl font-black text-gray-900 uppercase tracking-tight mb-2 group-hover:text-purple-600 transition">Dane i Ustawienia</h3>
                <p class="text-xs text-gray-500 font-bold leading-relaxed">Zarządzaj swoimi danymi kontaktowymi, numerem NIP firmy oraz adresem domyślnym.</p>
                <div class="mt-6 flex items-center text-purple-600 font-black text-[10px] uppercase tracking-widest">
                    Edytuj profil →
                </div>
            </a>
        </li>

    </ul>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/magda/transport-app/resources/views/dashboards/client.blade.php ENDPATH**/ ?>