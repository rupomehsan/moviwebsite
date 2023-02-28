<select id="subCategoryType" class="form-control create-form" name="sub_category_id">
    <option value="0" selected>Select Sub Category</option>
    <?php if(!empty($subCategoryList)): ?>
        <?php $__currentLoopData = $subCategoryList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo e($id); ?>"><?php echo e($name); ?></option>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php endif; ?>
</select>
<?php /**PATH /home/ccninfot/movieflix.ccninfotech.com/resources/views/video/getSubCategory.blade.php ENDPATH**/ ?>