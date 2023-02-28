<div class="modal-content">
    <div class="modal-title">
        <h4>Add Tv Channel</h4>
        <div class="title-line"></div>
    </div>
    <form id="tvCreateForm" method="POST" enctype="multipart/form-data">
        <div class="form-group margin-top-20">
            <input type="text" name="name" class="form-control create-form" id="name"
                placeholder="Tv Channel Name">
        </div>
        <div class="form-group margin-top-20">
            <input type="text" name="url" class="form-control create-form" id="url"
                placeholder="Stream URL">
        </div>
        <div class="form-group margin-top-20">
            <select name="tv_channel_category_id" id=" categoryType" class="form-control create-form">
                <option value="0">Select Category</option>
                <?php if(!empty($categoryList)): ?>
                    <?php $__currentLoopData = $categoryList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($id); ?>"><?php echo e($name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
            </select>
        </div>
        <div class="form-group margin-top-20">
            <select name="stream_type" id="streamType" class="form-control create-form">
                <option value="0">Select Stream Type</option>
                <?php $__currentLoopData = $streamTypeArr; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($id); ?>"><?php echo e($name); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>


        <div class="form-group margin-top-20">
            <select name="file_type" id="upload_type" class="form-control create-form">
                <option value="file">File</option>
                <option value="link">Link</option>
            </select>
        </div>

        <div class="form-group margin-top-20 display-none" id="fileLinkSection">
            <input name="file_link" type="text" class="form-control create-form" id="file_link"
                placeholder="Enter File Link">
        </div>

        <div class="file-upload">
            <div class="image-upload-wrap">
                <input name="image" class="file-upload-input" type='file' onchange="readURL(this);"
                    accept="image/*" />
                <div class="drag-text text-center">
                    <span class="iconify" data-icon="bx:bx-image-alt"></span>
                    <span>Upload Image Or Drag Here</span>
                </div>
            </div>
            <div class="image-size-recomandation">
                <ul>
                    <li>Recomanded Image Size 200px*80px</li>
                </ul>
            </div>
            <div class="file-upload-content">
                <div class="image-title-wrap">
                    <img class="file-upload-image" src="#" alt="your image" />
                    <button type="button" onclick="removeUpload()" class="remove-image"><span class="iconify"
                            data-icon="akar-icons:cross"></span></button>
                </div>
            </div>
        </div>
        
        <div class="col-md-12">
            <div class="form-check form-switch margin-top-20">
                <label class="form-check-label" for="parentalYesNo">Is this video is Parental Content? </label>
                <input class="form-check-input" name="is_parental" type="checkbox" id="parentalYesNo">
                <span class="text-danger"><?php echo e($errors->first('is_parental')); ?></span>
            </div>
        </div>

        <div class="actions margin-top-10">
            <button class="submit margin-top-10" type="submit" id="createTv">Save</button>
            <button type="button" class="cancel margin-top-10" data-dismiss="modal">Cancel</button>
        </div>
    </form>
</div>
<?php /**PATH /home/ccninfot/movieflix.ccninfotech.com/resources/views/tv/create.blade.php ENDPATH**/ ?>