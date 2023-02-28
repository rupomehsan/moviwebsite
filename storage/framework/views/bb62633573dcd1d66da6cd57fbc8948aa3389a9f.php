

<div class="form-select">
    <select id="seriesId" class="form-control create-form" name="series_id">
        <option value="0" selected>Select Series</option>
        <?php if(!empty($seriesList)): ?>
        <?php $__currentLoopData = $seriesList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo e($id); ?>"><?php echo e($name); ?></option>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php endif; ?>
    </select>
</div><?php /**PATH /home/projectx/Desktop/laravelProjects/movieflix-main/resources/views/video/getSeries.blade.php ENDPATH**/ ?>