<?php $__env->startSection('content'); ?>
<div class="container mx-auto p-6 max-w-7xl">
    
    <div class="mb-10 border-b-4 border-blue-800 pb-4">
        <h1 class="text-4xl font-black text-gray-900 uppercase tracking-tighter">
            Infrastruktura: Magazyny Przeładunkowe
        </h1>
        <p class="text-gray-600 font-bold uppercase text-[10px] tracking-[0.3em] mt-1">
            Ewidencja punktów logistycznych i regionalnych centrów dystrybucji
        </p>
    </div>

    
    <?php if($errors->any()): ?>
        <div role="alert" class="mb-8 bg-red-50 border-l-8 border-red-600 p-4 rounded-md shadow-sm">
            <div class="flex items-center mb-2">
                <span class="text-xl mr-2" aria-hidden="true">⚠️</span>
                <h2 class="text-red-900 font-black uppercase tracking-tight text-sm">Błąd rejestracji jednostki:</h2>
            </div>
            <ul class="text-xs text-red-700 font-bold uppercase tracking-wider space-y-1">
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li>• <?php echo e($error); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
    <?php endif; ?>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
        
        <section aria-labelledby="add-warehouse-title">
            <div class="bg-white p-8 rounded-xl shadow-xl border-2 border-gray-100 border-t-[12px] border-t-orange-600">
                <h2 id="add-warehouse-title" class="text-xl font-black mb-8 text-gray-900 uppercase tracking-tighter italic">
                    🏢 Rejestracja Jednostki
                </h2>
                
                <form action="<?php echo e(route('admin.warehouses.store')); ?>" method="POST" class="space-y-6" novalidate>
                    <?php echo csrf_field(); ?>
                    <div>
                        <label for="name" class="block text-[10px] font-black text-gray-700 uppercase mb-2 tracking-widest">
                            Pełna nazwa magazynu <span class="text-red-600" aria-hidden="true">*</span>
                        </label>
                        <input type="text" id="name" name="name" required aria-required="true"
                               aria-invalid="<?php echo e($errors->has('name') ? 'true' : 'false'); ?>"
                               class="w-full border-2 border-gray-100 rounded-lg p-3 font-black text-gray-900 focus:border-orange-600 focus:ring-4 focus:ring-orange-50 outline-none transition-all shadow-sm">
                    </div>

                    <div>
                        <label for="location" class="block text-[10px] font-black text-gray-700 uppercase mb-2 tracking-widest">
                            Lokalizacja (Adres/Miasto) <span class="text-red-600" aria-hidden="true">*</span>
                        </label>
                        <input type="text" id="location" name="location" required aria-required="true"
                               aria-invalid="<?php echo e($errors->has('location') ? 'true' : 'false'); ?>"
                               class="w-full border-2 border-gray-100 rounded-lg p-3 font-black text-gray-900 focus:border-orange-600 focus:ring-4 focus:ring-orange-50 outline-none transition-all shadow-sm">
                    </div>

                    <button type="submit" class="w-full bg-orange-600 hover:bg-black text-white font-black py-4 rounded-lg shadow-lg uppercase text-xs tracking-[0.2em] transition transform hover:-translate-y-1 active:scale-95">
                        ➕ Zarejestruj punkt
                    </button>
                </form>
            </div>
        </section>

        
        <section class="lg:col-span-2" aria-labelledby="list-warehouse-title">
            <h2 id="list-warehouse-title" class="sr-only">Lista zarejestrowanych magazynów</h2>
            <div class="bg-white shadow-2xl rounded-xl overflow-hidden border-2 border-gray-100">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead class="bg-gray-900 text-white uppercase text-[10px] tracking-[0.3em] font-black">
                            <tr>
                                <th scope="col" class="p-5">Nazwa jednostki</th>
                                <th scope="col" class="p-5">Adres operacyjny</th>
                                <th scope="col" class="p-5 text-center">Zarządzanie</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y-2 divide-gray-50 text-sm">
                            <?php $__empty_1 = true; $__currentLoopData = $warehouses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $warehouse): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr class="hover:bg-orange-50 transition-colors">
                                    <td class="p-5 font-black text-gray-900 uppercase tracking-tight">
                                        <?php echo e($warehouse->name); ?>

                                    </td>
                                    <td class="p-5 text-gray-700 font-bold italic uppercase text-xs">
                                        <?php echo e($warehouse->location); ?>

                                    </td>
                                    <td class="p-5 text-center">
                                        <form action="<?php echo e(route('admin.warehouses.destroy', $warehouse)); ?>" method="POST"
                                              onsubmit="return confirm('Czy na pewno chcesz usunąć magazyn <?php echo e($warehouse->name); ?>?')">
                                            <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                            <button type="submit" 
                                                    aria-label="Usuń magazyn: <?php echo e($warehouse->name); ?>"
                                                    class="bg-red-700 text-white px-5 py-2 rounded font-black uppercase text-[10px] tracking-widest hover:bg-black shadow-md transition transform hover:-translate-y-0.5 active:scale-90">
                                                Usuń
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <tr>
                                    <td colspan="3" class="p-20 text-center">
                                        <p class="text-gray-400 font-black uppercase tracking-[0.4em] text-xs italic">
                                            Brak punktów przeładunkowych w bazie danych
                                        </p>
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/magda/transport-app/resources/views/admin/warehouses/index.blade.php ENDPATH**/ ?>