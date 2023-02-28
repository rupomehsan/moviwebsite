<div class="row margin-top-40" id="subCategory<?php echo e($subCategory->id); ?>">

    <input type="hidden" name="sub_category_id[<?php echo e($subCategory->name); ?>]" value="<?php echo e($subCategory->id); ?>">

    <div class="col-md-6 bold video-setting-content-name">
        <button type="button" class="remove-category-settings" data-id="<?php echo e($subCategory->id); ?>"
            title="Remove this sub category">-</button> &nbsp;
        <input type="hidden" name="name[]" value="<?php echo e($subCategory->name); ?>">
        <span><?php echo e($subCategory->name); ?></span>
    </div>
    <div class="col-md-2 video-setting-content-vertical">
        <div class="form-check form-switch">
            <label class="form-check-label" for="verticalImg<?php echo e($subCategory->id); ?>">VERTICAL IMAGE</label>
            <input class="form-check-input vertical-image vertical-image-<?php echo e($subCategory->id); ?>"
                data-class="<?php echo e($subCategory->id); ?>" name="vertical_image[<?php echo e($subCategory->name); ?>]" type="checkbox"
                id="verticalImg<?php echo e($subCategory->id); ?>" checked>

        </div>
    </div>
    <div class="col-md-2 video-setting-content-horizontal">
        <div class="form-check form-switch">
            <label class="form-check-label" for="horizontalImg<?php echo e($subCategory->id); ?>">HORIZONTAL IMAGE</label>
            <input class="form-check-input horizontal-image horizontal-image-<?php echo e($subCategory->id); ?>"
                data-class="<?php echo e($subCategory->id); ?>" name="horizontal_image[<?php echo e($subCategory->name); ?>]" type="checkbox"
                id="horizontalImg<?php echo e($subCategory->id); ?>">
        </div>
    </div>
    <div class="col-md-2 video-setting-content-number text-center">
        <input type="number" name="video_number[<?php echo e($subCategory->name); ?>]">
    </div>
</div>
<?php /**PATH /home/ccninfot/movieflix.ccninfotech.com/resources/views/settings/getSubCategoryContent.blade.php ENDPATH**/ ?>