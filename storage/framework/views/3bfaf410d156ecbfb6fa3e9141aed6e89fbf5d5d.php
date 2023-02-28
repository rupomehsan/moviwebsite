<?php $__env->startSection('content'); ?>
    
<div class="container margin-top-100">
    <div class="header-add-section ads-section category-top-header-section row">
        <div class="text-right">
            <img src="<?php echo e(URL::to('/')); ?>/uploads/videoTopBanner.png" alt="">
        </div>
    </div>
    
    <div class="margin-top-40">
        <div class="stript-success-message">
            Congratulations! You are now our premium member.
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('custom-js'); ?>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('frontend.layouts.client.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ccninfot/movieflix.ccninfotech.com/resources/views/frontend/client/stripeSuccess.blade.php ENDPATH**/ ?>