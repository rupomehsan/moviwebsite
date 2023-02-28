<div class="modal-content">
    <div class="modal-title">
        <h4>Add Top Feature</h4>
        <div class="title-line"></div>
    </div>
    <form id="topFeatureCreateForm" method="POST" enctype="multipart/form-data">

        <div class="form-group margin-top-20">
            <select name="video_id" id="videoId" class="form-control create-form">
                <option value="0" selected>Select Video</option>
                <?php $__currentLoopData = $videoList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id=>$name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($id); ?>"><?php echo e($name); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>  
            </select>
        </div>
        <div id="preview" class="display-none"></div>

        <div class="actions margin-top-10">
            <button class="submit margin-top-10" type="submit" id="createTopFeature">Add Top Feature</button>
            <button type="button" class="cancel margin-top-10" data-dismiss="modal">Cancel</button>
        </div>
    </form>

</div>
<?php /**PATH /home/ccninfot/movieflix.ccninfotech.com/resources/views/topFeature/create.blade.php ENDPATH**/ ?>