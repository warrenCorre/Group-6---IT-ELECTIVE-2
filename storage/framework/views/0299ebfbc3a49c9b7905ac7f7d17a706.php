

<?php $__env->startSection('title', 'Create Member - Group 6'); ?>

<?php $__env->startSection('content'); ?>
<div class="max-w-3xl mx-auto px-4">

    
    <div class="text-center mb-8">
        <div class="eyebrow mb-3">Admin Panel</div>
        <h2 class="section-title">Create Member</h2>
        <div class="section-divider"></div>
    </div>

    <div class="member-card p-8">
        <form method="POST" action="<?php echo e(route('admin.members.store')); ?>" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>

            
            <div class="flex flex-col md:flex-row gap-8 mb-6">

                
                <div class="md:w-48 flex-shrink-0 text-center">
                    <div class="relative inline-block">
                        <div class="profile-avatar mx-auto" style="width: 96px; height: 96px;">
                            <img src="https://ui-avatars.com/api/?name=New+Member&background=3b5570&color=fff&size=96"
                                 alt="Preview" id="preview" class="w-full h-full object-cover">
                        </div>
                        <label for="profile_photo"
                               class="absolute -bottom-1 -right-1 w-8 h-8 rounded-full bg-blue-600 border-2 border-slate-900 flex items-center justify-center cursor-pointer hover:bg-blue-500 transition-colors shadow-lg"
                               title="Upload photo">
                            <i class="fa-solid fa-camera text-xs text-white"></i>
                        </label>
                    </div>
                    <input type="file" name="profile_photo" id="profile_photo"
                           class="hidden" accept="image/*">
                    <p class="text-slate-600 text-xs mt-3">JPG, PNG · max 2MB</p>
                    <?php $__errorArgs = ['profile_photo'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="text-red-400 text-xs mt-1"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                
                <div class="flex-1 space-y-4">
                    <div>
                        <label class="form-label">Full Name</label>
                        <input type="text" name="name" value="<?php echo e(old('name')); ?>"
                               class="form-input" placeholder="e.g. Juan dela Cruz" required>
                        <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-red-400 text-xs mt-1"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <div>
                        <label class="form-label">Email Address</label>
                        <input type="email" name="email" value="<?php echo e(old('email')); ?>"
                               class="form-input" placeholder="email@example.com" required>
                        <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-red-400 text-xs mt-1"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <div>
                        <label class="form-label">Password</label>
                        <input type="password" name="password"
                               class="form-input" placeholder="Min. 6 characters" required>
                        <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-red-400 text-xs mt-1"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                </div>
            </div>

            
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5 mb-5">
                <div>
                    <label class="form-label">Role</label>
                    <select name="role" class="form-select" required>
                        <option value="" disabled <?php echo e(old('role') ? '' : 'selected'); ?>>Select a role</option>
                        <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($role); ?>" <?php echo e(old('role') == $role ? 'selected' : ''); ?>><?php echo e($role); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                    <?php $__errorArgs = ['role'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-red-400 text-xs mt-1"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div>
                    <label class="form-label">Age</label>
                    <input type="number" name="age" value="<?php echo e(old('age')); ?>"
                           class="form-input" placeholder="e.g. 20" min="1" max="99">
                    <?php $__errorArgs = ['age'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-red-400 text-xs mt-1"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
            </div>

            
            <div class="mb-7">
                <label class="form-label">Bio</label>
                <textarea name="bio" rows="3" class="form-textarea"
                          placeholder="Brief description about this member..."><?php echo e(old('bio')); ?></textarea>
                <?php $__errorArgs = ['bio'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-red-400 text-xs mt-1"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            
            <div class="h-px bg-gradient-to-r from-transparent via-slate-700/50 to-transparent mb-6"></div>

            
            <div class="flex gap-3">
                <button type="submit" class="btn-primary flex-1 py-3">
                    <i class="fa-solid fa-user-plus"></i>
                    Create Member
                </button>
                <a href="<?php echo e(route('admin.members')); ?>" class="btn-primary flex-1 py-3 text-center" style="background: linear-gradient(145deg, #1e2a3a, #151f2e); border-color: rgba(60,80,110,0.5);">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
document.getElementById('profile_photo')?.addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('preview').src = e.target.result;
        };
        reader.readAsDataURL(file);
    }
});
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Group_6_@IT_Elective_2\resources\views/admin/create-member.blade.php ENDPATH**/ ?>