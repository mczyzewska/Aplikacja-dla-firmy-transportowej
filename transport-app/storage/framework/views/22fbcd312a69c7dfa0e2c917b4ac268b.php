<?php $__env->startSection('content'); ?>
<div class="container mx-auto p-6 max-w-7xl">
    
    <div class="mb-10 border-b-4 border-blue-800 pb-4">
        <h1 class="text-4xl font-black text-gray-900 uppercase tracking-tighter">
            Baza Użytkowników i Klientów
        </h1>
        <p class="text-gray-600 font-bold uppercase text-[10px] tracking-[0.3em] mt-1">
            Zarządzanie uprawnieniami i danymi identyfikacyjnymi personelu oraz kontrahentów
        </p>
    </div>

    
    <div class="bg-white p-8 rounded-xl shadow-xl border-2 border-gray-100 border-t-[12px] border-t-purple-600 mb-12">
        <h2 class="text-2xl font-black mb-8 text-gray-900 uppercase tracking-tighter flex items-center italic">
            <span class="mr-3 text-purple-600" aria-hidden="true">👤</span> Rejestracja Nowego Profilu
        </h2>
        
        <form action="<?php echo e(route('admin.users.store')); ?>" method="POST" novalidate>
            <?php echo csrf_field(); ?>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mb-8">
                <div>
                    <label for="name" class="block text-[10px] font-black text-gray-700 uppercase mb-2 tracking-widest">Imię i Nazwisko *</label>
                    <input id="name" type="text" name="name" required aria-required="true"
                           class="w-full border-2 border-gray-100 rounded-lg p-3 font-black text-gray-900 focus:border-purple-600 focus:ring-4 focus:ring-purple-50 outline-none transition-all">
                </div>
                <div>
                    <label for="email" class="block text-[10px] font-black text-gray-700 uppercase mb-2 tracking-widest">Adres E-mail *</label>
                    <input id="email" type="email" name="email" required aria-required="true"
                           class="w-full border-2 border-gray-100 rounded-lg p-3 font-black text-gray-900 focus:border-purple-600 focus:ring-4 focus:ring-purple-50 outline-none transition-all uppercase">
                </div>
                <div>
                    <label for="password" class="block text-[10px] font-black text-gray-700 uppercase mb-2 tracking-widest">Hasło *</label>
                    <input id="password" type="password" name="password" required aria-required="true"
                           class="w-full border-2 border-gray-100 rounded-lg p-3 font-black text-gray-900 focus:border-purple-600 focus:ring-4 focus:ring-purple-50 outline-none transition-all">
                </div>
                <div>
                    <label for="role" class="block text-[10px] font-black text-gray-700 uppercase mb-2 tracking-widest">Rola *</label>
                    <select id="role" name="role" required aria-required="true"
                            class="w-full border-2 border-gray-100 rounded-lg p-3 font-black text-gray-900 focus:border-purple-600 outline-none uppercase text-xs">
                        <option value="client">KLIENT FIRMOWY</option>
                        <option value="employee">PRACOWNIK</option>
                        <option value="admin">ADMINISTRATOR</option>
                    </select>
                </div>
            </div>

            
            <div class="bg-gray-50 p-6 rounded-xl border-2 border-gray-100 shadow-inner mb-8">
                <p class="text-[10px] font-black text-gray-600 uppercase mb-6 tracking-[0.3em] flex items-center">
                    <span class="w-3 h-3 bg-purple-600 rounded-full mr-3" aria-hidden="true"></span>
                    Informacje dodatkowe (Wymagane tylko dla Klientów)
                </p>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div>
                        <label for="nip" class="block text-[10px] font-black text-gray-400 uppercase mb-2">NIP Firmy</label>
                        <input id="nip" type="text" name="nip" placeholder="NP. 0000000000" class="w-full border-2 border-white rounded-lg p-3 text-xs font-black uppercase focus:border-purple-600 outline-none shadow-sm">
                    </div>
                    <div>
                        <label for="phone" class="block text-[10px] font-black text-gray-400 uppercase mb-2">Telefon</label>
                        <input id="phone" type="tel" name="phone" placeholder="NP. +48 000 000 000" class="w-full border-2 border-white rounded-lg p-3 text-xs font-black uppercase focus:border-purple-600 outline-none shadow-sm">
                    </div>
                    <div>
                        <label for="address" class="block text-[10px] font-black text-gray-400 uppercase mb-2">Adres Siedziby</label>
                        <input id="address" type="text" name="address" placeholder="NP. UL. TRANSPORTOWA 1, GDAŃSK" class="w-full border-2 border-white rounded-lg p-3 text-xs font-black uppercase focus:border-purple-600 outline-none shadow-sm">
                    </div>
                </div>
            </div>

            <div class="flex justify-end pt-4">
                <button type="submit" class="bg-blue-800 hover:bg-black text-white px-12 py-5 rounded-xl font-black shadow-xl transition-all transform hover:-translate-y-1 active:scale-95 uppercase tracking-[0.2em] text-xs">
                    Zapisz i aktywuj profil
                </button>
            </div>
        </form>
    </div>

    
    <div class="space-y-16">
        
        
        <section aria-labelledby="admin-title">
            <h3 id="admin-title" class="text-red-700 font-black mb-4 uppercase text-xs tracking-[0.3em] flex items-center">
                <span class="w-3 h-3 bg-red-700 rounded-full mr-3" aria-hidden="true"></span> Zarząd Systemu (Admins)
            </h3>
            <div class="bg-white shadow-xl rounded-xl overflow-hidden border-2 border-gray-100 border-t-8 border-t-red-700">
                <table class="w-full text-left border-collapse">
                    <thead class="bg-gray-900 text-white uppercase text-[10px] tracking-[0.3em] font-black">
                        <tr>
                            <th scope="col" class="p-5">Imię i Nazwisko</th>
                            <th scope="col" class="p-5">E-mail</th>
                            <th scope="col" class="p-5 text-center">Zarządzanie</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y-2 divide-gray-50 text-sm">
                        <?php $__currentLoopData = $admins; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $u): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr class="hover:bg-red-50 transition-colors">
                            <td class="p-5 font-black text-gray-900 uppercase tracking-tight"><?php echo e($u->name); ?></td>
                            <td class="p-5 text-gray-600 font-mono uppercase"><?php echo e($u->email); ?></td>
                            <td class="p-5 text-center">
                                <a href="<?php echo e(route('admin.users.edit', $u)); ?>" aria-label="Edytuj administratora: <?php echo e($u->name); ?>" class="bg-blue-800 text-white px-4 py-2 rounded font-black text-[10px] uppercase shadow-md hover:bg-black transition-all">Edycja</a>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        </section>

        
        <section aria-labelledby="employees-title">
            <h3 id="employees-title" class="text-blue-700 font-black mb-4 uppercase text-xs tracking-[0.3em] flex items-center">
                <span class="w-3 h-3 bg-blue-700 rounded-full mr-3" aria-hidden="true"></span> Personel Operacyjny
            </h3>
            <div class="bg-white shadow-xl rounded-xl overflow-hidden border-2 border-gray-100 border-t-8 border-t-blue-800">
                <table class="w-full text-left border-collapse">
                    <thead class="bg-gray-900 text-white uppercase text-[10px] tracking-[0.3em] font-black">
                        <tr>
                            <th scope="col" class="p-5">Pracownik</th>
                            <th scope="col" class="p-5">E-mail</th>
                            <th scope="col" class="p-5 text-center">Akcje</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y-2 divide-gray-50 text-sm">
                        <?php $__currentLoopData = $employees; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $u): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr class="hover:bg-blue-50 transition-colors">
                            <td class="p-5 font-black text-gray-900 uppercase tracking-tight"><?php echo e($u->name); ?></td>
                            <td class="p-5 text-gray-600 font-mono uppercase"><?php echo e($u->email); ?></td>
                            <td class="p-5">
                                <div class="flex justify-center gap-3">
                                    <a href="<?php echo e(route('admin.users.edit', $u)); ?>" aria-label="Edytuj pracownika: <?php echo e($u->name); ?>" class="bg-blue-800 text-white px-4 py-2 rounded font-black text-[10px] uppercase hover:bg-black transition-all">Edycja</a>
                                    <form action="<?php echo e(route('admin.users.destroy', $u)); ?>" method="POST" onsubmit="return confirm('Usunąć konto pracownika?')">
                                        <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                        <button aria-label="Usuń pracownika: <?php echo e($u->name); ?>" class="bg-red-700 text-white px-4 py-2 rounded font-black text-[10px] uppercase shadow-md hover:bg-black transition-all">Usuń</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        </section>

        
        <section aria-labelledby="clients-title">
            <h3 id="clients-title" class="text-green-700 font-black mb-4 uppercase text-xs tracking-[0.3em] flex items-center">
                <span class="w-3 h-3 bg-green-700 rounded-full mr-3" aria-hidden="true"></span> Baza Klientów Biznesowych
            </h3>
            <div class="bg-white shadow-2xl rounded-xl overflow-hidden border-2 border-gray-100 border-t-8 border-t-green-600">
                <table class="w-full text-left border-collapse">
                    <thead class="bg-gray-900 text-white uppercase text-[10px] tracking-[0.3em] font-black">
                        <tr>
                            <th scope="col" class="p-5">Klient / Podmiot</th>
                            <th scope="col" class="p-5">Identyfikacja Podatkowa</th>
                            <th scope="col" class="p-5 text-center">Zarządzanie</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y-2 divide-gray-100 text-sm">
                        <?php $__currentLoopData = $clients; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $u): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr class="hover:bg-green-50 transition-colors">
                            <td class="p-5">
                                <div class="font-black text-blue-900 uppercase tracking-tight"><?php echo e($u->name); ?></div>
                                <div class="text-[9px] text-gray-400 font-black mt-1 italic uppercase tracking-widest">SYST-ID: <?php echo e($u->id); ?></div>
                            </td>
                            <td class="p-5">
                                <div class="font-black text-gray-900">NIP: <?php echo e($u->client->nip ?? '---'); ?></div>
                                <div class="text-[10px] text-gray-500 uppercase font-bold tracking-tighter"><?php echo e($u->client->address ?? 'Brak adresu'); ?></div>
                            </td>
                            <td class="p-5">
                                <div class="flex justify-center gap-3">
                                    <a href="<?php echo e(route('admin.users.edit', $u)); ?>" aria-label="Edytuj klienta: <?php echo e($u->name); ?>" class="bg-blue-800 text-white px-4 py-2 rounded font-black text-[10px] uppercase shadow-md hover:bg-black transition-all">Edycja</a>
                                    
                                    <form action="<?php echo e(route('admin.users.destroy', $u)); ?>" method="POST" onsubmit="return confirm('Czy na pewno chcesz trwale usunąć konto klienta <?php echo e($u->name); ?>?')">
                                        <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                        <button aria-label="Usuń klienta: <?php echo e($u->name); ?>" class="bg-red-700 text-white px-4 py-2 rounded font-black text-[10px] uppercase shadow-md hover:bg-black transition-all">Usuń</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        </section>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/magda/transport-app/resources/views/admin/users/index.blade.php ENDPATH**/ ?>