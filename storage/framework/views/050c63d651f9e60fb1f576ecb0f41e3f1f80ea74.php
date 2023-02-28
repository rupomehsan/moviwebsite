

    <div class="content-title">
        <h4 class="bold">For Web</h4>
        <div class="title-line"></div>
    </div>
    <div class="row notification-manage-content-web">
        <div class="col-md-10">
            <div class="form-group margin-top-10">
                <label for="webApiKey">Onesignal Api Key</label>
                <input name="web_api_key" type="text" class="form-control create-form" id="webApiKey"
                    placeholder="Api key" value="<?php echo $target->api_key ?? ''; ?>">
                <span class="text-danger"><?php echo e($errors->first('web_api_key')); ?></span>
            </div>
        </div>

        <div class="col-md-10">
            <div class="form-group margin-top-10">
                <label for="webApiId">Onesignal Api ID</label>
                <input name="web_api_id" type="text" class="form-control create-form" id="webApiId"
                    placeholder="Api ID" value="<?php echo $target->api_id ?? ''; ?>">
                <span class="text-danger"><?php echo e($errors->first('web_api_id')); ?></span>
            </div>
        </div>
    </div>
    
<?php /**PATH /home/ccninfot/movieflix.ccninfotech.com/resources/views/notification/getWebData.blade.php ENDPATH**/ ?>