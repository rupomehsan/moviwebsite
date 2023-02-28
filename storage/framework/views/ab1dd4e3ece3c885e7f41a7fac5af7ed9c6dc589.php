<?php if(!empty($paymentSettings)): ?>
    <h3 class="text-center">Select Your Preferable Payment Method</h3>

    <div class="row margin-top-40">
        <div class="col-md-12 text-center">
            <?php if(!empty($paymentSettings->paypal_client_id) && !empty($paymentSettings->paypal_secret)): ?>
                <button type="button" class="paypal-select-btn payment-method-select-btn" data-id="<?php echo e(request('id')); ?>"
                    data-validity="<?php echo e(request('validity')); ?>" data-name="<?php echo e(request('name')); ?>" data-transactionId=""
                    data-price="<?php echo e(request('price')); ?>">
                    <span class="iconify" data-icon="logos:paypal"></span>
                    <span class="paypal-pay">Pay</span><span class="paypal-pal">Pal</span>
                </button>
                <br>
            <?php endif; ?>

            <?php if(!empty($paymentSettings->stripe_publishable_key)): ?>
                
                <form action="payment/stripe-transaction-data-store" method="POST">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" name="package_id" value="<?php echo e(request('id')); ?>">
                    
                    
                    
                    <button type="submit" class="stripe-select-btn payment-method-select-btn margin-top-20"
                        data-id="<?php echo e(request('id')); ?>" data-validity="<?php echo e(request('validity')); ?>"
                        data-transactionId="" data-name="<?php echo e(request('name')); ?>" data-price="<?php echo e(request('price')); ?>">
                        Stripe
                    </button>
                </form>
            <?php endif; ?>
        </div>
    </div>
<?php else: ?>
    <h3 class="red text-center">This Feature Currently Switched Off !</h3>
<?php endif; ?>
<?php /**PATH /home/ccninfot/movieflix.ccninfotech.com/resources/views/frontend/client/getPaymentMethods.blade.php ENDPATH**/ ?>