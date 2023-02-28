<?php $__env->startSection('content'); ?>
    <div class="frontend-login-pannel row margin-top-150">
        <div class="frontend-login-title col-md-12 text-center">Login Here</div>
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <form method="POST" action="<?php echo e(route('login')); ?>">
                <?php echo csrf_field(); ?>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">Email</span>
                    </div>

                    <input id="email" type="email" class="form-control <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="email"
                        value="<?php echo e(old('email')); ?>" placeholder="Type your email" required autocomplete="email"
                        aria-describedby="basic-addon1">


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

                <div class="input-group mb-3 margin-top-40">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon2">Password</span>
                    </div>

                    <input id="password" type="password" class="form-control <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                        name="password" placeholder="Type your password" required autocomplete="current-password"
                        aria-describedby="basic-addon2">


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

                <div class="form-group text-center margin-top-40">
                    <button type="submit" class="btn btn-danger login-submit login-submit-button">
                        LOG IN
                    </button>
                </div>
            </form>

            <div class="row forgot-registration">
                <div class="col-md-12 text-center margin-top-20">
                    <p> <a href="/forgot-password-email" class="blue-text">Forgot Password?</a></p>
                </div>
                <div class="col-md-12 margin-top-20 text-center">
                    <span>Need An Account ?</span>
                    <a href="/registration" class="blue-text">Register Now</a>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('custom-js'); ?>
    <script>
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('frontend.layouts.client.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/projectx/Desktop/laravelProjects/movieflix-main/resources/views/frontend/client/login.blade.php ENDPATH**/ ?>