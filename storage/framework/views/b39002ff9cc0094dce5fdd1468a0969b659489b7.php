<div class="modal-content">
    <div class="modal-title">
        <h4>Edit Category</h4>
        <div class="title-line"></div>
    </div>
    <form id="categoryEditForm" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo e($target->id); ?>">
        <div class="form-group margin-top-20">
            <input name="name" type="text" class="form-control create-form" id="name" placeholder="Category Name" value="<?php echo e($target->name); ?>">
        </div>

        

        <div class="actions margin-top-10">
            <button class="submit margin-top-10" type="submit" id="editCategory">Update</button>
            <button type="button" class="cancel margin-top-10" data-dismiss="modal">Cancel</button>
        </div>
    </form>

</div>
<?php /**PATH /home/ccninfot/movieflix.ccninfotech.com/resources/views/category/categoryEdit.blade.php ENDPATH**/ ?>