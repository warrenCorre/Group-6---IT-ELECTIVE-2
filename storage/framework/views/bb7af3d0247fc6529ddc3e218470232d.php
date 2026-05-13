

<?php $__env->startSection('title', 'Our Team - Group 6'); ?>

<?php $__env->startSection('content'); ?>
<div class="max-w-7xl mx-auto">

    
    <div class="text-center mb-10">
        <div class="eyebrow mb-3">Group 6 • IT Elective 2</div>
        <h2 class="section-title">Our Team</h2>
        <div class="section-divider"></div>
        <p class="text-slate-400 mt-4 text-sm" style="font-family: 'DM Sans', sans-serif;">
            Meet the amazing people behind Group 6
        </p>
    </div>

    
    <div class="members-grid">
        <?php $__empty_1 = true; $__currentLoopData = $members; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $member): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <div class="member-card grid-card" style="animation: pageIn 0.4s cubic-bezier(0.22, 1, 0.36, 1) both; animation-delay: <?php echo e($loop->index * 60); ?>ms;">

            
            <div class="profile-avatar">
                <?php if($member->profile_photo): ?>
                    <img src="<?php echo e(url('storage-file/' . $member->profile_photo)); ?>" alt="<?php echo e($member->name); ?>">
                <?php else: ?>
                    <img src="https://ui-avatars.com/api/?name=<?php echo e(urlencode($member->name)); ?>&background=3b5570&color=fff&size=84" alt="<?php echo e($member->name); ?>">
                <?php endif; ?>
            </div>

            
            <h3 class="member-name mt-1"><?php echo e($member->name); ?></h3>
            <div class="member-role mt-1.5"><?php echo e($member->role); ?></div>

            
            <div class="h-px bg-gradient-to-r from-transparent via-slate-600/50 to-transparent my-3"></div>

            
            <div class="info-line justify-center">
                <i class="fa-regular fa-envelope"></i>
                <span class="truncate text-xs" title="<?php echo e($member->email); ?>"><?php echo e($member->email); ?></span>
            </div>

            <?php if($member->age): ?>
            <div class="info-line justify-center">
                <i class="fa-regular fa-calendar"></i>
                <span class="text-xs"><?php echo e($member->age); ?> y.o.</span>
            </div>
            <?php endif; ?>

            
            <div class="bio-text mt-3">
                <?php echo e(Str::limit($member->bio ?? 'No bio provided.', 100)); ?>

            </div>
        </div>

        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <div class="text-center w-full py-16">
            <div class="member-card p-10 max-w-sm mx-auto text-center">
                <div class="w-16 h-16 rounded-full bg-slate-800/60 flex items-center justify-center mx-auto mb-4">
                    <i class="fa-regular fa-users text-3xl text-slate-500"></i>
                </div>
                <h3 class="member-name mb-2">No Team Members</h3>
                <p class="text-slate-500 text-sm">There are no team members to display at this time.</p>
            </div>
        </div>
        <?php endif; ?>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Group_6_@IT_Elective_2\resources\views/members/public.blade.php ENDPATH**/ ?>