<div class="modal-content">
    <div class="modal-title">
        <h4>Add Sub Category</h4>
        <div class="title-line"></div>
    </div>
    <form id="subCategoryCreateForm" method="POST" enctype="multipart/form-data">


        <div class="form-group margin-top-20">
            <select name="category_id" id="categoryType" class="form-control create-form">
                <option value="0" selected>Select Category Type</option>
                <?php $__currentLoopData = $categoryList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id=>$name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($id); ?>"><?php echo e($name); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>  
            </select>
        </div>

        <div class="form-group margin-top-20">
            <input name="name" type="text" class="form-control create-form" id="name" placeholder="Sub Category Name">
        </div>


        

        <div class="actions margin-top-10">
            <button class="submit margin-top-10" type="submit" id="createSubCategory">Save</button>
            <button type="button" class="cancel margin-top-10" data-dismiss="modal">Cancel</button>
        </div>
    </form>

</div>
<?php /**PATH /home/ccninfot/movieflix.ccninfotech.com/resources/views/category/subCategoryCreate.blade.php ENDPATH**/ ?>