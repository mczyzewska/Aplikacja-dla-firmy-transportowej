<?php $__env->startSection('content'); ?>
<div class="container mx-auto p-6 max-w-5xl">
    
    <header class="mb-10 border-b-4 border-blue-800 pb-4">
        <h1 class="text-4xl font-black text-gray-900 uppercase tracking-tighter">
            Pełna Edycja Przesyłki: <?php echo e($package->tracking_number); ?>

        </h1>
        <p class="text-gray-600 font-bold uppercase text-[10px] tracking-[0.3em] mt-1">
            Modyfikacja parametrów logistycznych i statusów operacyjnych jednostki TRK
        </p>
    </header>

    

    
    <div class="bg-white p-10 rounded-xl shadow-2xl border-2 border-gray-100 border-t-[12px] border-t-blue-800">
        <form action="<?php echo e(route('admin.packages.update', $package)); ?>" method="POST" class="space-y-10" novalidate>
            <?php echo csrf_field(); ?> <?php echo method_field('PUT'); ?>

            
            <section aria-labelledby="section-basic">
                <h3 id="section-basic" class="text-blue-800 font-black uppercase text-xs tracking-[0.2em] mb-6 flex items-center">
                    <span class="mr-3" aria-hidden="true">🔑</span> Dane Podstawowe Identyfikacyjne
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 pb-10 border-b-4 border-gray-50">
                    
                    <div>
                        <label for="tracking_number" class="block text-[10px] font-black text-gray-700 uppercase mb-2 tracking-widest">
                            Numer Trackingowy TRK <span class="text-red-600" aria-hidden="true">*</span>
                        </label>
                        <input type="text" id="tracking_number" name="tracking_number" 
                               value="<?php echo e(old('tracking_number', $package->tracking_number)); ?>" 
                               required aria-required="true"
                               aria-invalid="<?php echo e($errors->has('tracking_number') ? 'true' : 'false'); ?>"
                               class="w-full border-2 border-gray-100 rounded-lg p-3 font-black text-gray-900 focus:border-blue-800 focus:ring-4 focus:ring-blue-50 outline-none transition-all shadow-sm">
                    </div>

                    
                    <div>
                        <label for="client_id" class="block text-[10px] font-black text-gray-700 uppercase mb-2 tracking-widest">
                            Zleceniodawca (Klient) <span class="text-red-600" aria-hidden="true">*</span>
                        </label>
                        <select id="client_id" name="client_id" required aria-required="true"
                                class="w-full border-2 border-gray-100 rounded-lg p-3 font-black text-gray-900 focus:border-blue-800 outline-none uppercase text-xs">
                            <?php $__currentLoopData = $clients; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($c->id); ?>" <?php echo e($package->client_id == $c->id ? 'selected' : ''); ?>>
                                    <?php echo e($c->user->name ?? $c->name); ?>

                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                </div>
            </section>

            
            <section aria-labelledby="section-logistics">
                <h3 id="section-logistics" class="text-blue-800 font-black uppercase text-xs tracking-[0.2em] mb-6 flex items-center">
                    <span class="mr-3" aria-hidden="true">🚛</span> Planowanie Logistyki i Transportu
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8 pb-10 border-b-4 border-gray-50">
                    <div>
                        <label for="warehouse_id" class="block text-[10px] font-black text-gray-700 uppercase mb-2 tracking-widest">Magazyn Przyjęcia (PL)</label>
                        <select id="warehouse_id" name="warehouse_id" 
                                class="w-full border-2 border-gray-100 rounded-lg p-3 font-black text-gray-900 focus:border-blue-800 outline-none uppercase text-xs">
                            <?php $__currentLoopData = $warehouses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $w): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($w->id); ?>" <?php echo e($package->warehouse_id == $w->id ? 'selected' : ''); ?>>
                                    <?php echo e($w->name); ?> (<?php echo e($w->city); ?>)
                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>

                    <div>
                        <label for="courier_id" class="block text-[10px] font-black text-gray-700 uppercase mb-2 tracking-widest">Kierowca / Pojazd</label>
                        <select id="courier_id" name="courier_id" 
                                class="w-full border-2 border-gray-100 rounded-lg p-3 font-black text-gray-900 focus:border-blue-800 outline-none uppercase text-xs">
                            <?php $__currentLoopData = $couriers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cr): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($cr->id); ?>" <?php echo e($package->courier_id == $cr->id ? 'selected' : ''); ?>>
                                    <?php echo e($cr->name); ?> [<?php echo e($cr->vehicle_number ?? $cr->company); ?>]
                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>

                    <div>
                        <label for="pickup_point_id" class="block text-[10px] font-black text-gray-700 uppercase mb-2 tracking-widest">Punkt Celowy (NO)</label>
                        <select id="pickup_point_id" name="pickup_point_id" 
                                class="w-full border-2 border-gray-100 rounded-lg p-3 font-black text-gray-900 focus:border-blue-800 outline-none uppercase text-xs">
                            <?php $__currentLoopData = $pickupPoints; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($p->id); ?>" <?php echo e($package->pickup_point_id == $p->id ? 'selected' : ''); ?>>
                                    <?php echo e($p->city); ?> (<?php echo e($p->code); ?>)
                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                </div>
            </section>

            
            <section aria-labelledby="section-params">
                <h3 id="section-params" class="text-blue-800 font-black uppercase text-xs tracking-[0.2em] mb-6 flex items-center">
                    <span class="mr-3" aria-hidden="true">⚖️</span> Weryfikacja Parametrów i Statusu
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div>
                        <label for="weight" class="block text-[10px] font-black text-gray-700 uppercase mb-2 tracking-widest">Waga brutto (KG)</label>
                        <input type="number" id="weight" step="0.01" name="weight" 
                               value="<?php echo e(old('weight', $package->weight)); ?>" 
                               aria-invalid="<?php echo e($errors->has('weight') ? 'true' : 'false'); ?>"
                               class="w-full border-2 border-gray-100 rounded-lg p-3 font-black text-gray-900 focus:border-blue-800 focus:ring-4 focus:ring-blue-100 outline-none transition-all">
                    </div>

                    <div>
                        <label for="status" class="block text-[10px] font-black text-blue-800 uppercase mb-2 tracking-widest">Aktualny Status Przesyłki</label>
                        <select id="status" name="status" 
                                class="w-full border-2 border-blue-100 rounded-lg p-3 font-black text-sm bg-blue-50 focus:border-blue-800 focus:ring-4 focus:ring-blue-100 outline-none transition-all uppercase">
                            <?php $__currentLoopData = ['odebrana', 'w_transporcie', 'w_punkcie', 'dostarczona']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $st): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($st); ?>" <?php echo e($package->status == $st ? 'selected' : ''); ?>>
                                    ● <?php echo e(str_replace('_', ' ', $st)); ?>

                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                </div>
            </section>

            
            <div class="flex items-center justify-between border-t-4 border-gray-900 pt-10 mt-10">
                <a href="<?php echo e(route('admin.packages.index')); ?>" 
                   aria-label="Anuluj edycję i wróć do listy przesyłek"
                   class="text-[10px] font-black text-gray-400 hover:text-red-700 uppercase tracking-[0.3em] transition-colors">
                    ← Porzuć zmiany
                </a>
                <button type="submit" 
                        class="bg-blue-800 hover:bg-black text-white px-16 py-5 rounded-xl font-black shadow-xl transition-all transform hover:-translate-y-1 active:scale-95 uppercase tracking-[0.2em] text-xs focus:ring-4 focus:ring-blue-100">
                    Zaktualizuj dane w systemie
                </button>
            </div>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/magda/transport-app/resources/views/packages/edit.blade.php ENDPATH**/ ?>