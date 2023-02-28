<div class="modal-content">
    <div class="modal-title">
        <h4>Add Notification</h4>
        <div class="title-line"></div>
    </div>
    <form id="notificationCreateForm" method="POST" enctype="multipart/form-data">
        <div class="form-group margin-top-20">
            <input type="text" name="title" class="form-control create-form" id="title" placeholder="Notification title">
        </div>
        <div class="form-group margin-top-20">
            <input type="text" name="description" class="form-control create-form" id="description" placeholder="Notification description">
        </div>

        <div class="file-upload">
            <div class="image-upload-wrap">
                <input name="image" class="file-upload-input" type='file' onchange="readURL(this);" accept="image/*" />
                <div class="drag-text text-center">
                    <span class="iconify" data-icon="bx:bx-image-alt"></span>
                    <span>Upload Image Or Drag Here</span>
                </div>
            </div>
            <div class="file-upload-content">
                <div class="image-title-wrap">
                    <img class="file-upload-image" src="#" alt="your image" />
                    <button type="button" onclick="removeUpload()" class="remove-image"><span class="iconify" data-icon="akar-icons:cross"></span></button>
                </div>
            </div>
        </div>

        <div class="form-group margin-top-20">
            <select name="video_id" id="videoId" class="form-control create-form">
                <option value="0">Select Video</option>
                <?php if(!empty($videoList)): ?>
                <?php $__currentLoopData = $videoList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id=>$name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($id); ?>"><?php echo e($name); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
            </select>
        </div>
        <div class="form-group margin-top-20">
            <select name="tv_channel_id" id="tvId" class="form-control create-form">
                <option value="0">Select TV Channel</option>
                <?php if(!empty($tvList)): ?>
                <?php $__currentLoopData = $tvList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id=>$name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($id); ?>"><?php echo e($name); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
            </select>
        </div>
        <div class="form-group margin-top-20">
            <input name="external_link" type="text" class="form-control create-form" id="externalurl" placeholder="External link">
        </div>

        <div class="actions margin-top-10">
            <button class="submit margin-top-10" type="submit" id="createNotification">Add Notification</button>
            <button type="button" class="cancel margin-top-10" data-dismiss="modal">Cancel</button>
        </div>
    </form>
</div>
<?php /**PATH /home/ccninfot/movieflix.ccninfotech.com/resources/views/notification/create.blade.php ENDPATH**/ ?>