<div class="modal-content">
    <div class="modal-title">
        <div class="text-right">
            <button type="button" class="cancel modal-close" data-dismiss="modal" title="Close Modal">
                <span class="iconify" data-icon="entypo:circle-with-cross"></span>
            </button>
        </div>
        <span> Manage Category Type</span> &nbsp; &nbsp;
        <button type="button" class="single-action" data-toggle="modal" data-target="#typeCreateModal"
            id="typeCreateBtn">
            <span class="iconify" data-icon="bi:plus-circle-fill"></span> &nbsp; Add Artist Type
        </button>
    </div>
    <?php
    $ses_msg = Session::has('success');
    if (!empty($ses_msg)) {
        ?>
        <div class="alert alert-success alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
            <p><i class="fa fa-bell-o fa-fw"></i> <?php echo Session::get('success'); ?></p>
        </div>
        <?php
    }// 
    $ses_msg = Session::has('error');
    if (!empty($ses_msg)) {
        ?>
        <div class="alert alert-danger alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
            <p><i class="fa fa-bell-o fa-fw"></i> <?php echo Session::get('error'); ?></p>
        </div>
        <?php
    }// ?>

    <div class="row margin-top-40 content-details">
        <table class="table">
            <thead class="thead-light">
                <tr>
                    <th scope="col" class="text-center">SERIAL</th>
                    <th scope="col" class="text-center">NAME</th>
                    <th scope="col" class="text-center">ACTIONS</th>
                </tr>
            </thead>
            <tbody>
                <?php $sl = 1; ?>
                <?php if(!$celebrityType->isEmpty()): ?>
                    <?php $__currentLoopData = $celebrityType; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <th class="text-center" scope="row"><?php echo e($sl++); ?></th>
                            <td class="text-center"><?php echo e($data->name); ?></td>
                            <td class="table-actions text-center">
                                <form action="<?php echo e(URL::to('admin/celebrity/celebrity-type/' . $data->id)); ?>" method="POST">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>

                                    <button title="Edit" type="button" data-toggle="modal" data-target="#typeCreateModal"
                                        id="typeEditBtn" data-id="<?php echo e($data->id); ?>">
                                        EDIT
                                    </button>

                                    <button type="submit" class="" title="Delete">
                                        DELETE
                                    </button>
                                </form>
                            </td>
                        </tr>

                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
            </tbody>
        </table>

    </div>

    
    <div class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" id="typeCreateModal">
        <div class="modal-dialog modal-lg">
            <div id="showTypeCreateModal">

            </div>
        </div>
    </div>

</div>
<?php /**PATH /home/ccninfot/movieflix.ccninfotech.com/resources/views/celebrity/manageCelebrityType.blade.php ENDPATH**/ ?>