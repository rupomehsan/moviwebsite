<div class="modal-content">
    <div class="modal-title">
        <h4>Add Episode</h4>
        <div class="title-line"></div>
    </div>
    <form id="episodCreateForm" method="POST" enctype="multipart/form-data">

        <div class="form-group margin-top-20">
            <select name="series_id" id="seriesType" class="form-control create-form">
                <option value="0" selected>Select Series</option>
                <?php $__currentLoopData = $seriesList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id=>$name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($id); ?>"><?php echo e($name); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>  
            </select>
        </div>

        <div class="form-group margin-top-20" id="seasonSelect">
            <select name="season_id" id="seasonType" class="form-control create-form">
                <option value="0" selected>Select Season</option> 
            </select>
        </div>

        <div class="form-group margin-top-20">
            <input name="name" type="text" class="form-control create-form" id="name" placeholder="Episode Name">
        </div>

        <div class="form-group margin-top-20">
            <input name="number" type="text" class="form-control create-form" id="number" placeholder="Episode Number (Ex: e1)">
        </div>

        

        <div class="actions margin-top-10">
            <button class="submit margin-top-10" type="submit" id="createEpisod">Save</button>
            <button type="button" class="cancel margin-top-10" data-dismiss="modal">Cancel</button>
        </div>
    </form>

</div>
<?php /**PATH /home/ccninfot/movieflix.ccninfotech.com/resources/views/series/episodCreate.blade.php ENDPATH**/ ?>