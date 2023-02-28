<input type="hidden" name="show_page" value="<?php echo e($category->name); ?>">
<div class="video-setting-content margin-top-20">
    
    <?php if(!$target->isEmpty()): ?>
        <?php $__currentLoopData = $target; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if($data->name == 'top featured'): ?>
                <div class="row margin-top-40">
                    <div class="col-md-6 bold video-setting-content-name"><span>TOP FEATURED</span></div>
                    <input type="hidden" name="name[]" value="top featured">
                    <div class="col-md-2 video-setting-content-vertical">
                        <div class="form-check form-switch">
                            <label class="form-check-label" for="verticalImg">VERTICAL IMAGE</label>
                            <input class="form-check-input vertical-image vertical-image-featured"
                                data-class="featured" name="vertical_image[top featured]" type="checkbox"
                                id="verticalImg" <?php echo $data->vertical_image == 'on' ? 'checked' : ''; ?>>
                        </div>
                    </div>
                    <div class="col-md-2 video-setting-content-horizontal">
                        <div class="form-check form-switch">
                            <label class="form-check-label" for="horizontalImg">HORIZONTAL IMAGE</label>
                            <input class="form-check-input horizontal-image horizontal-image-featured"
                                data-class="featured"" name=" horizontal_image[top featured]" type="checkbox"
                                id="horizontalImg" <?php echo $data->horizontal_image == 'on' ? 'checked' : ''; ?>>
                        </div>
                    </div>
                    <div class="col-md-2 video-setting-content-number text-center">
                        <input type="number" name="video_number[top featured]" value="<?php echo e($data->video_number); ?>">
                    </div>
                </div>
            <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php else: ?>
        <div class="row margin-top-40">
            <div class="col-md-6 bold video-setting-content-name">
                <input type="hidden" name="name[]" value="top featured">
                <span>TOP FEATURED</span>
            </div>
            <div class="col-md-2 video-setting-content-vertical">
                <div class="form-check form-switch">
                    <label class="form-check-label" for="verticalImg">VERTICAL IMAGE</label>
                    <input class="form-check-input vertical-image vertical-image-featured" data-class="featured"
                        name="vertical_image[top featured]" type="checkbox" id="verticalImg" checked>
                </div>
            </div>
            <div class="col-md-2 video-setting-content-horizontal">
                <div class="form-check form-switch">
                    <label class="form-check-label" for="horizontalImg">HORIZONTAL IMAGE</label>
                    <input class="form-check-input horizontal-image horizontal-image-featured"
                        data-class="featured" name="horizontal_image[top featured]" type="checkbox"
                        id="horizontalImg">
                </div>
            </div>
            <div class="col-md-2 video-setting-content-number text-center">
                <input type="number" name="video_number[top featured]">
            </div>
        </div>
    <?php endif; ?>
    



    
    <?php if(!$target->isEmpty()): ?>
        <?php $__currentLoopData = $target; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if($data->name == 'trending now'): ?>
                <div class="row margin-top-40">
                    <div class="col-md-6 bold video-setting-content-name"><span>TRENDING NOW</span></div>
                    <input type="hidden" name="name[]" value="trending now">
                    <div class="col-md-2 video-setting-content-vertical">
                        <div class="form-check form-switch">
                            <label class="form-check-label" for="verticalImg">VERTICAL IMAGE</label>
                            <input class="form-check-input vertical-image vertical-image-trending"
                                data-class="trending" name="vertical_image[trending now]" type="checkbox"
                                id="verticalImg" <?php echo $data->vertical_image == 'on' ? 'checked' : ''; ?>>
                        </div>
                    </div>
                    <div class="col-md-2 video-setting-content-horizontal">
                        <div class="form-check form-switch">
                            <label class="form-check-label" for="horizontalImg">HORIZONTAL IMAGE</label>
                            <input class="form-check-input horizontal-image horizontal-image-trending"
                                data-class="trending"" name=" horizontal_image[trending now]" type="checkbox"
                                id="horizontalImg" <?php echo $data->horizontal_image == 'on' ? 'checked' : ''; ?>>
                        </div>
                    </div>
                    <div class="col-md-2 video-setting-content-number text-center">
                        <input type="number" name="video_number[trending now]" value="<?php echo e($data->video_number); ?>">
                    </div>
                </div>
            <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php else: ?>
        <div class="row margin-top-40">
            <div class="col-md-6 bold video-setting-content-name">
                <input type="hidden" name="name[]" value="trending now">
                <span>TRENDING NOW</span>
            </div>
            <div class="col-md-2 video-setting-content-vertical">
                <div class="form-check form-switch">
                    <label class="form-check-label" for="verticalImg">VERTICAL IMAGE</label>
                    <input class="form-check-input vertical-image vertical-image-trending" data-class="trending"
                        name="vertical_image[trending now]" type="checkbox" id="verticalImg" checked>
                </div>
            </div>
            <div class="col-md-2 video-setting-content-horizontal">
                <div class="form-check form-switch">
                    <label class="form-check-label" for="horizontalImg">HORIZONTAL IMAGE</label>
                    <input class="form-check-input horizontal-image horizontal-image-trending"
                        data-class="trending" name="horizontal_image[trending now]" type="checkbox"
                        id="horizontalImg">
                </div>
            </div>
            <div class="col-md-2 video-setting-content-number text-center">
                <input type="number" name="video_number[trending now]">
            </div>
        </div>
    <?php endif; ?>
    


    
    <?php if(!$target->isEmpty()): ?>
        <?php $__currentLoopData = $target; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if($data->name == 'just added'): ?>
                <div class="row margin-top-40">
                    <div class="col-md-6 bold video-setting-content-name"><span>JUST ADDED</span></div>
                    <input type="hidden" name="name[]" value="just added">
                    <div class="col-md-2 video-setting-content-vertical">
                        <div class="form-check form-switch">
                            <label class="form-check-label" for="verticalImg">VERTICAL IMAGE</label>
                            <input class="form-check-input vertical-image vertical-image-just"
                                data-class="just" name="vertical_image[just added]" type="checkbox"
                                id="verticalImg" <?php echo $data->vertical_image == 'on' ? 'checked' : ''; ?>>
                        </div>
                    </div>
                    <div class="col-md-2 video-setting-content-horizontal">
                        <div class="form-check form-switch">
                            <label class="form-check-label" for="horizontalImg">HORIZONTAL IMAGE</label>
                            <input class="form-check-input horizontal-image horizontal-image-just"
                                data-class="just" name="horizontal_image[just added]" type="checkbox"
                                id="horizontalImg" <?php echo $data->horizontal_image == 'on' ? 'checked' : ''; ?>>
                        </div>
                    </div>
                    <div class="col-md-2 video-setting-content-number text-center">
                        <input type="number" name="video_number[just added]" value="<?php echo e($data->video_number); ?>">
                    </div>
                </div>
            <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php else: ?>
        <div class="row margin-top-40">
            <div class="col-md-6 bold video-setting-content-name">
                <input type="hidden" name="name[]" value="just added">
                <span>JUST ADDED</span>
            </div>
            <div class="col-md-2 video-setting-content-vertical">
                <div class="form-check form-switch">
                    <label class="form-check-label" for="verticalImg">VERTICAL IMAGE</label>
                    <input class="form-check-input vertical-image vertical-image-just" data-class="just"
                        name="vertical_image[just added]" type="checkbox" id="verticalImg" checked>
                </div>
            </div>
            <div class="col-md-2 video-setting-content-horizontal">
                <div class="form-check form-switch">
                    <label class="form-check-label" for="horizontalImg">HORIZONTAL IMAGE</label>
                    <input class="form-check-input horizontal-image horizontal-image-just"
                        data-class="just" name="horizontal_image[just added]" type="checkbox"
                        id="horizontalImg">
                </div>
            </div>
            <div class="col-md-2 video-setting-content-number text-center">
                <input type="number" name="video_number[just added]">
            </div>
        </div>
    <?php endif; ?>
    


    
    <?php if(!$target->isEmpty()): ?>
        <?php $__currentLoopData = $target; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if($data->name == 'popular'): ?>
                <div class="row margin-top-40">
                    <div class="col-md-6 bold video-setting-content-name"><span>POPULAR</span></div>
                    <input type="hidden" name="name[]" value="popular">
                    <div class="col-md-2 video-setting-content-vertical">
                        <div class="form-check form-switch">
                            <label class="form-check-label" for="verticalImg">VERTICAL IMAGE</label>
                            <input class="form-check-input vertical-image vertical-image-popular"
                                data-class="popular" name="vertical_image[popular]" type="checkbox"
                                id="verticalImg" <?php echo $data->vertical_image == 'on' ? 'checked' : ''; ?>>
                        </div>
                    </div>
                    <div class="col-md-2 video-setting-content-horizontal">
                        <div class="form-check form-switch">
                            <label class="form-check-label" for="horizontalImg">HORIZONTAL IMAGE</label>
                            <input class="form-check-input horizontal-image horizontal-image-popular"
                                data-class="popular" name="horizontal_image[popular]" type="checkbox"
                                id="horizontalImg" <?php echo $data->horizontal_image == 'on' ? 'checked' : ''; ?>>
                        </div>
                    </div>
                    <div class="col-md-2 video-setting-content-number text-center">
                        <input type="number" name="video_number[popular]" value="<?php echo e($data->video_number); ?>">
                    </div>
                </div>
            <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php else: ?>
        <div class="row margin-top-40">
            <div class="col-md-6 bold video-setting-content-name">
                <input type="hidden" name="name[]" value="popular">
                <span>POPULAR</span>
            </div>
            <div class="col-md-2 video-setting-content-vertical">
                <div class="form-check form-switch">
                    <label class="form-check-label" for="verticalImg">VERTICAL IMAGE</label>
                    <input class="form-check-input vertical-image vertical-image-popular" data-class="popular"
                        name="vertical_image[popular]" type="checkbox" id="verticalImg" checked>
                </div>
            </div>
            <div class="col-md-2 video-setting-content-horizontal">
                <div class="form-check form-switch">
                    <label class="form-check-label" for="horizontalImg">HORIZONTAL IMAGE</label>
                    <input class="form-check-input horizontal-image horizontal-image-popular"
                        data-class="popular" name="horizontal_image[popular]" type="checkbox"
                        id="horizontalImg">
                </div>
            </div>
            <div class="col-md-2 video-setting-content-number text-center">
                <input type="number" name="video_number[popular]">
            </div>
        </div>
    <?php endif; ?>
    


    
    <?php if(!$target->isEmpty()): ?>
        <?php $__currentLoopData = $target; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if($data->name == 'dont miss'): ?>
                <div class="row margin-top-40">
                    <div class="col-md-6 bold video-setting-content-name"><span>DON'T MISS</span></div>
                    <input type="hidden" name="name[]" value="dont miss">
                    <div class="col-md-2 video-setting-content-vertical">
                        <div class="form-check form-switch">
                            <label class="form-check-label" for="verticalImg">VERTICAL IMAGE</label>
                            <input class="form-check-input vertical-image vertical-image-miss"
                                data-class="miss" name="vertical_image[dont miss]" type="checkbox"
                                id="verticalImg" <?php echo $data->vertical_image == 'on' ? 'checked' : ''; ?>>
                        </div>
                    </div>
                    <div class="col-md-2 video-setting-content-horizontal">
                        <div class="form-check form-switch">
                            <label class="form-check-label" for="horizontalImg">HORIZONTAL IMAGE</label>
                            <input class="form-check-input horizontal-image horizontal-image-miss"
                                data-class="miss" name="horizontal_image[dont miss]" type="checkbox"
                                id="horizontalImg" <?php echo $data->horizontal_image == 'on' ? 'checked' : ''; ?>>
                        </div>
                    </div>
                    <div class="col-md-2 video-setting-content-number text-center">
                        <input type="number" name="video_number[dont miss]" value="<?php echo e($data->video_number); ?>">
                    </div>
                </div>
            <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php else: ?>
        <div class="row margin-top-40">
            <div class="col-md-6 bold video-setting-content-name">
                <input type="hidden" name="name[]" value="dont miss">
                <span>DON'T MISS</span>
            </div>
            <div class="col-md-2 video-setting-content-vertical">
                <div class="form-check form-switch">
                    <label class="form-check-label" for="verticalImg">VERTICAL IMAGE</label>
                    <input class="form-check-input vertical-image vertical-image-miss" data-class="miss"
                        name="vertical_image[dont miss]" type="checkbox" id="verticalImg" checked>
                </div>
            </div>
            <div class="col-md-2 video-setting-content-horizontal">
                <div class="form-check form-switch">
                    <label class="form-check-label" for="horizontalImg">HORIZONTAL IMAGE</label>
                    <input class="form-check-input horizontal-image horizontal-image-miss"
                        data-class="miss" name="horizontal_image[dont miss]" type="checkbox"
                        id="horizontalImg">
                </div>
            </div>
            <div class="col-md-2 video-setting-content-number text-center">
                <input type="number" name="video_number[dont miss]">
            </div>
        </div>
    <?php endif; ?>
    

    <div class="offset-md-1 col-md-3 margin-top-10">
        <div class="form-group">
            <select id="subCategoryVS" class="form-control create-form settings-drop-down">
                <option value=" 0">Select Sub Category</option>
                <?php $__currentLoopData = $subCategoryList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php $class = ''; ?>

                    <?php if(!$target->isEmpty()): ?>
                        <?php $__currentLoopData = $target; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if($data->sub_category_id == $id): ?>
                                <?php $class = 'display-none'; ?>
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>

                    <option id="op<?php echo e($id); ?>" class="<?php echo e($class); ?>" value="<?php echo e($id); ?>">
                        <?php echo e($name); ?>

                    </option>

                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>
    </div>

    <div id="showSubCategoryContent">

        <?php if(!$target->isEmpty()): ?>
            <?php $__currentLoopData = $target; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if($data->sub_category_id != '0'): ?>
                    <div class="row margin-top-40" id="subCategory<?php echo e($data->sub_category_id); ?>">
                        <input type="hidden" name="sub_category_id[<?php echo e($data->name); ?>]"
                            value="<?php echo e($data->sub_category_id); ?>">
                        <div class="col-md-6 bold video-setting-content-name">
                            <button type="button" class="remove-category-settings"
                                data-id="<?php echo e($data->sub_category_id); ?>" title="Remove this sub category">-</button> &nbsp;
                            <span><?php echo e($data->name); ?></span>
                        </div>
                        <input type="hidden" name="name[]" value="<?php echo e($data->name); ?>">

                        <div class="col-md-2 video-setting-content-vertical">
                            <div class="form-check form-switch">
                                <label class="form-check-label" for="verticalImg">VERTICAL IMAGE</label>
                                <input
                                    class="form-check-input vertical-image vertical-image-<?php echo e($data->sub_category_id); ?>"
                                    data-class="<?php echo e($data->sub_category_id); ?>"
                                    name="vertical_image[<?php echo e($data->name); ?>]" type="checkbox" id="verticalImg"
                                    <?php echo $data->vertical_image == 'on' ? 'checked' : ''; ?>>
                            </div>
                        </div>

                        <div class="col-md-2 video-setting-content-horizontal">
                            <div class="form-check form-switch">
                                <label class="form-check-label" for="horizontalImg">HORIZONTAL IMAGE</label>
                                <input
                                    class="form-check-input horizontal-image horizontal-image-<?php echo e($data->sub_category_id); ?>"
                                    data-class="<?php echo e($data->sub_category_id); ?>"
                                    name="horizontal_image[<?php echo e($data->name); ?>]" type="checkbox" id="horizontalImg"
                                    <?php echo $data->horizontal_image == 'on' ? 'checked' : ''; ?>>
                            </div>
                        </div>

                        <div class="col-md-2 video-setting-content-number text-center">
                            <input type="number" name="video_number[<?php echo e($data->name); ?>]"
                                value="<?php echo e($data->video_number); ?>">
                        </div>
                    </div>
                <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?>

    </div>

    <div class="col-md-12 actions margin-top-40">
        <button type="submit" class="submit">Update</button>
        <a href="/admin/video-settings">Cancel</a>
    </div>

</div>
<?php /**PATH /home/ccninfot/movieflix.ccninfotech.com/resources/views/settings/getSettingsCategory.blade.php ENDPATH**/ ?>