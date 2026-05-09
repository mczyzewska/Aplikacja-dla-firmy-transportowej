<?php $__env->startSection('content'); ?>
<div class="container mx-auto p-6 max-w-7xl">
    
    <header class="mb-10 border-b-4 border-blue-800 pb-4">
        <h1 id="page-title" class="text-4xl font-black text-gray-900 uppercase tracking-tighter">
            Logistyka Przesyłek (PL ➔ NO)
        </h1>
        <p class="text-gray-600 font-bold uppercase text-[10px] tracking-[0.3em] mt-1">
            Zarządzanie transportem międzynarodowym i ewidencja TRK
        </p>
    </header>


    
    <section aria-labelledby="form-heading" class="bg-white p-8 rounded-xl shadow-xl mb-10 border-2 border-gray-100 border-t-[12px] border-t-blue-800">
        <h2 id="form-heading" class="text-xl font-black mb-8 text-gray-900 uppercase tracking-tighter flex items-center italic">
            <span class="mr-3 text-blue-800" aria-hidden="true">📦</span> Przyjmij nową jednostkę transportową
        </h2>
        
        <form action="<?php echo e(route('admin.packages.store')); ?>" method="POST" class="space-y-8" novalidate>
            <?php echo csrf_field(); ?>
            <input type="hidden" name="status" value="odebrana">

            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <div>
                    <label for="tracking_number" class="block text-[10px] font-black text-gray-700 uppercase mb-2 tracking-widest">
                        Numer TRK <span class="text-red-600" aria-hidden="true">*</span>
                    </label>
                    <input type="text" id="tracking_number" name="tracking_number" 
                           value="<?php echo e(old('tracking_number', $suggestedNumber ?? '')); ?>" 
                           required aria-required="true"
                           class="w-full border-2 border-gray-100 rounded-lg p-3 font-black text-gray-900 focus:border-blue-800 focus:ring-4 focus:ring-blue-100 outline-none transition-all shadow-sm">
                </div>

                <div>
                    <label for="client_id" class="block text-[10px] font-black text-gray-700 uppercase mb-2 tracking-widest">
                        Zleceniodawca (Klient) <span class="text-red-600" aria-hidden="true">*</span>
                    </label>
                    <select id="client_id" name="client_id" required aria-required="true"
                            class="w-full border-2 border-gray-100 rounded-lg p-3 font-black text-gray-900 focus:border-blue-800 outline-none uppercase text-xs">
                        <option value="" disabled selected>— WYBIERZ KONTRAHENTA —</option>
                        <?php $__currentLoopData = $clients; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
                            <option value="<?php echo e($c->id); ?>" <?php echo e(old('client_id') == $c->id ? 'selected' : ''); ?>>
                                <?php echo e($c->user->name ?? $c->name); ?>

                            </option> 
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>

                <div>
                    <label for="warehouse_id" class="block text-[10px] font-black text-gray-700 uppercase mb-2 tracking-widest">
                        Magazyn Przyjęcia (PL) <span class="text-red-600" aria-hidden="true">*</span>
                    </label>
                    <select id="warehouse_id" name="warehouse_id" required aria-required="true"
                            class="w-full border-2 border-gray-100 rounded-lg p-3 font-black text-gray-900 focus:border-blue-800 outline-none uppercase text-xs">
                        <?php $__currentLoopData = $warehouses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $w): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($w->id); ?>"><?php echo e($w->name); ?> (<?php echo e($w->city); ?>)</option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>

                <div>
                    <label for="courier_id" class="block text-[10px] font-black text-gray-700 uppercase mb-2 tracking-widest">
                        Kierowca / Pojazd <span class="text-red-600" aria-hidden="true">*</span>
                    </label>
                    <select id="courier_id" name="courier_id" required aria-required="true"
                            class="w-full border-2 border-gray-100 rounded-lg p-3 font-black text-gray-900 focus:border-blue-800 outline-none uppercase text-xs">
                        <option value="" disabled selected>— PRZYPISZ TRANSPORT —</option>
                        <?php $__currentLoopData = $couriers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cr): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
                            <option value="<?php echo e($cr->id); ?>">
                                <?php echo e($cr->name); ?> [<?php echo e($cr->vehicle_number ?? $cr->company); ?>]
                            </option> 
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
            </div>

            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 items-end border-t-2 border-gray-50 pt-8">
                <div>
                    <label for="weight" class="block text-[10px] font-black text-gray-700 uppercase mb-2 tracking-widest">
                        Waga (KG) <span class="text-red-600" aria-hidden="true">*</span>
                    </label>
                    <input type="number" id="weight" name="weight" step="0.01" required aria-required="true"
                           class="w-full border-2 border-gray-100 rounded-lg p-3 font-black text-gray-900 focus:border-blue-800 focus:ring-4 focus:ring-blue-100 outline-none">
                </div>
                <div>
                    <label for="pickup_point_id" class="block text-[10px] font-black text-gray-700 uppercase mb-2 tracking-widest">
                        Punkt Docelowy (NO) <span class="text-red-600" aria-hidden="true">*</span>
                    </label>
                    <select id="pickup_point_id" name="pickup_point_id" required aria-required="true"
                            class="w-full border-2 border-gray-100 rounded-lg p-3 font-black text-gray-900 focus:border-blue-800 outline-none uppercase text-xs">
                        <?php $__currentLoopData = $pickupPoints; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
                            <option value="<?php echo e($p->id); ?>"><?php echo e($p->city); ?> (<?php echo e($p->code); ?>)</option> 
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                <button type="submit" class="bg-blue-800 hover:bg-black text-white font-black py-4 rounded-xl shadow-xl transition-all transform hover:-translate-y-1 active:scale-95 uppercase tracking-[0.2em] text-xs">
                    ➕ Zarejestruj Przesyłkę
                </button>
            </div>
        </form>
    </section>

    
    <section aria-labelledby="table-heading">
        <h2 id="table-heading" class="sr-only">Lista aktualnych przesyłek</h2>
        <div class="bg-white shadow-2xl rounded-xl overflow-hidden border-2 border-gray-100">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead class="bg-gray-900 text-white uppercase text-[10px] tracking-[0.3em] font-black">
                        <tr>
                            <th scope="col" class="p-5">ID / Numer TRK</th>
                            <th scope="col" class="p-5">Klient</th>
                            <th scope="col" class="p-5">Punkt PL</th>
                            <th scope="col" class="p-5">Flota / Transport</th>
                            <th scope="col" class="p-5">Waga</th>
                            <th scope="col" class="p-5">Cel (NO)</th>
                            <th scope="col" class="p-5">Status</th>
                            <th scope="col" class="p-5 text-center">Akcje</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y-2 divide-gray-50 text-sm">
                        <?php $__currentLoopData = $packages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $package): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr class="hover:bg-blue-50 transition-colors font-bold text-gray-700">
                            <td class="p-5 font-mono font-black text-blue-800 text-sm">
                                <?php echo e($package->tracking_number); ?>

                            </td>
                            <td class="p-5 uppercase tracking-tight">
                                <?php echo e($package->client->user->name ?? $package->client->name); ?>

                            </td>
                            <td class="p-5">
                                <span class="bg-gray-100 px-3 py-1 rounded text-[10px] font-black uppercase text-gray-600 border border-gray-200 shadow-sm">
                                    <?php echo e($package->warehouse->city ?? '—'); ?>

                                </span>
                            </td>
                            <td class="p-5">
                                <?php if($package->courier): ?>
                                    <div class="text-[10px] font-black text-gray-900 uppercase leading-tight"><?php echo e($package->courier->name); ?></div>
                                    <div class="font-mono text-[9px] text-blue-700 italic tracking-tighter">
                                        <?php echo e($package->courier->vehicle_number ?? $package->courier->company); ?>

                                    </div>
                                <?php else: ?>
                                    <span class="text-red-600 italic text-[10px] font-black uppercase">Brak przypisania</span>
                                <?php endif; ?>
                            </td>
                            <td class="p-5 font-black text-gray-900 uppercase">
                                <?php echo e(number_format($package->weight, 2)); ?> KG
                            </td>
                            <td class="p-5">
                                <?php if($package->pickupPoint): ?>
                                    <span class="bg-blue-50 px-3 py-1 rounded text-[10px] font-black uppercase text-blue-800 border border-blue-100 shadow-sm">
                                        <?php echo e($package->pickupPoint->city); ?>

                                    </span>
                                <?php else: ?>
                                    <span class="text-gray-400 italic text-[10px] uppercase">Brak punktu</span>
                                <?php endif; ?>
                            </td>
                            <td class="p-5">
                                <?php
                                    $color = match($package->status) {
                                        'dostarczona' => 'bg-green-100 text-green-800 border-green-300',
                                        'odebrana' => 'bg-blue-100 text-blue-800 border-blue-300',
                                        default => 'bg-yellow-100 text-yellow-800 border-yellow-300'
                                    };
                                ?>
                                <span role="status" class="px-3 py-1 rounded-lg text-[9px] font-black uppercase border-2 shadow-sm <?php echo e($color); ?>">
                                    <?php echo e(str_replace('_', ' ', $package->status)); ?>

                                </span>
                            </td>
                            <td class="p-5">
                                <div class="flex justify-center items-center gap-2">
                                    <a href="<?php echo e(route('admin.packages.edit', $package)); ?>" 
                                       [cite_start]aria-label="Edytuj przesyłkę: <?php echo e($package->tracking_number); ?>" 
                                       class="bg-blue-800 hover:bg-black text-white px-4 py-2 rounded-lg text-[10px] font-black uppercase transition shadow-md">
                                        Edycja
                                    </a>
                                    
                                    <form action="<?php echo e(route('admin.packages.destroy', $package)); ?>" method="POST" 
                                          onsubmit="return confirm('Trwale usunąć rekord przesyłki <?php echo e($package->tracking_number); ?>?')">
                                        <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                        <button type="submit" 
                                                [cite_start]aria-label="Usuń przesyłkę: <?php echo e($package->tracking_number); ?>" 
                                                class="bg-red-700 hover:bg-black text-white px-4 py-2 rounded-lg text-[10px] font-black uppercase transition shadow-md">
                                            Usuń
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/magda/transport-app/resources/views/packages/index.blade.php ENDPATH**/ ?>