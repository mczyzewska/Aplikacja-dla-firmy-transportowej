<?php $__env->startSection('content'); ?>
<div class="container mx-auto p-6 max-w-4xl">
    
    <div class="mb-10 border-b-4 border-blue-800 pb-4 flex items-center justify-between">
        <div>
            <h1 id="page-title" class="text-4xl font-black text-gray-900 uppercase tracking-tighter">
                Ustawienia mojego profilu
            </h1>
            <p class="text-gray-600 font-bold uppercase text-[10px] tracking-[0.3em] mt-1">
                Zarządzanie danymi identyfikacyjnymi konta
            </p>
        </div>
        <a href="<?php echo e(route('dashboard')); ?>" 
           aria-label="Wróć do głównego panelu sterowania"
           class="bg-gray-600 hover:bg-black text-white px-6 py-2 rounded-lg font-black shadow-lg transition transform hover:-translate-y-1 active:scale-95 text-[10px] uppercase tracking-widest">
            ← Powrót
        </a>
    </div>

    
    <?php if(session('status') === 'profile-updated'): ?>
        <div role="status" class="mb-8 bg-green-50 border-l-8 border-green-600 p-5 rounded-md shadow-sm">
            <p class="text-green-800 font-black uppercase tracking-tight text-sm flex items-center">
                <span class="mr-2" aria-hidden="true">✅</span> Twoje dane zostały pomyślnie zaktualizowane w systemie!
            </p>
        </div>
    <?php endif; ?>

    
    <div class="bg-white p-10 rounded-xl shadow-2xl border-2 border-gray-100 border-t-[12px] border-t-purple-600">
        <form action="<?php echo e(route('profile.update')); ?>" method="POST" novalidate>
            <?php echo csrf_field(); ?>
            <?php echo method_field('patch'); ?>

            <div class="space-y-10">
                
                <section aria-labelledby="section-basic">
                    <h2 id="section-basic" class="text-[10px] font-black text-purple-600 uppercase tracking-[0.3em] mb-6 flex items-center">
                        <span class="w-3 h-3 bg-purple-600 rounded-full mr-3" aria-hidden="true"></span>
                        Informacje podstawowe identyfikacyjne
                    </h2>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div>
                            <label for="name" class="block text-[10px] font-black text-gray-700 uppercase mb-2 tracking-widest">
                                Imię i nazwisko / Nazwa firmy <span class="text-red-600" aria-hidden="true">*</span>
                            </label>
                            <input type="text" id="name" name="name" value="<?php echo e(old('name', $user->name)); ?>" 
                                   required aria-required="true"
                                   class="w-full border-2 border-gray-100 rounded-lg p-3 font-black text-gray-900 focus:border-purple-600 focus:ring-4 focus:ring-purple-50 outline-none transition-all shadow-sm">
                        </div>
                        <div>
                            <label for="email" class="block text-[10px] font-black text-gray-700 uppercase mb-2 tracking-widest">
                                Adres E-mail <span class="text-red-600" aria-hidden="true">*</span>
                            </label>
                            <input type="email" id="email" name="email" value="<?php echo e(old('email', $user->email)); ?>" 
                                   required aria-required="true"
                                   class="w-full border-2 border-gray-100 rounded-lg p-3 font-mono font-black text-gray-900 focus:border-purple-600 focus:ring-4 focus:ring-purple-50 outline-none transition-all shadow-sm uppercase">
                        </div>
                    </div>
                </section>

                
                <?php if($user->role === 'client'): ?>
                <section aria-labelledby="section-company" class="pt-10 border-t-4 border-gray-50">
                    <h2 id="section-company" class="text-[10px] font-black text-blue-600 uppercase tracking-[0.3em] mb-6 flex items-center">
                        <span class="w-3 h-3 bg-blue-600 rounded-full mr-3" aria-hidden="true"></span>
                        Dane firmowe i operacyjne do faktur
                    </h2>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
                        <div>
                            <label for="nip" class="block text-[10px] font-black text-gray-700 uppercase mb-2 tracking-widest">Numer NIP</label>
                            <input type="text" id="nip" name="nip" value="<?php echo e(old('nip', $user->client->nip ?? '')); ?>" 
                                   class="w-full border-2 border-gray-50 rounded-lg p-3 bg-gray-50 font-black text-blue-900 focus:border-blue-600 focus:ring-4 focus:ring-blue-50 outline-none transition-all uppercase">
                        </div>
                        <div>
                            <label for="phone" class="block text-[10px] font-black text-gray-700 uppercase mb-2 tracking-widest">Telefon Kontaktowy</label>
                            <input type="tel" id="phone" name="phone" value="<?php echo e(old('phone', $user->client->phone ?? '')); ?>" 
                                   class="w-full border-2 border-gray-50 rounded-lg p-3 bg-gray-50 font-black text-gray-900 focus:border-blue-600 focus:ring-4 focus:ring-blue-50 outline-none transition-all">
                        </div>
                    </div>
                    <div>
                        <label for="address" class="block text-[10px] font-black text-gray-700 uppercase mb-2 tracking-widest">Pełny adres siedziby</label>
                        <input type="text" id="address" name="address" value="<?php echo e(old('address', $user->client->address ?? '')); ?>" 
                               class="w-full border-2 border-gray-50 rounded-lg p-3 bg-gray-50 font-black text-gray-900 focus:border-blue-600 focus:ring-4 focus:ring-blue-50 outline-none transition-all uppercase">
                    </div>
                </section>
                <?php endif; ?>

                
                <div class="pt-10 flex justify-between items-center border-t-4 border-gray-50">
                    <p class="text-[9px] font-black text-gray-400 uppercase tracking-widest">* Pola wymagane do poprawnej pracy systemu</p>
                    <button type="submit" 
                            class="bg-blue-800 hover:bg-black text-white px-12 py-5 rounded-xl font-black shadow-xl transition-all transform hover:-translate-y-1 active:scale-95 uppercase tracking-[0.2em] text-xs focus:ring-4 focus:ring-blue-100">
                        Zaktualizuj dane profilowe
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/magda/transport-app/resources/views/profile/edit.blade.php ENDPATH**/ ?>