<?php $__env->startSection('content'); ?>
    <!-- video section start -->
    <section class="video ptb-90">
        <form id="updateForm" method="POST" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-5"></div>
                <div class="col-md-7 margin-top-20">
                    <div class="profile-image">
                        <?php if(!empty($profile->image)): ?>
                            <img src="<?php echo e(URL::to('/')); ?>/uploads/user/<?php echo e($profile->image); ?>" alt="Custom" title="Custom"
                                id="CHImg" width="200" />
                        <?php else: ?>
                            <img id="CHImg" width="200" />
                        <?php endif; ?>
                    </div>
                    <div>
                        <input type="file" accept="image/*" name="image" id="fileCH" onchange="loadFileCH(event)"
                            style="display: none;">
                    </div>
                    <div class="btn btn-outline-danger btn-sm web-ad-img-btn margin-top-20 image-edit">
                        <label for="fileCH" class="image-edit-btn" style="cursor: pointer;">Upload Image</label>
                    </div>
                </div>

                <div class="col-md-1"></div>
                <div class="col-md-4">
                    <div class="form-group margin-top-40">
                        <input name="name" type="text" class="form-control create-form profile-edit-form" id="name"
                            placeholder="Name" value="<?php echo e($profile->name ?? ''); ?>">
                    </div>

                    <div class="form-group margin-top-40">
                        <input name="phone" type="text" class="form-control create-form profile-edit-form" id="phone"
                            placeholder="Phone" value="<?php echo e($profile->phone ?? ''); ?>">
                    </div>

                    <div class="form-group margin-top-40">
                        <input name="email" type="email" class="form-control create-form profile-edit-form" id="email"
                            placeholder="Email" value="<?php echo e($profile->email ?? ''); ?>">
                    </div>
                </div>
                <div class="col-md-2"></div>
                <div class="col-md-4">

                    <div class="form-group margin-top-40">
                        <input name="old_password" type="password" class="form-control create-form profile-edit-form"
                            id="oldPass" placeholder="Old Password" onfocus="this.removeAttribute('readonly');" readonly>
                    </div>

                    <div class="form-group margin-top-40">
                        <input name="password" type="password" class="form-control create-form profile-edit-form" id="new"
                            placeholder="New Password" onfocus="this.removeAttribute('readonly');" readonly>
                    </div>

                    <div class="form-group margin-top-40">
                        <input name="password_confirmation" type="password"
                            class="form-control create-form profile-edit-form" id="confirmation"
                            placeholder="Password Confirmation" onfocus="this.removeAttribute('readonly');" readonly>
                    </div>

                </div>

                <div class="actions col-md-12 text-center margin-top-40">
                    <button class="submit btn btn-outline-danger btn-sm" type="submit" id="update">
                        Update
                    </button>

                    <a href="/profile" class="profile-cancel-btn">Cancel</a>
                </div>
            </div>
        </form>
    </section>
    <!-- video section end -->
<?php $__env->stopSection(); ?>
<?php $__env->startPush('custom-js'); ?>
    <script>
        var loadFileCH = function(event) {
            var image = document.getElementById('CHImg');
            image.src = URL.createObjectURL(event.target.files[0]);
        };

        // edit
        $(document).on("click", "#update", function(e) {
            e.preventDefault();
            var formData = new FormData($('#updateForm')[0]);

            var options = {
                closeButton: true,
                debug: false,
                positionClass: "toast-bottom-right",
                onclick: null
            };
            $('.loading-spinner').css("display", "flex");
            $.ajax({
                url: window.origin + 'profile-update',
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
                    toastr.success('Profile updated successfully', res, options);
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
                    App.unblockUI();
                }
            });
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('frontend.layouts.client.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ccninfot/movieflix.ccninfotech.com/resources/views/frontend/client/editProfile.blade.php ENDPATH**/ ?>