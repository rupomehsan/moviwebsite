<?php $__env->startSection('content'); ?>
    <div class="row login-content">
        <div class="col-md-4">
            <div class="login-logo text-center">
                <?php
                $title = \App\Models\Setting::first();
                ?>
                <?php if(!empty($title->logo)): ?>
                    <img src="<?php echo e(URL::to('/')); ?>/uploads/<?php echo e($title->logo); ?>" alt="logo" />
                <?php else: ?>
                    <img src="<?php echo e(URL::to('/')); ?>/uploads/no.jpeg" alt="" />
                <?php endif; ?>
            </div>
            <div class="login-submit-form">
                <form method="POST" action="<?php echo e(route('login')); ?>">
                    <?php echo csrf_field(); ?>

                    <div class="form-group login-form">
                        <label for="email" class="">Email</label>

                        <input id="email" type="email" class="form-control <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="email"
                            value="<?php echo e(old('email')); ?>" placeholder="Type your email" required autocomplete="email">

                        <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <span class="invalid-feedback" role="alert">
                                <strong><?php echo e($message); ?></strong>
                            </span>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <div class="form-group login-form margin-top-40">
                        <label for="password">Password</label>
                        <input id="password" type="password" class="form-control <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                            name="password" placeholder="Type your password" required autocomplete="current-password">

                        <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <span class="invalid-feedback" role="alert">
                                <strong><?php echo e($message); ?></strong>
                            </span>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <div class="form-group text-right">
                        <button type="submit" class="btn btn-danger login-submit">
                            Login
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <div class="col-md-8 login-welcome bold">
            <div class="text-center">
                <h1>Welcome to our <span>Website</span> </h1>
                <span>Login to access your admin account</span>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/projectx/Desktop/laravelProjects/movieflix-main/resources/views/auth/login.blade.php ENDPATH**/ ?>