<?php if (isset($component)) { $__componentOriginal69dc84650370d1d4dc1b42d016d7226b = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal69dc84650370d1d4dc1b42d016d7226b = $attributes; } ?>
<?php $component = App\View\Components\GuestLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('guest-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\GuestLayout::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
    <div class="container mx-auto p-6 max-w-xl">
        
        <div class="mb-10 border-b-4 border-blue-800 pb-4 text-center">
            <h1 class="text-4xl font-black text-gray-900 uppercase tracking-tighter">
                Autoryzacja Dostępu
            </h1>
            <p class="text-gray-500 font-bold uppercase text-[10px] tracking-[0.3em] mt-1">
                Wprowadź dane, aby przejść do panelu Transport App
            </p>
        </div>

        
        <div class="bg-white p-8 rounded-xl shadow-xl border-2 border-gray-100 border-t-[12px] border-t-blue-800">
            
            

            <form method="POST" action="<?php echo e(route('login')); ?>" class="space-y-6" novalidate>
                <?php echo csrf_field(); ?>

                
                <div>
                    <label for="email" class="block text-[10px] font-black text-gray-500 uppercase tracking-[0.2em] mb-2">
                        Adres E-mail
                    </label>
                    <input 
                        id="email" 
                        type="email" 
                        name="email" 
                        value="<?php echo e(old('email')); ?>" 
                        required 
                        autofocus
                        aria-required="true"
                        aria-invalid="<?php echo e($errors->has('email') ? 'true' : 'false'); ?>"
                        class="w-full border-2 border-gray-100 rounded-lg p-3 font-bold text-gray-900 focus:border-blue-800 focus:ring-0 transition-all shadow-sm placeholder-gray-300"
                        placeholder="NP. JAN.KOWALSKI@TRANSPORT.PL"
                    >
                    <?php if (isset($component)) { $__componentOriginalf94ed9c5393ef72725d159fe01139746 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalf94ed9c5393ef72725d159fe01139746 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input-error','data' => ['messages' => $errors->get('email'),'class' => 'mt-2 text-[10px] font-black uppercase']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('input-error'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['messages' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($errors->get('email')),'class' => 'mt-2 text-[10px] font-black uppercase']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalf94ed9c5393ef72725d159fe01139746)): ?>
<?php $attributes = $__attributesOriginalf94ed9c5393ef72725d159fe01139746; ?>
<?php unset($__attributesOriginalf94ed9c5393ef72725d159fe01139746); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalf94ed9c5393ef72725d159fe01139746)): ?>
<?php $component = $__componentOriginalf94ed9c5393ef72725d159fe01139746; ?>
<?php unset($__componentOriginalf94ed9c5393ef72725d159fe01139746); ?>
<?php endif; ?>
                </div>

                
                <div class="relative">
                    <label for="password" class="block text-[10px] font-black text-gray-500 uppercase tracking-[0.2em] mb-2">
                        Hasło Dostępowe
                    </label>
                    <div class="relative">
                        <input 
                            id="password" 
                            type="password" 
                            name="password" 
                            required 
                            aria-required="true"
                            class="w-full border-2 border-gray-100 rounded-lg p-3 pr-12 font-bold text-gray-900 focus:border-blue-800 focus:ring-0 transition-all shadow-sm"
                        >
                        <button 
                            type="button" 
                            onclick="togglePassword('password', this)" 
                            class="absolute right-3 top-1/2 -translate-y-1/2 text-xl grayscale hover:grayscale-0 transition-all"
                            aria-label="Pokaż/ukryj hasło"
                        >
                            👁
                        </button>
                    </div>
                    <?php if (isset($component)) { $__componentOriginalf94ed9c5393ef72725d159fe01139746 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalf94ed9c5393ef72725d159fe01139746 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input-error','data' => ['messages' => $errors->get('password'),'class' => 'mt-2 text-[10px] font-black uppercase']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('input-error'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['messages' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($errors->get('password')),'class' => 'mt-2 text-[10px] font-black uppercase']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalf94ed9c5393ef72725d159fe01139746)): ?>
<?php $attributes = $__attributesOriginalf94ed9c5393ef72725d159fe01139746; ?>
<?php unset($__attributesOriginalf94ed9c5393ef72725d159fe01139746); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalf94ed9c5393ef72725d159fe01139746)): ?>
<?php $component = $__componentOriginalf94ed9c5393ef72725d159fe01139746; ?>
<?php unset($__componentOriginalf94ed9c5393ef72725d159fe01139746); ?>
<?php endif; ?>
                </div>

                
                <div class="flex items-center justify-between pt-4 border-t-2 border-gray-50">
                    <?php if(Route::has('password.request')): ?>
                        <a class="text-[10px] font-black text-gray-400 uppercase tracking-widest hover:text-blue-800 transition-colors" href="<?php echo e(route('password.request')); ?>">
                            Resetuj hasło →
                        </a>
                    <?php endif; ?>

                    <button type="submit" class="bg-blue-800 text-white px-8 py-3 rounded-lg font-black uppercase text-xs tracking-[0.2em] hover:bg-black hover:shadow-2xl transition-all transform hover:-translate-y-1 active:scale-95">
                        Zaloguj do systemu
                    </button>
                </div>
            </form>
        </div>

        
        <p class="text-center mt-8 text-gray-400 font-bold uppercase text-[9px] tracking-[0.4em]">
            Transport App v2.0 &copy; 2026 
        </p>
    </div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal69dc84650370d1d4dc1b42d016d7226b)): ?>
<?php $attributes = $__attributesOriginal69dc84650370d1d4dc1b42d016d7226b; ?>
<?php unset($__attributesOriginal69dc84650370d1d4dc1b42d016d7226b); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal69dc84650370d1d4dc1b42d016d7226b)): ?>
<?php $component = $__componentOriginal69dc84650370d1d4dc1b42d016d7226b; ?>
<?php unset($__componentOriginal69dc84650370d1d4dc1b42d016d7226b); ?>
<?php endif; ?><?php /**PATH /Users/magda/transport-app/resources/views/auth/login.blade.php ENDPATH**/ ?>