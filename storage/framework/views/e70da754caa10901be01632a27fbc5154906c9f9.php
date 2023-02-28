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
                    <?php if(request('type') == 'about_us'): ?>
                        <h3>About Us</h3>
                        <div class="legal-information-description margin-top-20">
                            <?php echo $logo->about_us ?? ''; ?>

                        </div>
                    <?php elseif(request('type') == 'terms_policy'): ?>
                        <h3>Term s & Conditions</h3>
                        <div class="legal-information-description margin-top-20">
                            <?php echo $logo->terms_policy ?? ''; ?>

                        </div>
                    <?php elseif(request('type') == 'privacy_policy'): ?>
                        <h3>Privecy Policy</h3>
                        <div class="legal-information-description margin-top-20">
                            <?php echo $logo->privacy_policy ?? ''; ?>

                        </div>
                    <?php elseif(request('type') == 'cookies_policy'): ?>
                        <h3>Cookies Policy</h3>
                        <div class="legal-information-description margin-top-20">
                            <?php echo $logo->cookies_policy ?? ''; ?>

                        </div>
                    <?php endif; ?>

                </div>
            </div>
        </div>
    </section>
    <!-- video section end -->
<?php $__env->stopSection(); ?>
<?php $__env->startPush('custom-js'); ?>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('frontend.layouts.client.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/projectx/Desktop/laravelProjects/movieflix-main/resources/views/frontend/client/legalInformation.blade.php ENDPATH**/ ?>