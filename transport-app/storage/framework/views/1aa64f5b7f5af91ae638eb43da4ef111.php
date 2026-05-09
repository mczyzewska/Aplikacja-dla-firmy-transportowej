<?php $__env->startSection('content'); ?>
<div class="container mx-auto p-6 max-w-4xl">
    
    <div class="mb-10 border-b-4 border-blue-800 pb-4">
        <h1 class="text-4xl font-black text-gray-900 uppercase tracking-tighter">
            Edycja Profilu: <?php echo e($user->name); ?>

        </h1>
        <p class="text-gray-600 font-bold uppercase text-[10px] tracking-[0.3em] mt-1">
            Zarządzanie uprawnieniami i danymi identyfikacyjnymi w systemie
        </p>
    </div>

    

    
    <div class="bg-white p-10 rounded-xl shadow-2xl border-2 border-gray-100 border-t-[12px] border-t-purple-600">
        
        <div class="flex flex-wrap items-center justify-between mb-10 pb-6 border-b-4 border-gray-50 gap-4">
            <h2 class="text-2xl font-black text-gray-900 uppercase tracking-tighter italic">Dane systemowe</h2>
            
            
            <?php
                $roleColors = [
                    'admin' => 'bg-red-100 text-red-800 border-red-300',
                    'employee' => 'bg-blue-100 text-blue-800 border-blue-300',
                    'client' => 'bg-green-100 text-green-800 border-green-300'
                ];
            ?>
            <div role="status" class="px-6 py-2 rounded-lg text-xs font-black uppercase border-2 <?php echo e($roleColors[$user->role] ?? 'bg-gray-100'); ?> shadow-sm">
                Rola: <?php echo e($user->role); ?>

            </div>
        </div>

        <form action="<?php echo e(route('admin.users.update', $user)); ?>" method="POST" novalidate>
            <?php echo csrf_field(); ?> 
            <?php echo method_field('PUT'); ?>

            <div class="space-y-8">
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div>
                        <label for="name" class="block text-[10px] font-black text-gray-700 uppercase mb-2 tracking-[0.2em]">
                            Pełna Nazwa / Firma <span class="text-red-600" aria-hidden="true">*</span>
                        </label>
                        <input type="text" id="name" name="name" value="<?php echo e(old('name', $user->name)); ?>" required 
                               aria-required="true"
                               aria-invalid="<?php echo e($errors->has('name') ? 'true' : 'false'); ?>"
                               class="w-full border-2 border-gray-100 rounded-lg p-3 font-black text-gray-900 focus:border-purple-600 focus:ring-4 focus:ring-purple-50 outline-none transition-all shadow-sm">
                    </div>

                    <div>
                        <label for="email" class="block text-[10px] font-black text-gray-700 uppercase mb-2 tracking-[0.2em]">
                            Adres E-mail <span class="text-red-600" aria-hidden="true">*</span>
                        </label>
                        <input type="email" id="email" name="email" value="<?php echo e(old('email', $user->email)); ?>" required 
                               aria-required="true"
                               aria-invalid="<?php echo e($errors->has('email') ? 'true' : 'false'); ?>"
                               class="w-full border-2 border-gray-100 rounded-lg p-3 font-mono font-black text-gray-900 focus:border-purple-600 focus:ring-4 focus:ring-purple-50 outline-none transition-all shadow-sm uppercase">
                    </div>
                </div>

                
                <?php if($user->role === 'client'): ?>
                <div class="pt-10 mt-10 border-t-4 border-gray-50">
                    <section aria-labelledby="client-data-title">
                        <div class="bg-gray-50 p-8 rounded-xl border-2 border-gray-100 shadow-inner">
                            <h3 id="client-data-title" class="text-sm font-black text-gray-900 uppercase tracking-[0.3em] mb-8 flex items-center">
                                <span class="w-3 h-3 bg-purple-600 rounded-full mr-3" aria-hidden="true"></span> Rozszerzone dane klienta
                            </h3>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="nip" class="block text-[10px] font-black text-gray-600 uppercase mb-2 tracking-widest">NIP (Identyfikacja podatkowa)</label>
                                    <input type="text" id="nip" name="nip" value="<?php echo e(old('nip', $user->client->nip ?? '')); ?>" 
                                           class="w-full border-2 border-white rounded-lg p-3 font-black text-blue-900 focus:border-purple-600 outline-none shadow-sm uppercase tracking-tighter">
                                </div>
                                
                                <div>
                                    <label for="phone" class="block text-[10px] font-black text-gray-600 uppercase mb-2 tracking-widest">Numer Telefonu</label>
                                    <input type="tel" id="phone" name="phone" value="<?php echo e(old('phone', $user->client->phone ?? '')); ?>" 
                                           class="w-full border-2 border-white rounded-lg p-3 font-black focus:border-purple-600 outline-none shadow-sm uppercase">
                                </div>
                                
                                <div class="md:col-span-2">
                                    <label for="address" class="block text-[10px] font-black text-gray-600 uppercase mb-2 tracking-widest">Pełny Adres Siedziby</label>
                                    <input type="text" id="address" name="address" value="<?php echo e(old('address', $user->client->address ?? '')); ?>" 
                                           class="w-full border-2 border-white rounded-lg p-3 font-black focus:border-purple-600 outline-none shadow-sm uppercase">
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
                <?php endif; ?>

                
                <div class="pt-10 flex flex-wrap items-center justify-between gap-6 border-t-4 border-gray-50">
                    <a href="<?php echo e(route('admin.users.index')); ?>" 
                       aria-label="Anuluj edycję i wróć do bazy użytkowników"
                       class="text-[10px] font-black text-gray-400 hover:text-red-700 uppercase tracking-[0.3em] transition-colors">
                        ← Porzuć zmiany
                    </a>
                    
                    <button type="submit" 
                            class="bg-blue-800 hover:bg-black text-white px-12 py-5 rounded-xl font-black shadow-xl transition-all transform hover:-translate-y-1 active:scale-95 uppercase tracking-[0.2em] text-xs focus:ring-4 focus:ring-blue-100">
                        Zaktualizuj Profil Użytkownika
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/magda/transport-app/resources/views/admin/users/edit.blade.php ENDPATH**/ ?>