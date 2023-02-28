<?php $__env->startSection('data_count'); ?>
    
    <div class="content-heading">
        <div class="row">
            
            <div class="col-md-8 content-title">
                <span class="title">Manage Movie Request</span>
                <div class="title-line"></div>
            </div>
            

        </div>
    </div>
    

    
    <div class="row margin-top-40 content-details">
        <div style="overflow-x:auto;">
            <table class="table">
                <thead class="thead-light">
                    <tr>
                        <th scope="col" class="text-center">SERIAL</th>
                        <th scope="col" class="text-center">NAME</th>
                        <th scope="col" class="text-center">EMAIL</th>
                        <th scope="col" class="text-center">REQUEST MOVIE</th>
                        <th scope="col" class="text-center">REQUEST DATE</th>
                        <th scope="col" class="text-center">MESSAGE</th>
                        <th scope="col" class="text-center">ACTIONS</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $sl = 1; ?>
                    <?php if(!$target->isEmpty()): ?>
                        <?php $__currentLoopData = $target; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <th class="text-center" scope="row"><?php echo e($sl++); ?></th>
                                <td class="text-center"><?php echo e($data->name); ?></td>
                                <td class="text-center"><?php echo e($data->email); ?></td>
                                <td class="text-center"><?php echo e($data->movie_name); ?></td>
                                <td class="text-center"><?php echo e($data->added_on); ?></td>
                                <td class="text-center"><?php echo e($data->message); ?></td>
                                <td class="table-actions text-center">

                                    <a href="<?php echo e(URL::to('admin/video/create')); ?>">ADD MOVIE</a>

                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>
                </tbody>
            </table>

        </div>
    </div>
    


<?php $__env->stopSection(); ?>
<?php $__env->startPush('custom-js'); ?>
    <script type="text/javascript"></script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.default.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ccninfot/movieflix.ccninfotech.com/resources/views/video/requestMovie.blade.php ENDPATH**/ ?>