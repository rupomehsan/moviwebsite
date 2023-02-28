<?php $__env->startSection('content'); ?>
    <!-- video section start -->
    <section class="video margin-top-110 vidio-wrapper">
        <div class="container">
            <div class="vidio-banner">
                <?php if(!empty($request->type)): ?>
                    <h3 class="margin-top-20 all-video-title"><?php echo e($request->type); ?></h3>
                <?php endif; ?>
                <?php if(request('type') != 'history'): ?>
                    <div class="vidiobanner margin-top-20 margin-bottom-20">
                        <img src="<?php echo e(URL::to('/')); ?>/uploads/videoTopBanner.png" alt="">
                    </div>
                <?php endif; ?>
            </div>

        </div>
    </section>
    <!-- video section end -->
    <div class="container">
        <div class="row">
            <?php if(!$videos->isEmpty() && empty(request('type'))): ?>
                <?php $__currentLoopData = $videos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php
                $parentalContent = $data->is_parental == 'on' ? 'parental-image' : '';
                ?>
                    <div class="col-md-3 col-lg-2 col-sm-6 col-6 margin-bottom-30">
                        <div class="homepage-video-image">
                            <a href="/videoshow/<?php echo e($data->id); ?>">
                                <?php if(!empty($data->thumbnail_vertical)): ?>
                                    <img src="<?php echo e(URL::to('/')); ?>/uploads/video/thumbnail/<?php echo e($data->thumbnail_vertical); ?>"
                                        alt="<?php echo e($data->title); ?>" title="<?php echo e($data->title); ?>" class="<?php echo e($parentalContent); ?>" />
                                <?php else: ?>
                                    <img src="<?php echo e(URL::to('/')); ?>/uploads/no.jpeg" alt="" class="<?php echo e($parentalContent); ?>" />
                                <?php endif; ?>
                                <div class="homepage-video-play-btn">
                                    <span class="iconify" data-icon="bi:play-circle-fill"></span>
                                </div>
                                
                                <?php if($data->type == 'premium'): ?>
                                    <div class="premium-ribbon">Premium</div>
                                <?php endif; ?>
                            </a>
                        </div>
                        <div class="homepage-video-details">
                            <div class="title"><a href="/videoshow/<?php echo e($data->id); ?>"><?php echo e($data->title); ?></a></div>
                            <div class="rating">
                                <i class="icofont icofont-star"></i>
                                <?php echo e($data->tmdb_rating ? round($data?->tmdb_rating, 2) : 'n/a'); ?> TMDB
                            </div>
                            <div class="trailer">
                                <a href="">Watch Trailer</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php elseif(!$videos->isEmpty() && !empty(request('type'))): ?>
                <?php $__currentLoopData = $videos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php
                $parentalContent = $data->is_parental == 'on' ? 'parental-image' : '';
                ?>
                    <div class="col-md-12 margin-top-20">

                        <a href="/videoshow/<?php echo e($data->id); ?>">
                            <div class="row my-videos my-videos-<?php echo e($data->id); ?> margin-bottom-10"
                                data-id="<?php echo e($data->id); ?>">
                                <div class="col-md-3 col-sm-5 col-5 my-video-img">
                                    <div class="my-video-img-section">
                                        <?php if(!empty($data->thumbnail_vertical)): ?>
                                            <img src="<?php echo e(URL::to('/')); ?>/uploads/video/thumbnail/<?php echo e($data->thumbnail_vertical); ?>"
                                                alt="<?php echo e($data->title); ?>" title="<?php echo e($data->title); ?>" class="<?php echo e($parentalContent); ?>"/>
                                        <?php else: ?>
                                            <img src="<?php echo e(URL::to('/')); ?>/uploads/no.jpeg" alt="" class="<?php echo e($parentalContent); ?>" />
                                        <?php endif; ?>
                                        <?php if($data->type == 'premium'): ?>
                                            <div class="premium-ribbon">Premium</div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="col-md-9 col-sm-7 col-7 my-video-details">
                                    <div class="my-video-title row">
                                        <div class="col-md-11 col-sm col-11">
                                            <?php echo e($data->title); ?>

                                        </div>
                                        <div class="col-md-1 col-sm-1 col-1">
                                            
                                        </div>
                                    </div>
                                    <div class="my-video-description">
                                        <?php echo e($data->description); ?>

                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php elseif($videos->isEmpty() && request('type') == 'favourite'): ?>
                <div class="favorite-video-not-found text-center">
                    <div class="use-wink">
                        <img src="<?php echo e(URL::to('/')); ?>/uploads/wink.png" alt="wink" />
                    </div>
                    <div class="use-btn margin-top-20">Use &nbsp;<i class="far fa-heart"></i>&nbsp; Button</div>
                    <div class="use-des margin-top-20">to save your favorites</div>
                </div>
            <?php else: ?>
                <div class="video-not-found">No video found..!</div>
            <?php endif; ?>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('custom-js'); ?>
    <script>
        // add favorite
        $(document).on("change", ".video-id", function(e) {
            e.preventDefault();
            var id = $(this).val();
            var status = 'unchecked';
            if (this.checked == true) {
                status = 'checked';
            }

            var options = {
                closeButton: true,
                debug: false,
                positionClass: "toast-bottom-right",
                onclick: null
            };

            $('.loading-spinner').css("display", "flex");
            $.ajax({
                url: window.origin + 'video/add-favorite',
                type: 'POST',
                dataType: "json",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    video_id: id,
                    status: status,
                },
                complete: function() {
                    $('.loading-spinner').css("display", "none");
                },
                success: function(res) {
                    toastr.success(res.message, res, options);
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

        // remove history
        $(document).on("click", ".clear-history-btn", function(e) {
            e.preventDefault();
            var id = $(this).data("id");

            var options = {
                closeButton: true,
                debug: false,
                positionClass: "toast-bottom-right",
                onclick: null
            };

            $('.loading-spinner').css("display", "flex");
            $.ajax({
                url: window.origin + 'clear-history',
                type: 'POST',
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
                    toastr.success(res.message, res, options);
                    $('.my-videos-' + id).hide();
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


        $(document).on("mouseover", ".my-videos", function() {
            var id = $(this).data("id");
            var clearClass = 'clear-history-' + id;
            $('.' + clearClass).show();
        });
        $(document).on("mouseout", ".my-videos", function() {
            var id = $(this).data("id");
            var clearClass = 'clear-history-' + id;
            $('.' + clearClass).hide();
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('frontend.layouts.client.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ccninfot/movieflix.ccninfotech.com/resources/views/frontend/client/allVideo.blade.php ENDPATH**/ ?>