

<div class="form-select">
    <select id="episod" class="form-control create-form" name="episod_id">
        <option value="0" selected>Select Episode</option>
        <?php if(!empty($episodList)): ?>
        <?php $__currentLoopData = $episodList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo e($id); ?>"><?php echo e($name); ?></option>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php endif; ?>
    </select>
</div><?php /**PATH /home/projectx/Desktop/laravelProjects/movieflix-main/resources/views/video/getEpisod.blade.php ENDPATH**/ ?>