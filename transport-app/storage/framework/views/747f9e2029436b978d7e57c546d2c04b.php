<?php $__env->startSection('content'); ?>
<div class="container mx-auto p-6 max-w-7xl">
    
    <div class="mb-10 border-b-4 border-blue-800 pb-4">
        <h1 class="text-4xl font-black text-gray-900 uppercase tracking-tighter">
            Faktury i Rozliczenia
        </h1>
        <p class="text-gray-600 font-bold uppercase text-[10px] tracking-[0.3em] mt-1">
            Ewidencja dokumentów finansowych i statusów płatności
        </p>
    </div>

    
    <div class="mb-8">
        <a href="<?php echo e(route('admin.invoices.create')); ?>"
           class="inline-flex items-center bg-green-700 hover:bg-black text-white px-8 py-4 rounded-xl font-black shadow-xl transition-all transform hover:-translate-y-1 active:scale-95 uppercase tracking-[0.2em] text-xs">
            <span class="mr-3 text-xl" aria-hidden="true">➕</span> Nowa faktura
        </a>
    </div>

    
    <div class="bg-white shadow-2xl rounded-xl overflow-hidden border-2 border-gray-100 border-t-[12px]">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead class="bg-gray-900 text-white uppercase text-[10px] tracking-[0.3em] font-black">
                    <tr>
                        <th scope="col" class="p-5 border-b border-gray-800">Numer</th>
                        <th scope="col" class="p-5 border-b border-gray-800">Zleceniodawca</th>
                        <th scope="col" class="p-5 border-b border-gray-800 text-right">Kwota Brutto</th>
                        <th scope="col" class="p-5 border-b border-gray-800 text-center">Status</th>
                        <th scope="col" class="p-5 border-b border-gray-800 text-center">Zarządzanie</th>
                    </tr>
                </thead>
                <tbody class="divide-y-2 divide-gray-50 text-sm">
                    <?php $__empty_1 = true; $__currentLoopData = $invoices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $invoice): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr class="hover:bg-green-50 transition-colors">
                        <td class="p-5 font-mono font-black text-blue-800 text-base">
                            FV/<?php echo e($invoice->id); ?>

                        </td>
                        <td class="p-5 font-black text-gray-900 uppercase tracking-tight">
                            <?php echo e($invoice->client->user->name ?? 'Klient nieznany'); ?>

                        </td>
                        <td class="p-5 font-mono font-black text-gray-900 text-right">
                            <?php echo e(number_format($invoice->total_price, 2)); ?> PLN
                        </td>
                        
                        <td class="p-5 text-center">
                            <?php
                                $statusLower = strtolower($invoice->status);
                                $isPaid = in_array($statusLower, ['opłacona', 'paid']);
                            ?>
                            <span class="inline-block px-4 py-1 rounded-lg text-[10px] font-black uppercase border-2 
                                <?php echo e($isPaid 
                                    ? 'bg-green-100 text-green-800 border-green-200' 
                                    : 'bg-red-100 text-red-800 border-red-200'); ?>">
                                <span class="mr-1" aria-hidden="true"><?php echo e($isPaid ? '●' : '○'); ?></span>
                                <?php echo e($invoice->status); ?>

                            </span>
                        </td>

                        <td class="p-5">
                            <div class="flex justify-center items-center gap-2">
                                
                                <a href="<?php echo e(route('admin.invoices.show', $invoice)); ?>" 
                                   aria-label="Podgląd faktury FV/<?php echo e($invoice->id); ?>"
                                   class="bg-blue-800 text-white px-4 py-2 rounded font-black uppercase text-[10px] tracking-widest hover:bg-black transition shadow-md">
                                    Szczegóły
                                </a>

                                
                                <a href="<?php echo e(route('admin.invoices.edit', $invoice)); ?>" 
                                   aria-label="Edytuj fakturę FV/<?php echo e($invoice->id); ?>"
                                   class="bg-yellow-600 text-white px-4 py-2 rounded font-black uppercase text-[10px] tracking-widest hover:bg-black transition shadow-md">
                                    Edycja
                                </a>

                                
                                <?php if(auth()->user() && auth()->user()->role === 'admin'): ?>
                                    <form action="<?php echo e(route('admin.invoices.destroy', $invoice)); ?>"
                                          method="POST"
                                          onsubmit="return confirm('Czy na pewno chcesz usunąć fakturę FV/<?php echo e($invoice->id); ?>?')">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                        <button aria-label="Usuń fakturę FV/<?php echo e($invoice->id); ?>"
                                                class="bg-red-700 text-white px-4 py-2 rounded font-black uppercase text-[10px] tracking-widest hover:bg-black transition shadow-md">
                                            Usuń
                                        </button>
                                    </form>
                                <?php endif; ?>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="5" class="p-20 text-center">
                            <div class="flex flex-col items-center">
                                <span class="text-6xl mb-4 grayscale" aria-hidden="true">📑</span>
                                <p class="text-gray-400 font-black uppercase tracking-[0.4em] text-xs italic">
                                    Brak wystawionych dokumentów w systemie
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
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/magda/transport-app/resources/views/admin/invoices/index.blade.php ENDPATH**/ ?>