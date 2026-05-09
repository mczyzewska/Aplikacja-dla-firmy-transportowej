<?php $__env->startSection('content'); ?>
<div class="container mx-auto p-6 max-w-7xl">
    
    <header class="mb-10 border-b-4 border-blue-800 pb-4">
        <h1 id="page-title" class="text-4xl font-black text-gray-900 uppercase tracking-tighter">
            Moje Faktury: <?php echo e($client->user->name ?? $client->name ?? 'Mój Profil'); ?>

        </h1>
        <p class="text-gray-600 font-bold uppercase text-[10px] tracking-[0.3em] mt-1">
            Ewidencja dokumentów finansowych i statusów płatności
        </p>
    </header>

    
    <div class="bg-white shadow-2xl rounded-xl overflow-hidden border-2 border-gray-100">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse" aria-labelledby="page-title">
                <thead class="bg-gray-900 text-white uppercase text-[10px] tracking-[0.3em] font-black">
                    <tr>
                        
                        <th scope="col" class="p-5 border-b border-gray-800">Numer Dokumentu</th>
                        <th scope="col" class="p-5 border-b border-gray-800">Data Wystawienia</th>
                        <th scope="col" class="p-5 border-b border-gray-800">Kwota do zapłaty</th>
                        <th scope="col" class="p-5 border-b border-gray-800 text-center">Status</th>
                        <th scope="col" class="p-5 border-b border-gray-800 text-center">Zarządzanie</th>
                    </tr>
                </thead>
                <tbody class="divide-y-2 divide-gray-50">
                    <?php $__empty_1 = true; $__currentLoopData = $invoices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $invoice): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr class="hover:bg-blue-50 transition-colors">
                        
                        <td class="p-5 font-mono font-black text-blue-800 text-base uppercase tracking-tighter">
                            FV/<?php echo e($invoice->id); ?>

                        </td>
                        
                        <td class="p-5 font-black text-gray-900 uppercase text-xs tracking-widest">
                            <?php echo e(\Carbon\Carbon::parse($invoice->issue_date)->format('d.m.Y')); ?>

                        </td>

                        <td class="p-5 font-mono font-black text-gray-900 text-base">
                            <?php echo e(number_format($invoice->total_price, 2)); ?> PLN
                        </td>
                        
                        <td class="p-5 text-center">
                            <?php
                                $statusLower = strtolower($invoice->status);
                                $isPaid = in_array($statusLower, ['opłacona', 'paid']);
                            ?>
                            
                            <span role="status" class="inline-block px-4 py-1 rounded-lg text-[9px] font-black uppercase border-2 shadow-sm 
                                <?php echo e($isPaid 
                                    ? 'bg-green-100 text-green-900 border-green-300' 
                                    : 'bg-red-100 text-red-900 border-red-300'); ?>">
                                <span class="mr-1" aria-hidden="true"><?php echo e($isPaid ? '●' : '○'); ?></span>
                                <?php echo e($invoice->status); ?>

                            </span>
                        </td>

                        <td class="p-5">
                            <div class="flex justify-center">
                                <a href="<?php echo e(route('client.invoices.show', $invoice)); ?>" 
                                   [cite_start]aria-label="Szczegóły faktury numer FV/<?php echo e($invoice->id); ?>" 
                                   class="bg-blue-800 hover:bg-black text-white px-6 py-2 rounded-lg font-black uppercase text-[10px] tracking-widest shadow-md transition-all transform hover:-translate-y-0.5">
                                    Szczegóły
                                </a>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="5" class="p-20 text-center bg-gray-50">
                            <div class="flex flex-col items-center">
                                <span class="text-5xl mb-4 grayscale" aria-hidden="true">🧾</span>
                                <p class="text-gray-500 font-black uppercase tracking-[0.4em] text-xs italic">
                                    Nie posiadasz jeszcze wystawionych faktur
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
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/magda/transport-app/resources/views/client/invoices/index.blade.php ENDPATH**/ ?>