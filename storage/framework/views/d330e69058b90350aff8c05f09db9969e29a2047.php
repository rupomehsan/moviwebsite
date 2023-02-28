
            

            <div class="content-title">
                <h4 class="bold">For Mobile</h4>
                <div class="title-line"></div>
            </div>
            <div class="row notification-manage-content-mobile">
                <div class="col-md-10">
                    <div class="form-group margin-top-10">
                        <label for="mobileApiKey">Onesignal Api Key</label>
                        <input name="mobile_api_key" type="text" class="form-control create-form" id="mobileApiKey"
                            placeholder="Api key" value="<?php echo $target->api_key ?? ''; ?>">
                        <span class="text-danger"><?php echo e($errors->first('mobile_api_key')); ?></span>
                    </div>
                </div>

                <div class="col-md-10">
                    <div class="form-group margin-top-10">
                        <label for="mobileApiId">Onesignal Api ID</label>
                        <input name="mobile_api_id" type="text" class="form-control create-form" id="mobileApiId"
                            placeholder="Api ID" value="<?php echo $target->api_id ?? ''; ?>">
                        <span class="text-danger"><?php echo e($errors->first('mobile_api_id')); ?></span>
                    </div>
                </div>
            </div>
            <?php /**PATH /home/ccninfot/movieflix.ccninfotech.com/resources/views/notification/getMobileData.blade.php ENDPATH**/ ?>