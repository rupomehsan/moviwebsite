<?php $__env->startSection('content'); ?>
    <?php
    $logo = \App\Models\Setting::first();
    ?>
    <!-- video section start -->
    <section class="video ptb-90">
        <div class="container">
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-10 margin-top-40 legal-information">
                    <h3>About Us</h3>
                    <div class="legal-information-description margin-top-20">
                        <?php echo $logo->about_us ?? ''; ?>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- video section end -->
<?php $__env->stopSection(); ?>
<?php $__env->startPush('custom-js'); ?>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('frontend.layouts.client.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ccninfot/movieflix.ccninfotech.com/resources/views/frontend/client/aboutUs.blade.php ENDPATH**/ ?>