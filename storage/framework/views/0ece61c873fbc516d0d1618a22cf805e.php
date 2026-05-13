<?php $__env->startSection('title', 'Login - Group 6'); ?>

<?php $__env->startSection('content'); ?>
<div class="min-h-[82vh] flex items-center justify-center">
    <div class="welcome-card w-full max-w-md">

        
        <div class="text-center mb-8">
            <div class="w-12 h-12 rounded-2xl bg-gradient-to-br from-blue-500/20 to-indigo-600/20 border border-blue-500/25 flex items-center justify-center mx-auto mb-4">
                <i class="fa-solid fa-lock text-blue-400 text-lg"></i>
            </div>
            <h2 class="section-title text-2xl">Welcome back</h2>
            <p class="text-slate-500 text-sm mt-1.5" style="font-family: 'DM Sans', sans-serif;">Sign in to your Group 6 account</p>
        </div>

        
        <?php if(session('status')): ?>
            <div class="mb-5 flex items-start gap-3 rounded-xl bg-green-500/10 border border-green-500/25 px-4 py-3">
                <i class="fa-solid fa-circle-check text-green-400 mt-0.5 shrink-0"></i>
                <p class="text-green-400 text-sm" style="font-family: 'DM Sans', sans-serif;"><?php echo e(session('status')); ?></p>
            </div>
        <?php endif; ?>

        <form method="POST" action="<?php echo e(route('login')); ?>" class="space-y-5">
            <?php echo csrf_field(); ?>

            
            <div class="form-group">
                <label for="email" class="form-label">Email Address</label>
                <div class="relative">
                    <span class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-500 pointer-events-none">
                        <i class="fa-regular fa-envelope text-sm"></i>
                    </span>
                    <input type="email" name="email" id="email"
                           value="<?php echo e(old('email')); ?>"
                           class="form-input pl-10"
                           placeholder="you@example.com"
                           required autofocus autocomplete="email">
                </div>
                <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <p class="text-red-400 text-xs mt-1.5 flex items-center gap-1">
                        <i class="fa-solid fa-circle-exclamation"></i> <?php echo e($message); ?>

                    </p>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            
            <div class="form-group">
                <div class="flex items-center justify-between mb-1.5">
                    <label for="password" class="form-label mb-0">Password</label>
                    <a href="<?php echo e(route('password.request')); ?>"
                       class="text-xs text-blue-400 hover:text-blue-300 transition-colors"
                       style="font-family: 'DM Sans', sans-serif;">
                        Forgot password?
                    </a>
                </div>
                <div class="relative">
                    <span class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-500 pointer-events-none">
                        <i class="fa-solid fa-key text-sm"></i>
                    </span>
                    <input type="password" name="password" id="password"
                           class="form-input pl-10 pr-12"
                           placeholder="••••••••"
                           required autocomplete="current-password">
                    <button type="button" onclick="togglePassword('password')"
                            class="absolute right-4 top-1/2 -translate-y-1/2 text-slate-500 hover:text-slate-300 transition-colors">
                        <i class="fa-regular fa-eye text-sm" id="password-icon"></i>
                    </button>
                </div>
                <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <p class="text-red-400 text-xs mt-1.5 flex items-center gap-1">
                        <i class="fa-solid fa-circle-exclamation"></i> <?php echo e($message); ?>

                    </p>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            
            <div class="flex items-center gap-3">
                <label class="relative inline-flex items-center cursor-pointer gap-3">
                    <input type="checkbox" name="remember" id="remember" class="sr-only peer">
                    <div class="w-9 h-5 bg-slate-700 peer-checked:bg-blue-600 rounded-full transition-colors border border-slate-600 peer-checked:border-blue-500 relative">
                        <div class="absolute left-0.5 top-0.5 w-4 h-4 bg-white rounded-full transition-transform peer-checked:translate-x-4 shadow-sm"></div>
                    </div>
                    <span class="text-sm text-slate-400" style="font-family: 'DM Sans', sans-serif;">Remember me</span>
                </label>
            </div>

            
            <div class="pt-2">
                <button type="submit" class="btn-primary w-full py-3 text-base">
                    <i class="fa-solid fa-arrow-right-to-bracket"></i>
                    Sign In
                </button>
            </div>
        </form>
    </div>
</div>

<?php $__env->startPush('scripts'); ?>
<script>
function togglePassword(fieldId) {
    const field = document.getElementById(fieldId);
    const icon  = document.getElementById(fieldId + '-icon');
    if (field.type === 'password') {
        field.type = 'text';
        icon.classList.replace('fa-eye', 'fa-eye-slash');
    } else {
        field.type = 'password';
        icon.classList.replace('fa-eye-slash', 'fa-eye');
    }
}

// Toggle trick for custom checkbox
document.getElementById('remember')?.addEventListener('change', function() {
    const dot = this.closest('label').querySelector('.w-9 > div');
    if (dot) dot.style.transform = this.checked ? 'translateX(16px)' : '';
});
</script>
<?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Group_6_@IT_Elective_2\resources\views/auth/login.blade.php ENDPATH**/ ?>