<?php $__env->startSection('content'); ?>
    <!-- Selected video section start -->
    <div class="tv-container">
        <div class="container">
            <?php if(!$remainingTvInfo->isEmpty()): ?>
                <section class="video  singel-video-show-full">
                    <div class="responsive-tv-channel-list">
                    </div>
                    <div class="tv-channel-show tv-channel-list">
                        <div class="tv-channel-list-container">
                            <?php $counter = 1; ?>
                            <?php if(!$tvChannelCategory->isEmpty()): ?>
                                <?php
                                $class = '';
                                if ($counter == 1) {
                                    $class = 'active';
                                }
                                ?>
                                <?php $__currentLoopData = $tvChannelCategory; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <button class="tv-cattegory-btn" data-id="tv-cattegory-<?php echo e($category->id); ?>">
                                        <?php echo e($category->name); ?>

                                        <div class="drop-icon">
                                            <span class="iconify" data-icon="akar-icons:chevron-down"></span>
                                        </div>
                                    </button>
                                    <div class="category-channels tv-cattegory-<?php echo e($category->id); ?>">
                                        <?php $__currentLoopData = $remainingTvInfo; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tv): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php if($category->id == $tv->tv_channel_category_id): ?>
                                                <?php
                                                $parental = '';
                                                if ($tv->is_parental == 'on') {
                                                    $parental = 'parental-tv-channel';
                                                }
                                                ?>
                                                <button type="button"
                                                    class="single-channel single-channel-btn <?php echo e($class); ?> <?php echo e($parental); ?>"
                                                    data-id="<?php echo e($tv->id); ?>">

                                                    <div class="channel-logo">
                                                        <?php if(!empty($tv->image)): ?>
                                                            <img src="<?php echo e(URL::to('/')); ?>/uploads/tv/<?php echo e($tv->image); ?>"
                                                                alt="<?php echo e($tv->name); ?>" title="<?php echo e($tv->name); ?>" />
                                                        <?php else: ?>
                                                            <img src="<?php echo e(URL::to('/')); ?>/uploads/no.jpeg"
                                                                alt="" />
                                                        <?php endif; ?>
                                                    </div>

                                                    <div class="channel-name channel-details">
                                                        <?php echo e($tv->name); ?>

                                                    </div>
                                                </button>
                                                <?php $counter++; ?>
                                            <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="tv-channel-show tv-channel-view single-vidio-wrapper tv-wrapper" id="singleVideoWrapper">
                        <div class="video-area">
                            <?php if($tvInfo->is_parental == 'on'): ?>
                            <div class="premium-content-alert text-center">
                                To Watch This Parental Content Please Do <br> <br>

                                <button type="button" class="premium-content-alert-btn" data-id="<?php echo e($tvInfo->id); ?>"
                                    data-toggle="modal" data-target="#parentalPassword">
                                    Login Your Parental Password
                                </button>

                            </div>
                            <?php else: ?>
                                <?php if($tvInfo->stream_type == 'youtube'): ?>
                                    <?php echo $embeded; ?>

                                <?php else: ?>
                                    <video-js id="my_video_1" class="vjs-default-skin" controls preload="auto"
                                        height="100%">
                                        <source src="<?php echo e($embeded); ?>" type="application/x-mpegURL">
                                    </video-js>

                                    <script src="https://unpkg.com/video.js/dist/video.js"></script>
                                    <script src="https://unpkg.com/@videojs/http-streaming/dist/videojs-http-streaming.js"></script>

                                    <script>
                                        var player = videojs('my_video_1');
                                    </script>
                                <?php endif; ?>
                            <?php endif; ?>

                        </div>
                    </div>
                </section>
            <?php endif; ?>
        </div>
    </div>
    <!-- Selected video section end -->


    
    <div class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" id="parentalPassword">
        <div class="modal-dialog">
            <div class="modal-content website-modal">
                <div class="modal-header">
                    <span class="modal-title">Parental Security</span>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="parentalAuthForm" method="POST" enctype="multipart/form-data">
                        <input type="hidden" value="<?php echo e($tvInfo->id); ?>" name="tv_channel_id" id="tv_channel_id">
                        <input type="password" name="password" id="password" class="form-control website-input-form"
                            placeholder="Please enter your parental Password">
                        <button type="submit" id="parentalLogin" class="website-input-submit submit">Login</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    
    <div class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" id="shareModal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content single-vido-modal">
                <div class="modal-header">
                    <span class="modal-title">Share</span>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="link-box">
                        <div class="input-group mb-3">
                            <input type="text" id="videoUrl" class="form-control" readonly value="<?php echo e(url()->full()); ?>">
                            <div class="input-group-append">
                                <button value="copy input-group-text" id="basic-addon2"
                                    onclick="copyToClipboard()">Copy!</button>
                                
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    
    <div class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" id="reportModal">
        <div class="modal-dialog modal-lg">
            <div id="showReportModal">
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('custom-js'); ?>
    <script>
        // Parental Authentication
        $(document).on("click", "#parentalLogin", function(e) {
            e.preventDefault();
            var formData = new FormData($('#parentalAuthForm')[0]);

            var options = {
                closeButton: true,
                debug: false,
                positionClass: "toast-bottom-right",
                onclick: null
            };
            $('.loading-spinner').css("display", "flex");
            $.ajax({
                url: window.origin + '/tv-channel-parental-authentication',
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
                    $('#parentalPassword').hide()
                    $("#singleVideoWrapper").html(res.html);
                },
                error: function(jqXhr, ajaxOptions, thrownError) {
                        toastr.error('Authentication Error', 'Credentials does not matched...', options);
                    $('.loading-spinner').css("display", "none");
                }
            });
        });

        // channel change
        $(document).on("click", ".single-channel-btn", function(e) {
            e.preventDefault();
            var id = $(this).data("id")
            $(".active").removeClass('active');
            $("#tv_channel_id").val(id);

            $(this).addClass('active');
            $('.loading-spinner').css("display", "flex");
            $.ajax({
                url: window.origin + '/tv-channel-show/channel',
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
                    $("#singleVideoWrapper").html(res.html);
                },
                error: function(jqXhr, ajaxOptions, thrownError) {
                    $('.loading-spinner').css("display", "none");
                }
            }); //ajax
        });

        // tv-cattegory-btn
        $(document).on("click", ".tv-cattegory-btn", function(e) {
            e.preventDefault();
            var id = $(this).data("id")

            $("." + id).toggle(500);
        });

        //copy url
        function copyToClipboard() {
            document.getElementById("videoUrl").select();
            document.execCommand('copy');
        }

        // report Modal
        $(document).on("click", "#reportButton", function(e) {
            e.preventDefault();
            var id = $(this).data("id")
            $('.loading-spinner').css("display", "flex");
            $.ajax({
                url: window.origin + 'report/create',
                type: "POST",
                dataType: "json",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    video_id: id,
                },
                complete: function() {
                    $('.loading-spinner').css("display", "none");
                },
                success: function(res) {
                    $("#showReportModal").html(res.html);
                },
                error: function(jqXhr, ajaxOptions, thrownError) {
                    $('.loading-spinner').css("display", "none");
                }
            }); //ajax
        });

        // report save
        $(document).on("click", "#createReport", function(e) {
            e.preventDefault();
            var formData = new FormData($('#reportCreateForm')[0]);

            var options = {
                closeButton: true,
                debug: false,
                positionClass: "toast-bottom-right",
                onclick: null
            };
            $('.loading-spinner').css("display", "flex");
            $.ajax({
                url: window.origin + 'report/store',
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
                    toastr.success('Report Send successfully', res, options);
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

<?php echo $__env->make('frontend.layouts.client.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ccninfot/movieflix.ccninfotech.com/resources/views/frontend/client/tvChannelShow.blade.php ENDPATH**/ ?>