<?php $__env->startSection('data_count'); ?>
    
    <div class="content-heading">
        <div class="row">
            
            <div class="col-md-8 content-title">
                <span class="title">Make Payment</span>
                <div class="title-line"></div>
            </div>
            
        </div>
    </div>
    

    
    <form id="userCreateForm" method="POST" enctype="multipart/form-data" action="/admin/offline-payment/store">
        <?php echo csrf_field(); ?>
        <div class="row create-body margin-top-40">

            <div class="offset-md-1 col-md-10" id="accessControl">
                <div class="form-select">
                    <select name="user_type" id="user_type" class="form-control create-form">
                        <option selected value="exists">User Already Exists</option>
                        <option selected value="new">New User Create</option>
                    </select>
                    <span class="text-danger"><?php echo e($errors->first('user_type')); ?></span>
                </div>
            </div>

            <div class="offset-md-1 col-md-10 margin-top-10" id="selectUser">
                <div class="form-select">
                    <select name="user_id" id="user_id" class="form-control create-form">
                        <option selected value="0">Select User*</option>
                        <?php if(!empty($user)): ?>
                            <?php $__currentLoopData = $user; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($id); ?>"><?php echo e($name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                    </select>
                    <span class="text-danger"><?php echo e($errors->first('user_id')); ?></span>
                </div>
            </div>

            <div class="offset-md-1 col-md-10 margin-top-10 display-none createUser">
                <div class="form-group">
                    <input type="text" name="name" class="form-control create-form" id="name" placeholder="Name"
                        value="<?php echo e(old('name')); ?>">
                    <span class="text-danger"><?php echo e($errors->first('name')); ?></span>
                </div>
            </div>

            <div class="offset-md-1 col-md-10 margin-top-10 display-none createUser">
                <div class="form-group">
                    <input type="text" name="email" class="form-control create-form" id="email" placeholder="Email"
                        value="<?php echo e(old('email')); ?>">
                    <span class="text-danger"><?php echo e($errors->first('email')); ?></span>
                </div>
            </div>

            <div class="offset-md-1 col-md-10 margin-top-10 display-none createUser">
                <div class="form-group">
                    <input type="text" name="phone" class="form-control create-form" id="phone" placeholder="Phone"
                        value="<?php echo e(old('phone')); ?>">
                    <span class="text-danger"><?php echo e($errors->first('phone')); ?></span>
                </div>
            </div>

            <div class="offset-md-1 col-md-10 margin-top-10">
                <div class="form-select">
                    <select name="package_id" id="package_id" class="form-control create-form">
                        <option selected value="0">Select Package*</option>
                        <?php if(!empty($package)): ?>
                            <?php $__currentLoopData = $package; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($id); ?>"><?php echo e($name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                    </select>
                    <span class="text-danger"><?php echo e($errors->first('package_id')); ?></span>
                </div>
            </div>

            <div class="offset-md-1 col-md-10 margin-top-10">
                <div class="form-group">
                    <input type="text" name="amount" class="form-control create-form" id="amount"
                        placeholder="Amount (USD)*" value="<?php echo e(old('amount')); ?>">
                    <span class="text-danger"><?php echo e($errors->first('amount')); ?></span>
                </div>
            </div>

            <div class="offset-md-1 col-md-4 margin-top-10">
                <div class="form-group">
                    <label for="meta_description">Start Date*</label>
                    <input type="date" name="start_date" class="form-control create-form" id="start_date"
                        placeholder="Start Date" value="<?php echo e(old('start_date')); ?>">
                    <span class="text-danger"><?php echo e($errors->first('start_date')); ?></span>
                </div>
            </div>

            <div class="offset-md-1 col-md-10 actions margin-top-20">
                <button class="submit margin-bottom-20">Save</button>
                <a href="/admin/offline-payment" class="cancel">Cancel</a>
            </div>
            <div class=" margin-top-40">
            </div>
        </div>
    </form>
    



<?php $__env->stopSection(); ?>
<?php $__env->startPush('custom-js'); ?>
    <script type="text/javascript">
        $(document).on("click", "#user_type", function(e) {
            e.preventDefault();
            // alert($(this).val());

            if (($(this).val()) == 'exists') {
                $('#selectUser').show();
                $('.createUser').hide();
            }
            if (($(this).val()) == 'new') {
                $('#selectUser').hide();
                $('.createUser').show();
            }
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.default.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ccninfot/movieflix.ccninfotech.com/resources/views/packageSubscriber/offlineMakePayment.blade.php ENDPATH**/ ?>