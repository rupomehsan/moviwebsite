<?php $__env->startSection('data_count'); ?>
    
    <div class="content-heading">
        <div class="row">
            
            <div class="col-md-8 content-title">
                <span class="title">SMTP Settings</span>
                <div class="title-line"></div>
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

    
    <form id="settingsForm" method="POST" enctype="multipart/form-data"
        action="<?php echo e(URL::to('admin/smtp-settings/update')); ?>">
        <?php echo csrf_field(); ?>

        <div class="row create-body margin-top-10">

            <div class="col-md-2 margin-top-10">
                <label class="form-check-label" for="gmail">SMTP Type :<span class="text-danger">*</span></label>
            </div>
            <div class="col-md-8 margin-top-10">
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="type" id="gmail" value="gmail">
                    <label class="form-check-label" for="gmail">Gmail SMTP</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="type" id="server" value="server">
                    <label class="form-check-label" for="server">Server SMTP</label>
                </div> <br>
                <span class="text-danger"><?php echo e($errors->first('type')); ?></span>
            </div>

            <div class="col-md-10 margin-top-20">
                <div class="form-group">
                    <label for="host">SMTP Host <span class="text-danger">*</span> </label>
                    <input type="text" name="host" class="form-control create-form" id="host"
                        placeholder="Please enter SMTP Host" value="">
                    <span class="text-danger"><?php echo e($errors->first('host')); ?></span>
                </div>
            </div>

            <div class="col-md-10 margin-top-10">
                <div class="form-group">
                    <label for="email">Email / Username<span class="text-danger">*</span></label>
                    <input type="text" name="email" class="form-control create-form" id="email"
                        placeholder="Please enter Email" value="">
                    <span class="text-danger"><?php echo e($errors->first('email')); ?></span>
                </div>
            </div>

            <div class="col-md-10 margin-top-10">
                <div class="form-group">
                    <label for="password">Password <span class="text-danger">*</span></label>
                    <input type="text" name="password" class="form-control create-form" id="password"
                        placeholder="Please enter password" value="">
                    <span class="text-danger"><?php echo e($errors->first('password')); ?></span>
                </div>
            </div>

            <div class="col-md-10 margin-top-10">
                <div class="form-group">
                    <label for="encryption">SMTP Encryption <span class="text-danger">*</span></label>

                    <select name="encryption" id="encryption" class="form-control create-form">
                        <option value="0" selected>Select SMTP Encryption</option>
                        <option value="tls">TLS</option>
                        <option value="ssl">SSL</option>
                    </select>
                    <span class="text-danger"><?php echo e($errors->first('encryption')); ?></span>
                </div>
            </div>

            <div class="col-md-10 margin-top-10">
                <div class="form-group">
                    <label for="port">SMTP Port <span class="text-danger">*</span></label>
                    <input type="text" name="port" class="form-control create-form" id="port"
                        placeholder="Please enter port" value="">
                    <span class="text-danger"><?php echo e($errors->first('port')); ?></span>
                </div>
            </div>

            <div class="col-md-12 actions margin-top-10">
                <button type="submit" class="submit" id="updateSettings">Update</button>
            </div>
            <div class="margin-top-40">
                <div class="row">
                    <div class="col-md-1 col-sm-2 col-3 smtp-notice smtp-notice-icon">
                        <span class="iconify" data-icon="clarity:bell-outline-badged"></span>
                    </div>
                    <div class="col-md-10 col-sm-9 col-8 smtp-notice smtp-notice-note">
                        <div class="note-title">Note:</div>
                        <div class="note-description">
                            <span class="iconify" data-icon="el:hand-right"></span> &nbsp; This Data is required
                            otherwise
                            <span class="bold">Forgot Password</span> or <span class="bold">Email</span>
                            feature would not work.
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </form>
    

<?php $__env->stopSection(); ?>
<?php $__env->startPush('custom-js'); ?>
    <script type="text/javascript">
        // form data
        $(document).ready(function() {
            var showurl = window.origin + '/api/v1/setting/smtp';

            $('.loading-spinner').css("display", "flex");
            $.ajax({
                url: showurl,
                type: "GET",
                dataType: "json",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    'Authorization': localStorage.getItem('token'),
                },
                complete: function() {
                    $('.loading-spinner').css("display", "none");
                },
                success: function(res) {
                    if (res.data != null) {
                        if (res.data.type == 'gmail') {
                            $("#gmail").prop('checked', true);
                        }
                        if (res.data.type == 'server') {
                            $("#server").prop('checked', true);
                        }
                        $("#host").val(res.data.host ? res.data.host : '');
                        $("#email").val(res.data.email ? res.data.email : '');
                        $("#password").val(res.data.password ? res.data.password : '');
                        $('#encryption').html(`
                        <option value="0">Select SMTP Encryption</option>
                        <option value="tls" ${(res.data.encryption == 'tls') ? 'selected' : ''}>TLS</option>
                        <option value="ssl" ${(res.data.encryption == 'ssl') ? 'selected' : ''}>SSL</option>
                    `);
                        $("#port").val(res.data.port ? res.data.port : '');
                    }

                },
                error: function(jqXhr, ajaxOptions, thrownError) {
                    $('.loading-spinner').css("display", "none");
                }
            }); //ajax
        });

        // update Settings
        $(document).on("click", "#updateSettingss", function(e) {
            e.preventDefault();

            var formData = new FormData($('#settingsForm')[0]);

            var showurl = window.origin + '/api/v1/setting/smtp-update';

            var options = {
                closeButton: true,
                debug: false,
                positionClass: "toast-bottom-right",
                onclick: null
            };

            $('.loading-spinner').css("display", "flex");
            $.ajax({
                url: showurl,
                type: 'POST',
                dataType: "json",
                processData: false,
                contentType: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    'Authorization': localStorage.getItem('token'),
                },
                data: formData,
                complete: function() {
                    $('.loading-spinner').css("display", "none");
                },
                success: function(res) {
                    toastr.success('SMTP Setting update successfully', res, options);
                    setTimeout(location.reload.bind(location), 1000);
                },
                error: function(jqXhr, ajaxOptions, thrownError) {
                    if (jqXhr.status == 422) {
                        var errorsHtml = '';
                        var errors = jqXhr.responseJSON.data;
                        $.each(errors, function(key, value) {
                            errorsHtml += `<li>${value}</li>`
                        });
                        toastr.error(errorsHtml, 'Validation Error', options);
                    } else if (jqXhr.status == 401) {
                        toastr.error('Sorry, You can not update this item',
                            'Authentication Error', options);
                    } else if (jqXhr.status == 404) {
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

<?php echo $__env->make('layouts.default.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ccninfot/movieflix.ccninfotech.com/resources/views/settings/smtpSettings.blade.php ENDPATH**/ ?>