<?php $__env->startSection('data_count'); ?>
    
    <div class="content-heading">
        <div class="row">
            
            <div class="col-md-8 content-title">

                <div class="row">
                    <div class="col-md-2">
                        <span class="title">
                            <a href="/admin/series/series-category-view" class="title-btn" id="category">Series Category</a>
                        </span>
                        <div class="title-line category-title-line display-none" id="categoryLine"></div>
                    </div>
                    <div class="col-md-2">
                        <span class="title">
                            <a href="/admin/series" class="title-btn" id="category">Series Name</a>
                        </span>
                        <div class="title-line category-title-line display-none" id="categoryLine"></div>
                    </div>
                    <div class="col-md-2">
                        <span class="sub-title">
                            <a href="/admin/series/season" class="title-btn" id="subCategory">Series Season</a>
                        </span>
                        <div class="title-line sub-category-title-line display-none"></div>
                    </div>
                    <div class="col-md-2">
                        <span class="sub-title">
                            <a href="/admin/series/episod" class="title-btn red" id="seriesCategory">Series Episode</a>
                        </span>
                        <div class="title-line series-category-title-line"></div>
                    </div>
                </div>



                <div class="row create-menus margin-top-20">

                    <div class="col-md-3">
                        <button type="button" class="" data-toggle="modal" data-target="#createModal"
                            id="episodCreate">
                            <span class="iconify" data-icon="bi:plus-circle-fill"></span> &nbsp; Add Episode
                        </button>
                    </div>

                </div>
            </div>
            

            
            <div class="col-md-4 text-right">
                <form action="/admin/series/episod/filter" method="POST" enctype="multipart/form-data">
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
    }
    $ses_msg = Session::has('error');
    if (!empty($ses_msg)) {
        ?>
    <div class="alert alert-danger alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
        <p><i class="fa fa-bell-o fa-fw"></i> <?php echo Session::get('error'); ?></p>
    </div>
    <?php
    } ?>
    <div class="main-content-body" id="mainContentBody">
        <div class="pannel-table-content margin-top-40">
            <div class="table-wrapper">
                <table style="min-width: 100%">
                    <thead>
                        <tr>
                            <th class="text-center">Serial</th>
                            <th>Name</th>
                            <th>Series Category Name</th>
                            <th>Series Name</th>
                            <th>Season Name</th>
                            <th class="text-center">Total Videos</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $sl = 1; ?>
                        <?php if(!$target->isEmpty()): ?>
                            <?php $__currentLoopData = $target; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td class="text-center"><?php echo e($sl++); ?></td>
                                    <td><?php echo e($data->name); ?></td>
                                    <td><?php echo e($data->series_category_name); ?></td>
                                    <td><?php echo e($data->series_name); ?></td>
                                    <td><?php echo e($data->season_name); ?></td>
                                    <td class="text-center"><?php echo e($numberVideo[$data->id] ?? '0'); ?></td>
                                    <td class="text-center">
                                        <button type="button" class="table-action-btn edit-action-btn"  data-toggle="modal"
                                        data-target="#createModal" id="episodEditBtn" data-id="<?php echo e($data->id); ?>"
                                            title="Edit">
                                            <span class="iconify" data-icon="bx:edit-alt"></span>
                                            Edit
                                        </button>
                                        <button type="button" class="table-action-btn delete-action-btn" title="Delete"
                                            id="deleteItem" data-id=<?php echo e($data->id); ?>>
                                            <span class="iconify" data-icon="ant-design:delete-outlined"></span>
                                            Delete
                                        </button>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                </table>
            </div>
        </div>
    </div>
    

    
    <div class="modal fade tabindex=" -1 " role=" dialog" aria-hidden="true" id="createModal">
        <div class="modal-dialog modal-lg">
            <div id="showCreateModal"></div>
        </div>
    </div>
    


<?php $__env->stopSection(); ?>
<?php $__env->startPush('custom-js'); ?>
    <script type="text/javascript">
        $(function() {


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
                            url: window.origin + '/admin/series/destroy/Episod',
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
            //Episode edit Modal
            $(document).on("click", "#episodEditBtn", function(e) {
                e.preventDefault();
                var id = $(this).attr("data-id");
                $('.loading-spinner').css("display", "flex");
                $.ajax({
                    url: window.origin + '/admin/series/episod-edit',
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
                        $("#showCreateModal").html(res.html);
                    },
                    error: function(jqXhr, ajaxOptions, thrownError) {
                        $('.loading-spinner').css("display", "none");
                    }
                }); //ajax
            });

            //get season edit Modal
            $(document).on("change", "#seriesType", function(e) {
                e.preventDefault();
                var id = $(this).val();
                $("#seasonSelect").html('');
                // alert(id);
                $('.loading-spinner').css("display", "flex");
                $.ajax({
                    url: window.origin + '/admin/series/get-season',
                    type: "POST",
                    dataType: "json",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        series_id: id,
                    },
                    complete: function() {
                        $('.loading-spinner').css("display", "none");
                    },
                    success: function(res) {
                        $("#seasonSelect").html(res.html);
                    },
                    error: function(jqXhr, ajaxOptions, thrownError) {
                        $('.loading-spinner').css("display", "none");
                    }
                }); //ajax
            });

            //Episode update
            $(document).on("click", "#editEpisod", function(e) {
                e.preventDefault();
                var formData = new FormData($('#episodEditForm')[0]);

                var options = {
                    closeButton: true,
                    debug: false,
                    positionClass: "toast-bottom-right",
                    onclick: null
                };
                $('.loading-spinner').css("display", "flex");
                $.ajax({
                    url: window.origin + '/admin/series/episod-update',
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
                        toastr.success('Episode updated successfully', res, options);
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
                        } else if (jqXhr.status == 401) {
                            toastr.error('Sorry, You can not update this item',
                                'Authentication Error', options);
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

            //Episode create Modal
            $(document).on("click", "#episodCreate", function(e) {
                e.preventDefault();
                $('.loading-spinner').css("display", "flex");
                $.ajax({
                    url: window.origin + '/admin/series/episod-create',
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

            //Episode save
            $(document).on("click", "#createEpisod", function(e) {
                e.preventDefault();
                var formData = new FormData($('#episodCreateForm')[0]);

                var options = {
                    closeButton: true,
                    debug: false,
                    positionClass: "toast-bottom-right",
                    onclick: null
                };
                $('.loading-spinner').css("display", "flex");
                $.ajax({
                    url: window.origin + '/admin/series/episod-store',
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
                        toastr.success('Episode Create successfully', res, options);
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
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.default.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ccninfot/movieflix.ccninfotech.com/resources/views/series/episodIndex.blade.php ENDPATH**/ ?>