

<div class="form-select">
    <select id="season" class="form-control create-form" name="season_id">
        <option value="0" selected>Select Season</option>
        <?php if(!empty($seasonList)): ?>
        <?php $__currentLoopData = $seasonList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo e($id); ?>"><?php echo e($name); ?></option>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php endif; ?>
    </select>
</div><?php /**PATH /home/ccninfot/movieflix.ccninfotech.com/resources/views/video/getSeason.blade.php ENDPATH**/ ?>