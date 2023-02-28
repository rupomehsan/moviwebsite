<?php $__env->startSection('data_count'); ?>
    
    <div class="content-heading">
        <div class="row">
            
            <div class="col-md-8 content-title">
                <span class="title">Admin Profile</span>
                <div class="title-line"></div>
            </div>
            

        </div>
    </div>
    

    
    <div class="row margin-top-40 content-details">
        <div class="profile-area col-md-11">
            <div class="row">
                <div class="col-md-7 col-sm-7 profile-details">
                    <h5 class="bold"><?php echo e($target->name ?? ''); ?></h5>
                    <span class="bold">Email Address :</span> <?php echo e($target->email ?? ''); ?> <br>
                    <span class="bold">Phone No : </span> <?php echo e($target->phone ?? ''); ?> <br> <br>
                    <h5 class="bold">Access Panel</h5>
                    <?php
                    $accessControllArr = $target->access ? json_decode($target->access) : [];
                    
                    ?>
                    <?php if($accessControllArr): ?>
                        <?php $__currentLoopData = $accessControllArr; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $access): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <span class="bold">. </span> <?php echo e($access); ?> &nbsp;&nbsp;
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>

                    <div class="profile-action margin-top-20">
                        <a class="profile-action-btn margin-top-20" href="<?php echo e(URL::to('admin/admin/' . $target->id . '/edit')); ?>">Edit
                            Profile</a>


                        <button type="button" class="profile-action-btn margin-top-20" data-toggle="modal" data-target="#passModal"
                            id="passBtn">
                            Change Password
                        </button>
                    </div>

                </div>
                <div class="col-md-5 col-sm-5 profile-details-picture text-right">
                    <img src="<?php echo e(URL::to('/')); ?>/uploads/user/<?php echo e($target->image ?? 'nouser.png'); ?>" alt="your image" />
                </div>
            </div>

        </div>
    </div>
    


    
    <div class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" id="passModal">
        <div class="modal-dialog modal-lg">
            <div id="showCreateModal">

            </div>
        </div>
    </div>


<?php $__env->stopSection(); ?>
<?php $__env->startPush('custom-js'); ?>
    <script type="text/javascript">
        // pass change Modal
        $(document).on("click", "#passBtn", function(e) {
            e.preventDefault();
            $('.loading-spinner').css("display", "flex");
            $.ajax({
                url: window.origin + '/admin/basic-settings/change-password',
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

        // update Password
        $(document).on("click", "#changePass", function(e) {
            e.preventDefault();
            var formData = new FormData($('#changePassForm')[0]);

            var options = {
                closeButton: true,
                debug: false,
                positionClass: "toast-bottom-right",
                onclick: null
            };
            $('.loading-spinner').css("display", "flex");
            $.ajax({
                url: window.origin + '/admin/basic-settings/update-password',
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
                    toastr.success('Password Changed successfully', res, options);
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
                    } else if (jqXhr.status == 404) {
                        toastr.error(jqXhr.responseJSON.message, '', options);
                    } else {
                        toastr.error('Error', 'Something went wrong', options);
                    }
                    $('.loading-spinner').css("display", "none");
                    App.unblockUI();
                }
            });
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.default.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ccninfot/movieflix.ccninfotech.com/resources/views/admin/adminProfile.blade.php ENDPATH**/ ?>