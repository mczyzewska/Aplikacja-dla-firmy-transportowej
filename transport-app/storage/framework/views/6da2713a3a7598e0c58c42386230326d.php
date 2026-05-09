<?php $__env->startSection('content'); ?>
<div class="container mx-auto p-6 max-w-7xl">
    
    <header class="mb-10 border-b-4 border-blue-800 pb-4">
        <h1 id="page-title" class="text-4xl font-black text-gray-900 uppercase tracking-tighter">
            Moje Przesyłki
        </h1>
        <p class="text-gray-600 font-bold uppercase text-[10px] tracking-[0.3em] mt-1">
            Podgląd statusów i punktów odbioru dla Twoich zleceń (PL ➔ NO)
        </p>
    </header>

    
    <div class="bg-white shadow-2xl rounded-xl overflow-hidden border-2 border-gray-100">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse" aria-labelledby="page-title">
                <thead class="bg-gray-900 text-white uppercase text-[10px] tracking-[0.3em] font-black">
                    <tr>
                        
                        <th scope="col" class="p-5 border-b border-gray-800">Numer Trackingowy TRK</th>
                        <th scope="col" class="p-5 border-b border-gray-800">Punkt Odbioru (NO)</th>
                        <th scope="col" class="p-5 border-b border-gray-800 text-center">Status Operacyjny</th>
                        <th scope="col" class="p-5 border-b border-gray-800 text-center">Ostatnia Aktualizacja</th>
                    </tr>
                </thead>
                <tbody class="divide-y-2 divide-gray-50">
                    <?php $__empty_1 = true; $__currentLoopData = $packages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $package): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr class="hover:bg-blue-50 transition-colors">
                        
                        <td class="p-5 font-mono font-black text-blue-800 text-base uppercase tracking-tighter">
                            <?php echo e($package->tracking_number); ?>

                        </td>
                        
                        <td class="p-5">
                            <?php if($package->pickupPoint): ?>
                                <div class="font-black text-gray-900 uppercase text-xs tracking-tight">
                                    <?php echo e($package->pickupPoint->code); ?>

                                </div>
                                <div class="text-[10px] text-blue-700 font-black uppercase tracking-widest mt-1">
                                    <?php echo e($package->pickupPoint->city); ?>

                                </div>
                            <?php else: ?>
                                <span class="text-gray-400 font-bold italic uppercase text-[10px]">Brak danych o punkcie</span>
                            <?php endif; ?>
                        </td>

                        <td class="p-5 text-center">
                            <?php
                                $colors = [
                                    'dostarczona' => 'bg-green-100 text-green-900 border-green-300',
                                    'w_punkcie' => 'bg-purple-100 text-purple-900 border-purple-300',
                                    'w_transporcie' => 'bg-yellow-100 text-yellow-900 border-yellow-400',
                                    'odebrana' => 'bg-blue-100 text-blue-900 border-blue-300'
                                ];
                                $badge = $colors[$package->status] ?? 'bg-gray-100 text-gray-900 border-gray-300';
                            ?>
                            
                            <span role="status" class="px-4 py-1 rounded-lg text-[9px] font-black uppercase border-2 shadow-sm <?php echo e($badge); ?>">
                                <?php echo e(str_replace('_', ' ', $package->status)); ?>

                            </span>
                        </td>

                        <td class="p-5 text-center font-black text-gray-700 text-xs uppercase tracking-widest">
                            <?php echo e($package->updated_at->format('d.m.Y')); ?>

                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
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
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/magda/transport-app/resources/views/packages/my.blade.php ENDPATH**/ ?>