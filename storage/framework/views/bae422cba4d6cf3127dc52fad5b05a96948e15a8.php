<?php $__env->startSection('data_count'); ?>
    
    <div class="content-heading">
        <div class="row">
            
            <div class="col-md-8 content-title">
                <span class="title">Notification</span>
                <div class="title-line"></div>
            </div>
            

            
            <div class="col-md-4 text-right">

                
            </div>
            

        </div>

        <div class="margin-top-20 action-buttons">
            <button type="button" class="single-action" data-toggle="modal" data-target="#crateModal" id="notificationCreate">
                <span class="iconify" data-icon="bi:plus-circle-fill"></span>&nbsp;Add Notification
            </button>


            <a class="single-action" href="/admin/notification/manage-notification">
                <span class="iconify" data-icon="bi:plus-circle-fill"></span> &nbsp; Manage Notification
            </a>
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
    <div class="row margin-top-40 content-details">
        <div style="overflow-x:auto;">
            <table class="table">
                <thead class="thead-light">
                    <tr>
                        <th scope="col" class="text-center">SERIAL</th>
                        <th scope="col" class="text-center">VIDEO TITLE</th>
                        <th scope="col" class="text-center">NOTIFICATION DATE</th>
                        <th scope="col" class="text-center">DESCRIPTION</th>
                        
                        <th scope="col" class="text-center">ACTIONS</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $sl = 1; ?>
                    <?php if(!$target->isEmpty()): ?>
                        <?php $__currentLoopData = $target; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <th class="text-center"><?php echo e($sl++); ?></th>
                                <td class="text-center"><?php echo $data->video_title ?? ''; ?></td>
                                <td class="text-center"><?php echo e($data->created_at->isoFormat('Do MMMM YYYY')); ?></td>
                                <td class="text-center"><?php echo e($data->description ?? ''); ?></td>
                                
                                <td class="table-actions text-center">
                                    <button type="button" id="deleteItem" data-id=<?php echo e($data->notification_id); ?>

                                        title="Delete">
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
    

    
    <div class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" id="crateModal">
        <div class="modal-dialog modal-lg">
            <div id="showCreateModal">

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
                        url: window.origin + '/admin/notification/destroy',
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
                            } else if (jqXhr.status == 401) {
                                toastr.error('Sorry, You can not delete this item',
                                    'Authentication Error', options);
                            } else if (jqXhr.status == 500) {
                                toastr.error(jqXhr.responseJSON.message, '',
                                    options);
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
        // create notification modal
        $(document).on("click", "#notificationCreate", function(e) {
            e.preventDefault();
            $('.loading-spinner').css("display", "flex");
            $.ajax({
                url: window.origin + '/admin/notification/create',
                type: "POST",
                dataType: "json",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                complete: function() {
                    $('.loading-spinner').css("display", "none");
                },
                success: function(res) {
                    $("#showCreateModal").html(res.html);
                },
                error: function(jqXhr, ajaxOptions, thrownError) {
                    $('.loading-spinner').css("display", "none");
                }
            }); //ajax
        });

        $(document).on("keyup", "#externalurl", function() {
            var length = $(this).val().length;
            if (length > 0) {
                $("#tvId").prop("disabled", true);
                $("#videoId").prop("disabled", true);
            } else {
                $("#tvId").prop("disabled", false);
                $("#videoId").prop("disabled", false);
            }
        });

        $(document).on("change", "#videoId", function() {
            var value = $(this).val();
            if (value != 0) {
                $("#tvId").prop("disabled", true);
                $("#externalurl").prop("disabled", true);
            } else {
                $("#tvId").prop("disabled", false);
                $("#externalurl").prop("disabled", false);
            }
        });
        $(document).on("change", "#tvId", function() {
            var value = $(this).val();
            if (value != 0) {
                $("#videoId").prop("disabled", true);
                $("#externalurl").prop("disabled", true);
            } else {
                $("#videoId").prop("disabled", false);
                $("#externalurl").prop("disabled", false);
            }
        });


        // save
        $(document).on("click", "#createNotification", function(e) {
            e.preventDefault();
            var formData = new FormData($('#notificationCreateForm')[0]);

            var options = {
                closeButton: true,
                debug: false,
                positionClass: "toast-bottom-right",
                onclick: null
            };
            $('.loading-spinner').css("display", "flex");
            $.ajax({
                url: window.origin + '/api/v1/send-notification',
                type: 'POST',
                dataType: "json",
                processData: false,
                contentType: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: formData,
                complete: function() {
                    $('.loading-spinner').css("display", "none");
                },
                success: function(res) {
                    toastr.success('Notification Create successfully', res, options);
                    setTimeout(location.reload.bind(location), 1000);
                },
                error: function(jqXhr, ajaxOptions, thrownError) {
                    if (jqXhr.status == 422) {
                        var errorsHtml = '';
                        var errors = jqXhr.responseJSON.message;
                        $.each(errors, function(key, value) {
                            errorsHtml += `<li>${value}</li>`
                        });
                        toastr.error(errorsHtml, jqXhr.responseJSON.heading, options);
                    } else if (jqXhr.status == 500) {
                        toastr.error(jqXhr.responseJSON.message, '', options);
                    } else {
                        toastr.error('Error', 'Something went wrong', options);
                    }
                    $('.loading-spinner').css("display", "none");
                }
            });
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.default.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ccninfot/movieflix.ccninfotech.com/resources/views/notification/index.blade.php ENDPATH**/ ?>