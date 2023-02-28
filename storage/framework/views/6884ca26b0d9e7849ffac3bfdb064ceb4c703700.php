<?php $__env->startSection('data_count'); ?>
    
    <div class="content-heading">
        <div class="row">
            
            <div class="col-md-8 content-title">
                <span class="title">Manage Admin</span>
                
                <div class="title-line"></div>
            </div>
            

            
            <div class="col-md-4 text-right">
                <form action="/admin/admin/filter" method="POST" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <div class="input-group content-search">
                        <button class="input-group-text search" id="addon-wrapping">
                            <span class="iconify" data-icon="bx:bx-search"></span>
                        </button>
                        <input name="fil_search" type="text" class="form-control search" placeholder="Search"
                            aria-label="fil_search">
                    </div>
                </form>
            </div>
            

        </div>

        <div class="margin-top-20 action-buttons">
            <a class="single-action" href="/admin/admin/create">
                <span class="iconify" data-icon="bi:plus-circle-fill"></span> &nbsp; Add Admin
            </a>
        </div>


        <div class="row margin-top-40">
            <div class="col-md-1 content-title">
                <span class="title">
                    <a href="/admin/admin" class="title-btn ">Admin</a>
                </span>
                <div class="title-line"></div>
            </div>
            <div class="col-md-2">
                <span class="sub-title">
                    <a href="/admin/admin/super-admin" class="title-btn">Super Admin</a>
                </span>
                <div class="title-line sub-category-title-line display-none"></div>
            </div>
        </div>
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
    

    <div class="main-content-body" id="mainContentBody">
        <div class="pannel-table-content margin-top-20">
            <div class="table-wrapper">
                <table style="min-width: 100%">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col" class="text-center">SERIAL</th>
                            <th scope="col" class="text-center">IMAGE</th>
                            <th scope="col" class="text-center">NAME</th>
                            <th scope="col" class="text-center">PHONE NO</th>
                            <th scope="col" class="text-center">EMAIL</th>
                            <th scope="col" class="text-center">ACTIONS</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $sl = 1; ?>
                        <?php if(!$target->isEmpty()): ?>
                            <?php $__currentLoopData = $target; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td class="text-center" scope="row"><?php echo e($sl++); ?></td>
                                    <td class="text-center table-image">
                                        <?php if(!empty($data->image)): ?>
                                            <img src="<?php echo e(URL::to('/')); ?>/uploads/user/<?php echo e($data->image); ?>"
                                                alt="<?php echo e($data->name); ?>" title="<?php echo e($data->name); ?>" />
                                        <?php else: ?>
                                            <img src="<?php echo e(URL::to('/')); ?>/uploads/no.jpeg" alt="" />
                                        <?php endif; ?>
                                    </td>
                                    <td class="text-center"><?php echo e($data->name); ?></td>
                                    <td class="text-center"><?php echo e($data->phone); ?></td>
                                    <td class="text-center"><?php echo e($data->email); ?></td>
                                    <td class="table-actions text-center">

                                        <a href="<?php echo e(URL::to('admin/admin/' . $data->id . '/edit')); ?>">EDIT</a>

                                        <button type="button" id="deleteItem" data-id=<?php echo e($data->id); ?> title="Delete">
                                            DELETE
                                        </button>

                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    


<?php $__env->stopSection(); ?>
<?php $__env->startPush('custom-js'); ?>
    <script type="text/javascript">
        //delete
        $(document).on("click", "#deleteItem", function(e) {
            e.preventDefault();
            var id = $(this).attr("data-id");
            var options = {
                closeButton: true,
                debug: false,
                positionClass: "toast-bottom-right",
                onclick: null
            };

            swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $('.loading-spinner').css("display", "flex");
                    $.ajax({
                        url: window.origin + '/admin/admin/destroy',
                        type: "POST",
                        dataType: "json",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: {
                            id: id,
                        },
                        complete: function() {
                            $('.loading-spinner').css("display", "none");
                        },
                        success: function(res) {
                            Swal.fire(
                                'Deleted!',
                                'Your file has been deleted.',
                                'success'
                            )
                            setTimeout(location.reload.bind(location), 1000);
                        },
                        error: function(jqXhr, ajaxOptions, thrownError) {
                            if (jqXhr.status == 422) {
                                var errorsHtml = '';
                                var errors = jqXhr.responseJSON.message;
                                $.each(errors, function(key, value) {
                                    errorsHtml += `<li>${value}</li>`
                                });
                                toastr.error(errorsHtml, jqXhr.responseJSON.heading,
                                    options);
                            } else if (jqXhr.status == 500) {
                                toastr.error(jqXhr.responseJSON.message, '',
                                    options);
                            } else if (jqXhr.status == 401) {
                                toastr.error('Sorry, You can not delete this item',
                                    'Authentication Error', options);
                            } else {
                                toastr.error('Error', 'Something went wrong',
                                    options);
                            }
                            $('.loading-spinner').css("display", "none");
                        }
                    }); //ajax
                }
            });

        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.default.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ccninfot/movieflix.ccninfotech.com/resources/views/admin/adminIndex.blade.php ENDPATH**/ ?>