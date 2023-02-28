<select name="season_id" id="seasonType" class="form-control create-form">
    <option value="0" selected>Select Season</option>
    <?php $__currentLoopData = $seasonList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <option value="<?php echo e($id); ?>"><?php echo e($name); ?></option>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</select>
<?php /**PATH /home/ccninfot/movieflix.ccninfotech.com/resources/views/series/getSeason.blade.php ENDPATH**/ ?>