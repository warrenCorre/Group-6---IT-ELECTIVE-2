

<?php $__env->startSection('title', 'Group 6 • IT Elective 2 - Home'); ?>

<?php $__env->startSection('content'); ?>
<div class="welcome-card text-center">

    
    <div class="eyebrow mb-4">Academic Year 2025–2026</div>

    
    <h1 class="group-title mb-3">GROUP 6</h1>

    
    <div class="relative py-4 my-2">
        <div class="absolute inset-0 flex items-center" aria-hidden="true">
            <div class="w-full border-t border-slate-700/50"></div>
        </div>
        <div class="relative flex justify-center">
            <span class="px-6 text-2xl font-light text-slate-300" style="background: transparent; font-family: 'DM Sans', sans-serif; letter-spacing: 0.5px;">
                IT Elective 2
            </span>
        </div>
    </div>

    
    <p class="text-base text-slate-400 max-w-md mx-auto leading-relaxed mt-4" style="font-family: 'DM Sans', sans-serif; font-weight: 300;">
        Welcome to our group page. We are a team of IT students exploring topics in technology.
    </p>

    
    <div class="mt-8 flex items-center justify-center gap-3 text-slate-600 text-xs tracking-widest uppercase select-none">
        <div class="h-px w-12 bg-gradient-to-r from-transparent to-slate-600"></div>
        <span class="text-slate-500" style="font-family: 'DM Sans', sans-serif; letter-spacing: 2px; font-size: 0.7rem;">Meet the Team</span>
        <div class="h-px w-12 bg-gradient-to-l from-transparent to-slate-600"></div>
    </div>

    
    <div class="mt-7">
        <a href="<?php echo e(route('team.public')); ?>" class="btn-primary px-8 py-3 text-base">
            View Our Team
        </a>
    </div>

    
    <div class="mt-8 flex justify-center gap-2" aria-hidden="true">
        <span class="w-1.5 h-1.5 rounded-full bg-blue-600/40"></span>
        <span class="w-1.5 h-1.5 rounded-full bg-blue-500/30"></span>
        <span class="w-1.5 h-1.5 rounded-full bg-blue-400/20"></span>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Group_6_@IT_Elective_2\resources\views/home.blade.php ENDPATH**/ ?>