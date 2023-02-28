<?php $__env->startSection('data_count'); ?>
    
    <div class="content-heading">
        <div class="row">
            
            <div class="col-md-8 content-title">
                <span class="title">Video Settings</span>
                <div class="title-line"></div>
            </div>
            
        </div>
    </div>
    

    

    <div class="row content-bottom-heading margin-top-20">
        <div class="col-md-1 content-title">
            <span class="title">
                <a href="/admin/video-settings" class="title-btn ">Home</a>
            </span>
            <div class="title-line display-none"></div>
        </div>
        <div class="col-md-2  content-title">
            <span class="sub-title">
                <a href="/admin/video-settings-category" class="title-btn">Category</a>
            </span>
            <div class="title-line"></div>
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


    <form id="videoSettingsForm" method="POST" enctype="multipart/form-data"
        action="<?php echo e(URL::to('admin/video-settings/update')); ?>">
        <?php echo csrf_field(); ?>

        <div class="offset-md-1 col-md-3 margin-top-10">
            <div class="form-group">
                <select id="categoryId" name="category_id" class="form-control create-form settings-drop-down">
                    <option value=" 0">Select Category</option>
                    <?php $__currentLoopData = $categoryList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option class="" value="<?php echo e($id); ?>">
                            <?php echo e($name); ?>

                        </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
        </div>
        <div id="showSettingsCategory">
        </div>

    </form>
    



<?php $__env->stopSection(); ?>
<?php $__env->startPush('custom-js'); ?>
    <script type="text/javascript">
        $(document).on("change", "#categoryId", function(e) {
            e.preventDefault();
            var category = $("#categoryId").val();
            // alert(category);

            $('.loading-spinner').css("display", "flex");
            $.ajax({
                url: window.origin + '/admin/video-settings-category/get-settings-category',
                type: "POST",
                dataType: "json",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    category_id: category,
                },
                complete: function() {
                    $('.loading-spinner').css("display", "none");
                },
                success: function(res) {
                    $("#showSettingsCategory").html(res.html);
                },
                error: function(jqXhr, ajaxOptions, thrownError) {
                    $('.loading-spinner').css("display", "none");
                }
            });
        });

        $(document).on("change", "#subCategoryVS", function(e) {
            e.preventDefault();
            var subCategory = $("#subCategoryVS").val();
            var id = 'op' + subCategory;

            $("#" + id).addClass("display-none");

            $('.loading-spinner').css("display", "flex");
            $.ajax({
                url: window.origin + '/admin/video-settings-category/get-sub-category-content',
                type: "POST",
                dataType: "json",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    sub_category_id: subCategory,
                },
                complete: function() {
                    $('.loading-spinner').css("display", "none");
                },
                success: function(res) {
                    $("#showSubCategoryContent").append(res.html);
                },
                error: function(jqXhr, ajaxOptions, thrownError) {
                    $('.loading-spinner').css("display", "none");
                }
            });
        });

        $(document).on("click", ".remove-category-settings", function(e) {
            e.preventDefault();
            var dataId = $(this).attr("data-id");
            var id = 'op' + dataId;
            $("#" + id).removeClass("display-none");
            $("#subCategory" + dataId).remove();

        });

        $(document).on("change", ".vertical-image", function(e) {
            e.preventDefault();
            var dataClass = $(this).attr("data-class");

            var target = 'horizontal-image-' + dataClass;
            if (this.checked == true) {
                $('.' + target).prop('checked', false);
            }
            if (this.checked == false) {
                $('.' + target).prop('checked', true);
            }

        });

        $(document).on("change", ".horizontal-image", function(e) {
            e.preventDefault();
            var dataClass = $(this).attr("data-class");

            var target = 'vertical-image-' + dataClass;
            if (this.checked == true) {
                $('.' + target).prop('checked', false);
            }
            if (this.checked == false) {
                $('.' + target).prop('checked', true);
            }

        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.default.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ccninfot/movieflix.ccninfotech.com/resources/views/settings/videoSettingsCategory.blade.php ENDPATH**/ ?>