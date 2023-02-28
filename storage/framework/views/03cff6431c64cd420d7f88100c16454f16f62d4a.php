<?php $__env->startSection('content'); ?>
    <div class="header-gap"></div>

    <?php if(!empty($adsInfo)): ?>
        <?php $__currentLoopData = $adsInfo; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ads): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if($ads->ad_type == 'custom_header' && $ads->status == 'on' && $ads->image != null): ?>
                <div class="container">
                    <div class="header-ad-section">
                        <a href="<?php echo e($ads->ad_link); ?>" target="_blank">
                            <img src="<?php echo e(URL::to('/')); ?>/uploads/ad/<?php echo e($ads->image); ?>" alt="Header ad image" />
                        </a>
                    </div>
                </div>
            <?php elseif($ads->ad_type == 'header' && $ads->status == 'on' && $ads->link != null): ?>
                )
                <div class="container">
                    <div class="header-ad-section">
                        <a href="<?php echo e($ads->ad_link); ?>" target="_blank">
                            <img src="<?php echo e(URL::to('/')); ?>/uploads/ad/<?php echo e($ads->image); ?>" alt="Header ad image" />
                        </a>
                    </div>
                </div>
            <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php endif; ?>

    
    <?php if(!$trendingVideoInfo->isEmpty()): ?>
        <div class="container">
            <div class="tranding-top-slider">

                <div class="owl-carousel trending-top-carousel owl-theme">

                    <?php $__currentLoopData = $trendingVideoInfo; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="card item trending-top-slider  margin-top-20">
                            <a href="/videoshow/<?php echo e($data->id); ?>">
                                <div class="trending-container">
                                    <div class="pannel-heading">
                                        <div class="pannel-name">
                                            Trending Now
                                            <div class="triangle"></div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-7 col-md-7 col-sm-12">
                                            <div class="video-title margin-top-54">
                                                <div class="title">
                                                    <div class="prev-line"></div>
                                                    <div class="title-text"><?php echo e($data->title); ?></div>
                                                </div>
                                                <div class="video-details margin-top-10">
                                                    <div class="details-line tmdb">
                                                        <i class="icofont icofont-star"></i>
                                                        <?php echo e($data->tmdb_rating ? round($data?->tmdb_rating, 2) : 'n/a'); ?>

                                                        TMDB
                                                    </div>
                                                    <div class="details-line middle-line"></div>
                                                    <div class="details-line duration">
                                                        <?php echo e($data->duration_hour ? $data->duration_hour . ' Hr' : ''); ?>

                                                        <?php echo e($data->duration ? $data->duration . ' Min' : ''); ?>

                                                        <?php echo e($data->duration_sec ? $data->duration_sec . ' Sec' : ''); ?>

                                                    </div>
                                                    <div class="details-line middle-line"></div>
                                                    <div class="details-line trailer">

                                                        <a href="#" class="watch-trailer-btn <?php echo !empty($data->trailer) ? '' : 'no-trailer-avilable'; ?>"
                                                            data-id="<?php echo e($data->trailer); ?>" data-toggle="modal"
                                                            data-target="#renderTrailerModal">
                                                            Watch Trailer
                                                        </a>
                                                    </div>

                                                    <div class="description margin-top-14">
                                                        <?php echo e($data->description ?? ''); ?>

                                                    </div>

                                                    <?php if(!empty($genreArr)): ?>
                                                        <div class="grnres-container">
                                                            <?php if(!empty($genreArr[$data->id])): ?>
                                                                <?php $__currentLoopData = $genreArr[$data->id]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                    <div class="single-genre">
                                                                        <a
                                                                            href="<?php echo e(url('/video?type=genre&genre_id=' . $id)); ?>">
                                                                            <?php echo e($name); ?>

                                                                        </a>
                                                                    </div>
                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                            <?php endif; ?>
                                                        </div>
                                                    <?php endif; ?>
                                                </div>


                                                <?php if(!empty($celibritiesArr)): ?>
                                                    <div class="video-casts margin-top-20">
                                                        <h4>CAST & CREW</h4>

                                                        <div class="casts">

                                                            <?php if(!$celibritiesArr[$data->id]->isEmpty()): ?>
                                                                <?php $count = '1'; ?>
                                                                <?php $__currentLoopData = $celibritiesArr[$data->id]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $celebrity): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                    <div class="single-cast">
                                                                        <?php if($celebrity->file_type == 'link'): ?>
                                                                            <img src="<?php echo e($celebrity->file_link); ?>"
                                                                                alt="<?php echo e($celebrity->name); ?>"
                                                                                title="<?php echo e($celebrity->name); ?>" />
                                                                        <?php else: ?>
                                                                            <?php if(!empty($celebrity->image)): ?>
                                                                                <img src="<?php echo e(URL::to('/')); ?>/uploads/celebrity/<?php echo e($celebrity->image); ?>"
                                                                                    alt="<?php echo e($celebrity->name); ?>"
                                                                                    title="<?php echo e($celebrity->name); ?>" />
                                                                            <?php else: ?>
                                                                                <img
                                                                                    src="<?php echo e(URL::to('/')); ?>/uploads/no.jpeg" />
                                                                            <?php endif; ?>
                                                                        <?php endif; ?>
                                                                        <div class="cast-name"><?php echo e($celebrity->name); ?></div>
                                                                    </div>

                                                                    <?php
                                                                    if ($count === '3') {
                                                                        break;
                                                                    }
                                                                    $count++;
                                                                    ?>
                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                            <?php endif; ?>
                                                        </div>
                                                    </div>
                                                <?php endif; ?>
                                            </div>

                                        </div>
                                        <div class="col-lg-5 col-md-5 col-sm-12">
                                            <?php
                                            $parentalContent = $data->is_parental == 'on' ? 'parental-image' : '';
                                            ?>
                                            <div class="video-thumbnail">
                                                <?php if(!empty($data->thumbnail_vertical)): ?>
                                                    <img src="<?php echo e(URL::to('/')); ?>/uploads/video/thumbnail/<?php echo e($data->thumbnail_vertical); ?>"
                                                        alt="<?php echo e($data->title); ?>" title="<?php echo e($data->title); ?>"
                                                        class="<?php echo e($parentalContent); ?>" />
                                                <?php else: ?>
                                                    <img src="<?php echo e(URL::to('/')); ?>/uploads/no.jpeg" alt=""
                                                        class="<?php echo e($parentalContent); ?>" />
                                                <?php endif; ?>


                                                
                                                <?php if(!empty(Auth()->id())): ?>
                                                    <?php
                                                    $checked = '';
                                                    if (in_array($data->id, $favoriteList)) {
                                                        $checked = 'checked';
                                                    }
                                                    ?>
                                                    <div class="text-right">
                                                        <input type="checkbox" class="video-id" name="video_id"
                                                            value="<?php echo e($data->id); ?>" <?php echo e($checked); ?>>
                                                    </div>
                                                <?php endif; ?>
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                </div>

            </div>
        </div>
    <?php else: ?>
        <div class="margin-top-20"></div>
    <?php endif; ?>
    

    
    <?php if(!$justAdded->isEmpty()): ?>
        <div class="container margin-top-10">

            <div class="homepage-video-pannel-title">
                <div class="title">
                    Just Added
                    <div class="triangle-container">
                        <div class="triangle"></div>
                    </div>
                </div>
            </div>

            <!--Slides-->
            <div class="owl-carousel just-added-carousel owl-theme">
                <?php $__currentLoopData = $justAdded; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php
                    $parentalContent = $data->is_parental == 'on' ? 'parental-image' : '';
                    ?>
                    <div class="card item homepage-video-slider  margin-top-20">
                        <div class="homepage-video-image">
                            <a href="/videoshow/<?php echo e($data->id); ?>">
                                <?php if(!empty($data->thumbnail)): ?>
                                    <img src="<?php echo e(URL::to('/')); ?>/uploads/video/thumbnail/<?php echo e($data->thumbnail); ?>"
                                        alt="<?php echo e($data->title); ?>" title="<?php echo e($data->title); ?>"
                                        class="<?php echo e($parentalContent); ?>" />
                                <?php else: ?>
                                    <img src="<?php echo e(URL::to('/')); ?>/uploads/no.jpeg" alt=""
                                        class="<?php echo e($parentalContent); ?>" />
                                <?php endif; ?>
                                <div class="homepage-video-play-btn">
                                    <span class="iconify" data-icon="bi:play-circle-fill"></span>
                                </div>
                                
                                <?php if($data->type == 'premium'): ?>
                                    <div class="premium-ribbon">Premium</div>
                                <?php endif; ?>

                                
                                <?php if(!empty(Auth()->id())): ?>
                                    <?php
                                    $checked = '';
                                    if (in_array($data->id, $favoriteList)) {
                                        $checked = 'checked';
                                    }
                                    ?>
                                    <div class="text-right">
                                        <input type="checkbox" class="video-id" name="video_id" value="<?php echo e($data->id); ?>"
                                            <?php echo e($checked); ?>>
                                    </div>
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
                                <a href="#" class="watch-trailer-btn <?php echo !empty($data->trailer) ? '' : 'no-trailer-avilable'; ?>" data-id="<?php echo e($data->trailer); ?>"
                                    data-toggle="modal" data-target="#renderTrailerModal">
                                    Watch Trailer
                                </a>
                            </div>
                        </div>

                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
            <!--/.Slides-->
        </div>
    <?php endif; ?>
    

    <!-- popular video section start -->
    <section class="video margin-top-40">
        <div class="container">
            <div class="pupular">

                <div class="homepage-video-pannel-title">
                    <div class="title">
                        Popular
                        <div class="triangle-container">
                            <div class="triangle"></div>
                        </div>
                    </div>
                </div>



                <!--Slides-->
                <div class="owl-carousel popular-carousel owl-theme">
                    <?php $__currentLoopData = $populerVideoInfo; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php
                        $parentalContent = $data->is_parental == 'on' ? 'parental-image' : '';
                        ?>
                        <div class="card item popular-slider  margin-top-20">

                            <div class="popupar-wrapper">
                                <div class="row align-items-center">
                                    <div class="col-md-6 col-lg-4 col-sm-6 col-12">
                                        <div class="homepage-video-image">
                                            <a href="/videoshow/<?php echo e($data->id); ?>">
                                                <?php if(!empty($data->thumbnail_vertical)): ?>
                                                    <img src="<?php echo e(URL::to('/')); ?>/uploads/video/thumbnail/<?php echo e($data->thumbnail_vertical); ?>"
                                                        alt="<?php echo e($data->title); ?>" title="<?php echo e($data->title); ?>"
                                                        class="popular-thumbnail <?php echo e($parentalContent); ?>" />
                                                <?php else: ?>
                                                    <img src="<?php echo e(URL::to('/')); ?>/uploads/no.jpeg" alt=""
                                                        class="<?php echo e($parentalContent); ?>" />
                                                <?php endif; ?>
                                                <div class="homepage-video-play-btn">
                                                    <span class="iconify" data-icon="bi:play-circle-fill"></span>
                                                </div>
                                                
                                                <?php if($data->type == 'premium'): ?>
                                                    <div class="premium-ribbon">Premium</div>
                                                <?php endif; ?>

                                                
                                                <?php if(!empty(Auth()->id())): ?>
                                                    <?php
                                                    $checked = '';
                                                    if (in_array($data->id, $favoriteList)) {
                                                        $checked = 'checked';
                                                    }
                                                    ?>
                                                    <div class="text-right">
                                                        <input type="checkbox" class="video-id" name="video_id"
                                                            value="<?php echo e($data->id); ?>" <?php echo e($checked); ?>>
                                                    </div>
                                                <?php endif; ?>
                                                
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-8 col-sm-6 col-12">
                                        <div class="row">
                                            <div class="prpular-right text-left">
                                                <h4 class="ptb-20"><?php echo e($data->short_title); ?></h4>
                                                <p class="card-text">
                                                    <?php echo e($data->description); ?>

                                                </p> <br>

                                                
                                                <?php if(!empty(Auth()->id())): ?>
                                                    <?php
                                                    $checked = '';
                                                    if (in_array($data->id, $favoriteList)) {
                                                        $checked = 'checked';
                                                    }
                                                    ?>
                                                    <span class="text-right populer-checkbox">
                                                        <input type="checkbox" class="video-id" id="videoId"
                                                            name="video_id" value="<?php echo e($data->id); ?>"
                                                            <?php echo e($checked); ?>>
                                                        <label for="videoId">Add To Favourite</label>
                                                    </span>
                                                <?php endif; ?>
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
                <!--/.Slides-->
            </div>
        </div>
    </section>
    <!-- popular video section end -->

    
    <?php if(!empty($subCategoryShow)): ?>
        <?php $subCategorySerial = '1'; ?>
        <?php $__currentLoopData = $subCategoryShow; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="container margin-top-20">


                <div class="homepage-video-pannel-title">
                    <div class="title">
                        <?php echo e($name); ?>

                        <div class="triangle-container">
                            <div class="triangle"></div>
                        </div>
                    </div>
                </div>

                <!--Slides-->
                <div class="owl-carousel just-added-carousel owl-theme">
                    <?php $__currentLoopData = $subCategoryVideoInfo; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php
                        $parentalContent = $data->is_parental == 'on' ? 'parental-image' : '';
                        ?>
                        <?php if($data->sub_category_id == $id): ?>
                            <div class="card item homepage-video-slider  margin-top-20">
                                <div class="homepage-video-image">
                                    <a href="/videoshow/<?php echo e($data->id); ?>">
                                        <?php if(!empty($data->thumbnail)): ?>
                                            <img src="<?php echo e(URL::to('/')); ?>/uploads/video/thumbnail/<?php echo e($data->thumbnail); ?>"
                                                alt="<?php echo e($data->title); ?>" title="<?php echo e($data->title); ?>"
                                                class="<?php echo e($parentalContent); ?>" />
                                        <?php else: ?>
                                            <img src="<?php echo e(URL::to('/')); ?>/uploads/no.jpeg" alt=""
                                                class="<?php echo e($parentalContent); ?>" />
                                        <?php endif; ?>
                                        <div class="homepage-video-play-btn">
                                            <span class="iconify" data-icon="bi:play-circle-fill"></span>
                                        </div>
                                        
                                        <?php if($data->type == 'premium'): ?>
                                            <div class="premium-ribbon">Premium</div>
                                        <?php endif; ?>

                                        
                                        <?php if(!empty(Auth()->id())): ?>
                                            <?php
                                            $checked = '';
                                            if (in_array($data->id, $favoriteList)) {
                                                $checked = 'checked';
                                            }
                                            ?>
                                            <div class="text-right">
                                                <input type="checkbox" class="video-id" name="video_id"
                                                    value="<?php echo e($data->id); ?>" <?php echo e($checked); ?>>
                                            </div>
                                        <?php endif; ?>
                                        
                                    </a>
                                </div>
                                <div class="homepage-video-details">
                                    <div class="title"><a href="/videoshow/<?php echo e($data->id); ?>"><?php echo e($data->title); ?></a>
                                    </div>
                                    <div class="rating">
                                        <i class="icofont icofont-star"></i>
                                        <?php echo e($data->tmdb_rating ? round($data?->tmdb_rating, 2) : 'n/a'); ?> TMDB
                                    </div>
                                    <div class="trailer">
                                        <a href="#" class="watch-trailer-btn <?php echo !empty($data->trailer) ? '' : 'no-trailer-avilable'; ?>" data-id="<?php echo e($data->trailer); ?>"
                                            data-toggle="modal" data-target="#renderTrailerModal">
                                            Watch Trailer
                                        </a>
                                    </div>
                                </div>

                            </div>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
                <!--/.Slides-->
            </div>
            <?php $subCategorySerial++; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php endif; ?>
    

    
    <div class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" id="renderTrailerModal">
        <div class="modal-dialog modal-lg">
            <div id="renderTrailerContent"></div>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('custom-js'); ?>
    <script>
        $('.trending-top-carousel').owlCarousel({
            items: 1,
            loop: true,
            autoplay: true,
            responsiveClass: true,
            margin: 10,
            nav: true,
            // dots: false,
            navText: ["<div class='nav-btn prev-slide'></div>", "<div class='nav-btn next-slide'></div>"]
        });

        $('.just-added-carousel').owlCarousel({
            items: 7,
            loop: true,
            autoplay: true,
            responsiveClass: true,
            margin: 10,
            nav: true,
            // dots: false,
            navText: ["<div class='nav-btn prev-slide'></div>", "<div class='nav-btn next-slide'></div>"],
            responsive: {
                0: {
                    items: 2
                },
                600: {
                    items: 4
                },
                1000: {
                    items: 7
                }
            }
        });

        $('.popular-carousel').owlCarousel({
            items: 1,
            loop: true,
            autoplay: true,
            responsiveClass: true,
            margin: 10,
            nav: true,
            // dots: false,
            navText: ["<div class='nav-btn prev-slide'></div>", "<div class='nav-btn next-slide'></div>"]
        });


        $('.sponsor-carousel').owlCarousel({
            items: 2,
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
                    items: 1
                },
                1000: {
                    items: 2
                }
            }
        });


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
                url: window.origin + '/video/add-favorite',
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

        // play trailer
        $(document).on("click", ".watch-trailer-btn", function(e) {
            e.preventDefault();

            var options = {
                closeButton: true,
                debug: false,
                positionClass: "toast-bottom-right",
                onclick: null
            };

            var trailer = $(this).attr("data-id");


            if (trailer == '' || trailer == null) {
                toastr.error('No Trailer link', options);
                return false;
            }
            // alert(trailer);

            $('.loading-spinner').css("display", "flex");
            $.ajax({
                url: window.origin + '/watch-trailer',
                type: 'POST',
                dataType: "json",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    trailer: trailer,
                },
                complete: function() {
                    $('.loading-spinner').css("display", "none");
                },
                success: function(res) {
                    $("#renderTrailerContent").html(res.html);
                },
                error: function(jqXhr, ajaxOptions, thrownError) {
                    $('.loading-spinner').css("display", "none");
                }
            });
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('frontend.layouts.client.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ccninfot/movieflix.ccninfotech.com/resources/views/frontend/client/categoryIndex.blade.php ENDPATH**/ ?>