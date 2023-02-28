<?php $__env->startSection('content'); ?>
    <!-- Selected video section start -->
    <section class="video  singel-video-show-full">
        <div class="single-vidio-wrapper">
            <div class="video-area">
                <?php if($tvInfo->stream_type == '.m3u8'): ?>
                <video id="my_video_1" class="video-js vjs-fluid vjs-default-skin" controls preload="auto" data-setup='{}'>
                    <source src="<?php echo $embeded; ?>"
                        type="application/x-mpegURL">
                </video>
                <?php else: ?>
                <?php echo $embeded; ?>

                <?php endif; ?>

            </div>
        </div>

        <div class="single-vidio-description ptb-30">
            <div class="row single-vidio-rs">
                <div class="col-md-6 left-part-rs col-sm-12">
                    <div class="left-part">

                    </div>
                </div>
                <div class="col-md-6 right-part">
                    <ul>
                        <li>
                            <button type="button" class="share-button" data-toggle="modal" data-target="#shareModal">
                                <i class="fas fa-share-alt"></i>
                            </button>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!-- Selected video section end -->

    
    <div class="container my-4 also-like">
        <div class="row">
            <div class="col-lg-12">
                <div class="content-section-title">
                    <div class="title">
                        TV Channel
                    </div>
                    <div class="triangle"></div>
                    <div class="line"></div>
                </div>
            </div>
        </div>
        <!--Slides-->
        <?php
        $count = '1';
        ?>
        <div class="owl-carousel also-like-carousel owl-theme">
            <?php if(!$remainingTvInfo->isEmpty()): ?>
                <?php $__currentLoopData = $remainingTvInfo; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="card item margin-top-40">

                        <?php if(!empty($data->image)): ?>
                            <img src="<?php echo e(URL::to('/')); ?>/uploads/tv/<?php echo e($data->image); ?>" alt="<?php echo e($data->name); ?>"
                                title="<?php echo e($data->name); ?>" />
                        <?php else: ?>
                            <img src="<?php echo e(URL::to('/')); ?>/uploads/no.jpeg" alt="" />
                        <?php endif; ?>

                        <div class="card-body">
                            <h4 class="card-title"><?php echo e($data->name); ?></h4>
                            <a class="btn btn-primary mt-20" href="/live-tv/<?php echo e($data->id); ?>">
                                <i class="fa fa-play" aria-hidden="true"></i>
                                Play Live
                            </a>
                        </div>
                    </div>
                    <?php
                    $count++;
                    ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>
        </div>
        <!--/.Slides-->
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
        var player = videojs('my_video_1');
        player.play();
        $('.also-like-carousel').owlCarousel({
            items: 4,
            loop: true,
            autoplay: true,
            responsiveClass: true,
            margin: 20,
            nav: true,
            // dots: false,
            navText: ["<div class='nav-btn prev-slide'></div>", "<div class='nav-btn next-slide'></div>"],
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 2
                },
                1000: {
                    items: 4
                }
            }
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
                    $('.loading-spinner').css("display", "none");}
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

<?php echo $__env->make('frontend.layouts.client.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ccninfot/movieflix.ccninfotech.com/resources/views/frontend/client/livetv.blade.php ENDPATH**/ ?>