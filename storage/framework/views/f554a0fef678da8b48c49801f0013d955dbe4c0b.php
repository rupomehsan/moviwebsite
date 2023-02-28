<?php $__env->startSection('data_count'); ?>
    
    <div class="content-heading">
        <div class="row">
            
            <div class="col-md-8 content-title">
                <span class="title">Video</span>
                <div class="title-line"></div>

                <!-- Button trigger modal -->
            </div>
            

            
            <div class="col-md-4 text-right">

                <div class="input-group content-search">
                    <form action="/admin/video/filter" method="POST" enctype="multipart/form-data">
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

        <div class="action-buttons margin-top-10 ">

            <a class="single-action margin-top-20 " href="/admin/video/create">
                <span class="iconify" data-icon="bi:plus-circle-fill"></span> &nbsp; Add Video
            </a>

            <button type="button" class="margin-top-20 single-action" data-toggle="modal" data-target="#apiKey"
                id="setImdbApi">
                <span class="iconify" data-icon="icon-park-solid:energy-socket"></span>&nbsp;TMDB Api Key
            </button>
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
        <div class="pannel-table-content margin-top-40">
            <div class="table-wrapper">
                <table style="min-width: 100%">
                    <thead>
                        <tr>
                            <th class="text-center">Serial</th>
                            <th>Title</th>
                            <th class="text-center">Thumbnail</th>
                            <th class="text-center">Video Server</th>
                            <th class="text-center">Trending Status</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $sl = 1; ?>
                        <?php if(!$target->isEmpty()): ?>
                            <?php $__currentLoopData = $target; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td class="text-center"><?php echo e($sl++); ?></td>
                                    <td><?php echo e($data->title); ?></td>
                                    <td class="text-center">
                                        <?php if(!empty($data->thumbnail)): ?>
                                            <img src="<?php echo e(URL::to('/')); ?>/uploads/video/thumbnail/<?php echo e($data->thumbnail_vertical); ?>"
                                                alt="<?php echo e($data->title); ?>" title="<?php echo e($data->title); ?>" />
                                        <?php else: ?>
                                            <img src="<?php echo e(URL::to('/')); ?>/uploads/no.jpeg" alt="" />
                                        <?php endif; ?>
                                    </td>
                                    <td class="text-center">
                                        <?php
                                        if ($data->video_type == '1') {
                                            echo 'YouTube';
                                        }
                                        if ($data->video_type == '2') {
                                            echo 'Vimeo';
                                        }
                                        if ($data->video_type == '3') {
                                            echo 'Daily Motion';
                                        }
                                        if ($data->video_type == '4') {
                                            echo 'Local Video';
                                        }
                                        if ($data->video_type == '5') {
                                            echo 'Another Server';
                                        }
                                        ?>
                                    </td>
                                    <td class="text-center">
                                        <?php if ($data->is_trending == 'on') {
                                            echo 'Yes';
                                        } else {
                                            echo 'No';
                                        } ?>
                                    </td>
                                    <td class="text-center">
                                        <button type="button" class="table-action-btn edit-action-btn" title="TMDB Update"
                                            id="tmdbUpdate" data-id=<?php echo e($data->id); ?>>
                                            <span class="iconify" data-icon="ic:outline-update"></span>
                                            TMDB Update
                                        </button>

                                        <a href="/admin/video/edit/<?php echo e($data->id); ?>">
                                            <button type="submit" class="table-action-btn edit-action-btn" title="Edit">
                                                <span class="iconify" data-icon="bx:edit-alt"></span>
                                                Edit
                                            </button>
                                        </a>
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
    
    

    <form id="imdbKeyCreateForm" method="POST" enctype="multipart/form-data">
        <div class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" id="apiKey">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-title">
                        <h4>TMDB Api Key</h4>
                        <div class="title-line"></div>
                    </div>
                    <form>
                        <div class="form-group margin-top-20">
                            <input name="key" type="text" class="form-control create-form" id="key"
                                placeholder="Api Key" value="<?php echo e($existImdbKey->key ?? ''); ?>">
                        </div>

                        <div class="actions margin-top-10">
                            <button class="submit margin-top-10" type="submit" id="createKey">Add Key</button>
                            <button type="button" class="cancel margin-top-10" data-dismiss="modal">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </form>


<?php $__env->stopSection(); ?>
<?php $__env->startPush('custom-js'); ?>
    <script type="text/javascript">
        //delete
        $(document).on("click", "#tmdbUpdate", function(e) {
            e.preventDefault();
            var id = $(this).attr("data-id");
            var options = {
                closeButton: true,
                debug: false,
                positionClass: "toast-bottom-right",
                onclick: null
            };
            $('.loading-spinner').css("display", "flex");
            $.ajax({
                url: window.origin + '/admin/video/tmdb-update',
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
                    toastr.success('TMDB Rating update successfully', res, options);
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
            }); //ajax

        });

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
                        url: window.origin + '/admin/video/destroy',
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

        // save
        $(document).on("click", "#createKey", function(e) {
            e.preventDefault();
            var formData = new FormData($('#imdbKeyCreateForm')[0]);

            var options = {
                closeButton: true,
                debug: false,
                positionClass: "toast-bottom-right",
                onclick: null
            };
            $('.loading-spinner').css("display", "flex");
            $.ajax({
                url: window.origin + '/admin/video/store-imdb-key',
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
                    toastr.success('IMDB Api Key Added successfully', res, options);
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

<?php echo $__env->make('layouts.default.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/projectx/Desktop/laravelProjects/movieflix-main/resources/views/video/index.blade.php ENDPATH**/ ?>