<div class="modal-content">
    <div class="modal-title">
        <h4>Edit Top Feature</h4>
        <div class="title-line"></div>
    </div>
    <form id="topFeatureEditForm" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo e($target->top_features_id); ?>">

        <div class="form-group margin-top-20">
            <select name="video_id" id="videoId" class="form-control create-form">
                <option value="0">Select Video</option>
                <?php $__currentLoopData = $videoList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php
                    $selected = '';
                    if ($id == $target->video_id) {
                        $selected = 'selected';
                    }
                    ?>
                    <option value="<?php echo e($id); ?>" <?php echo e($selected); ?>><?php echo e($name); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>
        <div id="preview">
            <?php if(!empty($target->thumbnail)): ?>
                <img src="<?php echo e(URL::to('/')); ?>/uploads/video/thumbnail/<?php echo e($target->thumbnail); ?>"
                    alt="<?php echo e($target->title); ?>" title="<?php echo e($target->title); ?>" />
            <?php else: ?>
                <img src="<?php echo e(URL::to('/')); ?>/uploads/no.jpeg" alt="" />
            <?php endif; ?>

        </div>

        <div class="actions margin-top-10">
            <button class="submit margin-top-10" type="submit" id="editTopFeature">Edit Top Feature</button>
            <button type="button" class="cancel margin-top-10" data-dismiss="modal">Cancel</button>
        </div>
    </form>

</div>
<?php /**PATH /home/ccninfot/movieflix.ccninfotech.com/resources/views/topFeature/edit.blade.php ENDPATH**/ ?>