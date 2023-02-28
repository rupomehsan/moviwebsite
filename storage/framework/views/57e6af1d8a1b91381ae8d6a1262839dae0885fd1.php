<?php $__env->startSection('data_count'); ?>
    
    <div class="content-heading">
        <div class="row">
            
            <div class="col-md-8 content-title">
                <span class="title">Notification</span>
                <div class="title-line"></div>
            </div>
            
            
            <div class="col-md-4 text-right">
                

                <a href="/admin/notification" class="btn btn-outline-dark btn-sm"><span class="iconify"
                        data-icon="akar-icons:arrow-back-thick"></span>&nbsp; Back Notification</a>

            </div>
            

        </div>
    </div>
    

    
    <div class="row margin-top-20 create-body content-details">

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

        <form method="POST" enctype="multipart/form-data"
            action="<?php echo e(URL::to('admin/notification/manage-notification-update')); ?>">
            <?php echo csrf_field(); ?>
            <div class="row">
                
                <div class="col-md-6 for-mobile margin-top-20" id="showMobileNotification">
                </div>
                

                
                <div class="offset-md-1 col-md-5 for-web margin-top-20" id="showWebNotification">
                </div>
                

                <div class="col-md-12 text-center actions margin-top-40">
                    <button type="submit" class="submit">Update</button>
                </div>
            </div>

        </form>

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
                        <span class="bold">Notification</span>
                        feature would not work.
                    </div>
                </div>
            </div>

        </div>
    </div>
    


<?php $__env->stopSection(); ?>
<?php $__env->startPush('custom-js'); ?>
    <script type="text/javascript">
        $(document).ready(function() {

            $('.loading-spinner').css("display", "flex");
            $.ajax({
                url: window.origin + '/admin/notification/manage-notification/get-mobile-data',
                type: "POST",
                dataType: "json",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    notification_type: 'mobile'
                },
                complete: function() {
                    $('.loading-spinner').css("display", "none");
                },
                success: function(res) {
                    $("#showMobileNotification").html(res.html);
                },
                error: function(jqXhr, ajaxOptions, thrownError) {
                    $('.loading-spinner').css("display", "none");
                }
            }); //ajax

            $('.loading-spinner').css("display", "flex");
            $.ajax({
                url: window.origin + '/admin/notification/manage-notification/get-web-data',
                type: "POST",
                dataType: "json",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    notification_type: 'web'
                },
                complete: function() {
                    $('.loading-spinner').css("display", "none");
                },
                success: function(res) {
                    $("#showWebNotification").html(res.html);
                },
                error: function(jqXhr, ajaxOptions, thrownError) {
                    $('.loading-spinner').css("display", "none");
                }
            }); //ajax
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.default.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ccninfot/movieflix.ccninfotech.com/resources/views/notification/manageNotification.blade.php ENDPATH**/ ?>