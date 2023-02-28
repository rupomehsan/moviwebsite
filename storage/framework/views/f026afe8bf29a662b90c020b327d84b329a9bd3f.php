<div class="row margin-top-40" id="category<?php echo e($category->id); ?>">

    <input type="hidden" name="category_id[<?php echo e($category->name); ?>]" value="<?php echo e($category->id); ?>">

    <div class="col-md-6 bold video-setting-content-name">
        <button type="button" class="remove-category-settings" data-id="<?php echo e($category->id); ?>"
            title="Remove this category">-</button> &nbsp;
        <input type="hidden" name="name[]" value="<?php echo e($category->name); ?>">
        <span><?php echo e($category->name); ?></span>
    </div>
    <div class="col-md-2 video-setting-content-vertical">
        <div class="form-check form-switch">
            <label class="form-check-label" for="verticalImg<?php echo e($category->id); ?>">VERTICAL IMAGE</label>
            <input class="form-check-input vertical-image vertical-image-<?php echo e($category->id); ?>"
                data-class="<?php echo e($category->id); ?>" name="vertical_image[<?php echo e($category->name); ?>]" type="checkbox"
                id="verticalImg<?php echo e($category->id); ?>" checked>

        </div>
    </div>
    <div class="col-md-2 video-setting-content-horizontal">
        <div class="form-check form-switch">
            <label class="form-check-label" for="horizontalImg<?php echo e($category->id); ?>">HORIZONTAL IMAGE</label>
            <input class="form-check-input horizontal-image horizontal-image-<?php echo e($category->id); ?>"
                data-class="<?php echo e($category->id); ?>" name="horizontal_image[<?php echo e($category->name); ?>]" type="checkbox"
                id="horizontalImg<?php echo e($category->id); ?>">
        </div>
    </div>
    <div class="col-md-2 video-setting-content-number text-center">
        <input type="number" name="video_number[<?php echo e($category->name); ?>]">
    </div>
</div>
<?php /**PATH /home/ccninfot/movieflix.ccninfotech.com/resources/views/settings/getCategoryContent.blade.php ENDPATH**/ ?>