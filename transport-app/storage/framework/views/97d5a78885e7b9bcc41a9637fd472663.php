<?php $__env->startSection('content'); ?>
<div class="container mx-auto p-6 max-w-5xl">
    
    <div class="mb-10 border-b-4 border-blue-800 pb-4">
        <h1 class="text-4xl font-black text-gray-900 uppercase tracking-tighter">
            Wystaw Nową Fakturę
        </h1>
        <p class="text-gray-600 font-bold uppercase text-[10px] tracking-[0.3em] mt-1">Moduł Finansowy: Generowanie dokumentów obciążeniowych</p>
    </div>

    
    <div class="bg-white p-6 rounded-xl shadow-xl border-2 border-gray-100 border-t-[12px] border-t-blue-800 mb-8">
        <form method="GET" action="<?php echo e(route('admin.invoices.create')); ?>" id="client_form" novalidate>
            <label for="client_id" class="block text-[10px] font-black text-blue-800 uppercase mb-3 tracking-[0.2em]">
                Krok 1: Wybierz zleceniodawcę, aby załadować paczki
            </label>
            <div class="flex flex-wrap gap-4">
                <select name="client_id" id="client_id" onchange="this.form.submit()" 
                        class="flex-1 h-14 border-2 border-gray-100 rounded-lg px-4 font-black text-sm uppercase outline-none shadow-sm focus:border-blue-800 focus:ring-4 focus:ring-blue-100 transition-all">
                    <option value="">— WYBIERZ KLIENTA Z LISTY —</option>
                    <?php $__currentLoopData = $clients; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $client): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($client->id); ?>" <?php echo e(request('client_id') == $client->id ? 'selected' : ''); ?>>
                            <?php echo e($client->user->name ?? $client->name); ?>

                        </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                <noscript>
                    <button type="submit" class="bg-blue-800 text-white px-8 h-14 rounded-lg font-black uppercase text-xs tracking-widest hover:bg-black transition-all">Załaduj</button>
                </noscript>
            </div>
        </form>
    </div>

    <?php if(request('client_id') && $selectedClient): ?>
    <div class="bg-white p-8 rounded-xl shadow-xl border-2 border-gray-100 border-t-[12px] border-t-green-600">
        <form method="POST" action="<?php echo e(route('admin.invoices.store')); ?>" novalidate>
            <?php echo csrf_field(); ?>
            <input type="hidden" name="client_id" value="<?php echo e($selectedClient->id); ?>">

            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
                <div>
                    <label for="nip" class="block text-[10px] font-black text-gray-700 uppercase mb-2 tracking-widest">NIP Faktury</label>
                    <input type="text" name="nip" id="nip" value="<?php echo e(old('nip', $selectedClient->nip)); ?>"
                           class="w-full h-12 border-2 border-gray-100 rounded-lg px-4 bg-gray-50 focus:border-green-600 focus:ring-4 focus:ring-green-100 outline-none font-bold transition">
                </div>

                <div>
                    <label for="status" class="block text-[10px] font-black text-gray-700 uppercase mb-2 tracking-widest">Status Płatności</label>
                    <select name="status" id="status" class="w-full h-12 border-2 border-gray-100 rounded-lg px-4 bg-gray-50 focus:border-green-600 outline-none font-bold transition">
                        <option value="unpaid">🔴 NIEOPŁACONA</option>
                        <option value="paid">🟢 OPŁACONA</option>
                    </select>
                </div>

                <div>
                    <label for="issue_date" class="block text-[10px] font-black text-gray-700 uppercase mb-2 tracking-widest">Data Wystawienia</label>
                    <input type="date" name="issue_date" id="issue_date" value="<?php echo e(now()->toDateString()); ?>" class="w-full h-12 border-2 border-gray-100 rounded-lg px-4 bg-gray-50 font-bold" required aria-required="true">
                </div>

                <div>
                    <label for="due_date" class="block text-[10px] font-black text-gray-700 uppercase mb-2 tracking-widest">Termin Płatności</label>
                    <input type="date" name="due_date" id="due_date" value="<?php echo e(now()->addDays(14)->toDateString()); ?>" class="w-full h-12 border-2 border-gray-100 rounded-lg px-4 bg-gray-50 font-bold" required aria-required="true">
                </div>
            </div>

            
            <h2 class="text-2xl font-black text-gray-900 mb-6 uppercase tracking-tighter flex items-center">
                <span class="mr-3" aria-hidden="true">📦</span> Krok 2: Zaznacz przesyłki i ustal stawki
            </h2>

            <div class="bg-gray-50 rounded-xl overflow-hidden border-2 border-gray-100 mb-8">
                <table class="w-full text-left border-collapse">
                    <thead class="bg-gray-900 text-white uppercase text-[10px] tracking-[0.3em] font-black">
                        <tr>
                            <th scope="col" class="p-5 w-20 text-center">Dodaj</th>
                            <th scope="col" class="p-5">Szczegóły przesyłki (TRK / Waga)</th>
                            <th scope="col" class="p-5 w-48 text-right">Cena (PLN)</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y-2 divide-gray-100">
                        <?php $__empty_1 = true; $__currentLoopData = $packages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $package): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr class="hover:bg-green-50 transition-colors">
                            <td class="p-5 text-center">
                                <input type="checkbox" name="items[<?php echo e($index); ?>][package_id]" id="pkg_<?php echo e($package->id); ?>" value="<?php echo e($package->id); ?>" 
                                       aria-label="Dołącz paczkę <?php echo e($package->tracking_number); ?> do faktury"
                                       class="w-6 h-6 rounded border-gray-300 text-green-600 focus:ring-green-500 shadow-sm cursor-pointer">
                            </td>
                            <td class="p-5">
                                <label for="pkg_<?php echo e($package->id); ?>" class="cursor-pointer">
                                    <div class="font-black text-gray-900 uppercase tracking-tight text-sm"><?php echo e($package->tracking_number); ?></div>
                                    <div class="text-[10px] text-gray-500 font-black uppercase tracking-widest mt-1">Waga: <?php echo e($package->weight); ?> KG</div>
                                </label>
                            </td>
                            <td class="p-5">
                                <div class="relative">
                                    <input type="number" step="0.01" name="items[<?php echo e($index); ?>][price]" 
                                           aria-label="Cena netto dla paczki <?php echo e($package->tracking_number); ?>"
                                           class="w-full border-2 border-gray-200 rounded-lg p-3 text-right font-black text-sm focus:border-green-600 focus:ring-4 focus:ring-green-100 outline-none transition-all" 
                                           placeholder="0.00">
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="3" class="p-20 text-center">
                                <div class="flex flex-col items-center">
                                    <span class="text-4xl mb-4 grayscale" aria-hidden="true">🏜️</span>
                                    <div class="text-gray-400 font-black uppercase text-xs tracking-[0.4em] italic">Brak niezafakturowanych paczek</div>
                                </div>
                            </td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            
            <div class="flex items-center justify-between pt-8 border-t-4 border-gray-50">
                <a href="<?php echo e(route('admin.invoices.index')); ?>" class="text-[10px] font-black text-gray-400 uppercase tracking-[0.3em] hover:text-red-600 transition-colors">
                    ← Anuluj i wróć do listy
                </a>
                <button type="submit" class="bg-green-700 hover:bg-black text-white px-12 py-5 rounded-xl font-black shadow-xl transition-all uppercase tracking-[0.2em] text-xs transform hover:-translate-y-1 active:scale-95 disabled:opacity-30 disabled:hover:translate-y-0"
                        <?php echo e($packages->isEmpty() ? 'disabled' : ''); ?>>
                    Generuj i wystaw Fakturę
                </button>
            </div>
        </form>
    </div>
    <?php else: ?>
        <div class="text-center py-32 bg-gray-50 border-4 border-dashed border-gray-200 rounded-2xl">
            <div class="text-6xl mb-6 opacity-20" aria-hidden="true">👤</div>
            <p class="text-gray-400 font-black uppercase tracking-[0.5em] text-xs italic">Oczekiwanie na wybór klienta...</p>
        </div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/magda/transport-app/resources/views/admin/invoices/create.blade.php ENDPATH**/ ?>