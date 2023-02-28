<div class="modal-content">
    <div class="modal-title">
        <h4>Edit Season</h4>
        <div class="title-line"></div>
    </div>
    <form id="seasonEditForm" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo e($target->id); ?>">

        <div class="form-group margin-top-20">
            <select name="series_id" id="seriesType" class="form-control create-form">
                <option value="0">Select Series</option>
                <?php $__currentLoopData = $seriesList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id=>$name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php 
                $selected = '';
                if($id == $target->series_id){
                    $selected = 'selected';
                }
                ?>
                <option value="<?php echo e($id); ?>" <?php echo e($selected); ?>><?php echo e($name); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>  
            </select>
        </div>

        <div class="form-group margin-top-20">
            <input name="name" type="text" class="form-control create-form" id="name" placeholder="Season Name" value="<?php echo e($target->name); ?>">
        </div>

        

        <div class="actions margin-top-10">
            <button class="submit margin-top-10" type="submit" id="editSeason">Update</button>
            <button type="button" class="cancel margin-top-10" data-dismiss="modal">Cancel</button>
        </div>
    </form>

</div>
<?php /**PATH /home/ccninfot/movieflix.ccninfotech.com/resources/views/series/seasonEdit.blade.php ENDPATH**/ ?>