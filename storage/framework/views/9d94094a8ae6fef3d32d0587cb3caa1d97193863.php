<div class="modal-content">
    <div class="modal-title">
        <h4>Edit Tv Channel</h4>
        <div class="title-line"></div>
    </div>
    <form id="tvEditForm" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo e($target->id); ?>">

        <div class="form-group margin-top-20">
            <input name="name" type="text" class="form-control create-form" id="name"
                placeholder="Tv Channel Name" value="<?php echo e($target->name); ?>">
        </div>

        <div class="form-group margin-top-20">
            <input name="url" type="text" class="form-control create-form" id="url"
                placeholder="Stream URL" value="<?php echo e($target->url); ?>">
        </div>

        <div class="form-group margin-top-20">
            <select name="tv_channel_category_id" id="tvType" class="form-control create-form">
                <option value="0">Select Category</option>

                <?php if(!empty($categoryList)): ?>
                    <?php $__currentLoopData = $categoryList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php
                        $selected = '';
                        if ($id == $target->tv_channel_category_id) {
                            $selected = 'selected';
                        }
                        ?>
                        <option value="<?php echo e($id); ?>" <?php echo e($selected); ?>><?php echo e($name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>

            </select>
        </div>

        <div class="form-group margin-top-20">
            <select name="stream_type" id="streamType" class="form-control create-form">
                <option value="0">Select Stream Type</option>

                <?php if(!empty($streamTypeArr)): ?>
                    <?php $__currentLoopData = $streamTypeArr; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php
                        $selected = '';
                        if ($id == $target->stream_type) {
                            $selected = 'selected';
                        }
                        ?>
                        <option value="<?php echo e($id); ?>" <?php echo e($selected); ?>><?php echo e($name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>

            </select>
        </div>


        <div class="form-group margin-top-20">
            <select name="file_type" id="upload_type" class="form-control create-form">
                <option value="file" <?php echo $target->file_type == 'file' || $target->file_type == null ? 'selected' : ''; ?>>File</option>
                <option value="link"<?php echo $target->file_type == 'link' ? 'selected' : ''; ?>>Link</option>
            </select>
        </div>

        <div class="form-group margin-top-20 <?php echo $target->file_type == 'link' ? '' : 'display-none'; ?>" id="fileLinkSection">
            <input name="file_link" type="text" class="form-control create-form" id="file_link"
                placeholder="Enter File Link" value="<?php echo e($target->file_link); ?>">
        </div>

        <div class="file-upload-edit <?php echo $target->file_type == 'link' ? 'display-none-urgent' : ''; ?>">
            <div class="image-upload-wrap-edit">
                <input value="" name="image" class="file-upload-input-edit" type='file'
                    onchange="readURLEdit(this);" accept="image/*" />
                <div class="drag-text-edit text-center">
                    <span class="iconify" data-icon="bx:bx-image-alt"></span>
                    <span>Upload Image Or Drag Here</span>
                </div>
            </div>
            <div class="image-size-recomandation-edit display-none">
                <ul>
                    <li>Recomanded Image Size 200px*80px</li>
                </ul>
            </div>
            <div class="file-upload-content-edit">
                <div class="image-title-wrap-edit">
                    <img class="file-upload-image-edit" src="<?php echo e(URL::to('/')); ?>/uploads/tv/<?php echo e($target->image); ?>"
                        alt="your image" />
                    <button type="button" onclick="removeUploadEdit()" class="remove-image-edit">
                        <span class="iconify" data-icon="akar-icons:cross"></span>
                    </button>
                </div>
            </div>
        </div>

        
        <div class="col-md-12">
            <div class="form-check form-switch margin-top-20 text-center">
                <label class="form-check-label" for="parentalYesNo">Is this video is Parental Content? </label>
                <input class="form-check-input" name="is_parental" type="checkbox" id="parentalYesNo"
                    <?php echo e($target->is_parental == 'on' ? 'checked' : ''); ?>>
                <span class="text-danger"><?php echo e($errors->first('is_parental')); ?></span>
            </div>
        </div>

        <div class="actions margin-top-10">
            <button class="submit margin-top-10" type="submit" id="editTv">Update</button>
            <button type="button" class="cancel margin-top-10" data-dismiss="modal">Cancel</button>
        </div>
    </form>

</div>
<?php /**PATH /home/ccninfot/movieflix.ccninfotech.com/resources/views/tv/edit.blade.php ENDPATH**/ ?>