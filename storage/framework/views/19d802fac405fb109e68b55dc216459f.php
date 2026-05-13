

<?php $__env->startSection('title', 'Manage Members - Group 6'); ?>

<?php $__env->startSection('content'); ?>
<div class="max-w-7xl mx-auto">

    
    <div class="text-center mb-8">
        <div class="eyebrow mb-3">Admin Panel</div>
        <h2 class="section-title">Manage Members</h2>
        <div class="section-divider"></div>
    </div>

    
    <div class="flex justify-end mb-8 px-2">
        <a href="<?php echo e(route('admin.members.create')); ?>" class="btn-primary">
            <i class="fa-solid fa-plus text-xs"></i>
            Create New Member
        </a>
    </div>

    <?php if($users->count() > 0): ?>
    <div class="members-grid">
        <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="member-card grid-card" style="animation: pageIn 0.4s cubic-bezier(0.22, 1, 0.36, 1) both; animation-delay: <?php echo e($loop->index * 50); ?>ms;">

            
            <?php if($user->id === auth()->user()->id): ?>
            <div class="absolute -top-2 left-1/2 -translate-x-1/2">
                <span class="badge badge-blue text-xs py-1 px-3 shadow-lg">
                    <i class="fa-solid fa-user text-xs"></i> You
                </span>
            </div>
            <?php endif; ?>

            
            <div class="profile-avatar">
                <?php if($user->profile_photo): ?>
                    <img src="<?php echo e(url('storage-file/' . $user->profile_photo)); ?>" alt="<?php echo e($user->name); ?>">
                <?php else: ?>
                    <img src="https://ui-avatars.com/api/?name=<?php echo e(urlencode($user->name)); ?>&background=3b5570&color=fff&size=84" alt="<?php echo e($user->name); ?>">
                <?php endif; ?>
            </div>

            
            <h3 class="member-name mt-1 border-b-5"><?php echo e($user->name); ?></h3>
            <div class="mt-1.5">
                <?php if($user->isAdmin()): ?>
                    <span class="badge badge-purple">
                        <i class="fa-solid fa-shield-halved text-xs"></i> <?php echo e(ucfirst($user->role)); ?>

                    </span>
                <?php else: ?>
                    <span class="badge badge-blue"><?php echo e(ucfirst($user->role)); ?></span>
                <?php endif; ?>
            </div>

            
            <div class="h-px bg-gradient-to-r from-transparent via-slate-600/50 to-transparent my-3"></div>

            
            <div class="info-line justify-center">
                <i class="fa-regular fa-envelope"></i>
                <span class="truncate text-xs" title="<?php echo e($user->email); ?>"><?php echo e($user->email); ?></span>
            </div>

            <?php if($user->age): ?>
            <div class="info-line justify-center">
                <i class="fa-regular fa-calendar"></i>
                <span class="text-xs"><?php echo e($user->age); ?> y.o.</span>
            </div>
            <?php endif; ?>

            
            <div class="bio-text mt-3">
                <?php echo e(Str::limit($user->bio ?? 'No bio provided.', 60)); ?>

            </div>

            
            <?php if($user->id !== auth()->user()->id): ?>
                <div class="mt-4 flex gap-2 justify-center">
                    <?php if(!$user->isAdmin() || auth()->user()->isAdmin()): ?>
                        <a href="<?php echo e(route('admin.members.edit', $user)); ?>"
                           class="btn-primary text-xs px-4 py-2">
                            <i class="fa-solid fa-pen-to-square text-xs"></i> Edit
                        </a>
                    <?php endif; ?>

                    <?php if(!$user->isAdmin()): ?>
                        <form method="POST" action="<?php echo e(route('admin.members.destroy', $user)); ?>"
                              onsubmit="return confirm('Delete <?php echo e(addslashes($user->name)); ?>? This cannot be undone.');">
                            <?php echo csrf_field(); ?>
                            <button type="submit" class="btn-danger text-xs px-4 py-2">
                                <i class="fa-solid fa-trash-can text-xs"></i> Delete
                            </button>
                        </form>
                    <?php endif; ?>
                </div>
            <?php else: ?>
                <div class="mt-4">
                    <a href="<?php echo e(route('profile.edit')); ?>" class="btn-primary text-xs px-4 py-2">
                        <i class="fa-solid fa-pen-to-square text-xs"></i> Edit Profile
                    </a>
                </div>
            <?php endif; ?>

        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>

    <?php else: ?>
    <div class="text-center py-16">
        <div class="member-card p-10 max-w-sm mx-auto text-center">
            <div class="w-16 h-16 rounded-full bg-slate-800/60 flex items-center justify-center mx-auto mb-4">
                <i class="fa-regular fa-users text-3xl text-slate-500"></i>
            </div>
            <h3 class="member-name mb-2">No Members Found</h3>
            <p class="text-slate-500 text-sm mb-6">There are no members to display.</p>
            <a href="<?php echo e(route('admin.members.create')); ?>" class="btn-primary text-sm">
                <i class="fa-solid fa-plus text-xs"></i> Create First Member
            </a>
        </div>
    </div>
    <?php endif; ?>

</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('styles'); ?>
<style>
.member-card.grid-card { position: relative; overflow: visible; }
</style>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Group_6_@IT_Elective_2\resources\views/admin/members.blade.php ENDPATH**/ ?>