<?php $__env->startSection('content'); ?>
    <!-- Selected video section start -->
    <?php if($selectedVideoInfo->type == '' ||
        $selectedVideoInfo->type == 'free' ||
        ($selectedVideoInfo->type == 'premium' && !$subscriber->isEmpty())): ?>

        <?php if($selectedVideoInfo->is_parental != 'on'): ?>
            <section class="video singel-video-show-full">
                <div class="single-vidio-wrapper">
                    <div class="video-area">
                        <?php if($selectedVideoInfo->video_type == '4'): ?>
                            <video width="100%" height="100%" controls>
                                <source src="<?php echo e(URL::to('/')); ?>/uploads/video/<?php echo e($selectedVideoInfo->video); ?>">
                            </video>
                        <?php elseif($selectedVideoInfo->video_type == '5'): ?>
                            <video width="100%" height="100%" controls>
                                <source src="<?php echo e($selectedVideoInfo->url); ?>">
                            </video>
                        <?php elseif($selectedVideoInfo->video_type == '1'): ?>
                            <?php echo $embeded; ?>

                        <?php elseif($selectedVideoInfo->video_type == '2'): ?>
                            <?php echo $embeded; ?>

                        <?php elseif($selectedVideoInfo->video_type == '3'): ?>
                            <?php echo $embeded; ?>

                        <?php endif; ?>
                    </div>
                </div>

                <div class="single-vidio-description">
                    <div class="row single-vidio-rs">
                        <div class="col-md-9 left-part-rs col-sm-12">
                            <div class="left-part">
                                <?php if(!empty($selectedVideoInfo->thumbnail_vertical)): ?>
                                    <img src="<?php echo e(URL::to('/')); ?>/uploads/video/thumbnail/<?php echo e($selectedVideoInfo->thumbnail_vertical); ?>"
                                        alt="<?php echo e($selectedVideoInfo->title); ?>" title="<?php echo e($selectedVideoInfo->title); ?>" />
                                <?php else: ?>
                                    <img src="<?php echo e(URL::to('/')); ?>/uploads/no.jpeg" alt="" />
                                <?php endif; ?>
                                <div class="title">
                                    <h3><?php echo e($selectedVideoInfo->title ?? ''); ?> <span class="video_views_count"><?php echo e($videoViewsCount); ?> Views</span></h3>
                                    <p>
                                        <span class="borR"><?php echo e($selectedVideoInfo->category_name ?? ''); ?> </span> &nbsp;
                                        <span class="borR"><?php echo e($selectedVideoInfo->sub_category_name ?? ''); ?> </span>
                                        &nbsp;
                                        <span class="borR"><?php echo e($genreNames); ?> </span> &nbsp;
                                        <span class=""><?php echo e($countryNames); ?> </span> &nbsp;
                                    </p>
                                    <div class="imdb">
                                        <span> <i class="icofont icofont-star"></i> <?php echo !empty($tmdbRating['vote_average']) ? $tmdbRating['vote_average'] . ' TMDB' : ''; ?> </span>

                                        <div class="middle-devider-bold"></div>

                                        <span
                                            class="pl-2"><?php echo e($selectedVideoInfo->duration_hour ? $selectedVideoInfo->duration_hour . ' Hour' : ''); ?></span>
                                        <span
                                            class=""><?php echo e($selectedVideoInfo->duration ? $selectedVideoInfo->duration . ' Min' : ''); ?></span>
                                        <span
                                            class=""><?php echo e($selectedVideoInfo->duration_sec ? $selectedVideoInfo->duration_sec . ' Sec' : ''); ?></span>

                                        <div class="middle-devider-bold"></div>

                                        <button type="button" class="watch-trailer-btn-style watch-trailer-btn <?php echo !empty($data->trailer) ? '' : 'no-trailer-avilable'; ?>" data-toggle="modal"
                                            data-target="#trailerModal">Watch Trailer</button>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="col-md-3 col-sm-12 right-part">
                            <ul>
                                <li>
                                    <button type="button" class="share-button" data-toggle="modal"
                                        data-target="#commentData">
                                        <i class="far fa-comments"></i>
                                    </button>
                                </li>
                                <li>
                                    <button type="button" class="share-button" data-toggle="modal"
                                        data-target="#shareModal">
                                        <i class="fas fa-share-alt"></i>
                                    </button>
                                </li>
                                <li>

                                    
                                    <?php if(!empty(Auth()->id())): ?>
                                        <?php
                                        $checked = '';
                                        if (in_array($selectedVideoInfo->id, $favoriteList)) {
                                            $checked = 'checked';
                                        }
                                        ?>
                                        <input type="checkbox" class="video-id single-favorite" name="video_id"
                                            value="<?php echo e($selectedVideoInfo->id); ?>" <?php echo e($checked); ?>>
                                    <?php endif; ?>
                                    
                                </li>
                                <li>
                                    <?php if(!empty(Auth()->id())): ?>
                                        <button type="button" id="reportButton" class="share-button" data-toggle="modal"
                                            data-target="#reportModal" data-id="<?php echo e($selectedVideoInfo->id); ?>">
                                            <i class="fas fa-exclamation-triangle"></i>
                                        </button>
                                    <?php endif; ?>
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-12 decription">
                            <p><?php echo e($selectedVideoInfo->description ?? ''); ?></p>
                        </div>
                        <div class="col-md-12 dir-cast">
                            <p><span class="cast-crew"> Cast & Crew :</span> &nbsp;<?php echo e($celibrityNames); ?></p>
                        </div>
                        
                        <?php if($selectedVideoInfo->comment_on_off === 'on'): ?>
                            <div class="comment-section col-md-12">
                                <h3 class="comment-tiltle">COMMENT</h3>
                                
                                <?php if(!empty(Auth()->id())): ?>
                                    <form id="commentCreateForm" method="POST" enctype="multipart/form-data">
                                        <div class="create-comment row">
                                            <div class="comment-user-img">
                                                <?php if(!empty(Auth::user()->image)): ?>
                                                    <img src="<?php echo e(URL::to('/')); ?>/uploads/user/<?php echo e(Auth::user()->image); ?>"
                                                        alt="<?php echo e(Auth::user()->name); ?>" />
                                                <?php else: ?>
                                                    <img src="<?php echo e(URL::to('/')); ?>/uploads/no.jpeg" />
                                                <?php endif; ?>
                                            </div>
                                            <div class="comment-submit">
                                                <input type="hidden" name="video_id" value="<?php echo e($selectedVideoInfo->id); ?>">

                                                <input type="text" name="comment" id="commentInputSection" class=""
                                                    placeholder="Add a public comment..">

                                                <div class="comment-send text-right margin-top-10">
                                                    <button type="submit" id="createComment">Comment</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                <?php endif; ?>
                                

                                
                                <div class="show-comment">
                                    <div class="card">
                                        <div class="card-header" id="headingComments">
                                            <h5 class="mb-0">
                                                <button type="button" class="btn btn-link" data-toggle="collapse"
                                                    id="allCommentsBtn" data-target="#allComments" aria-expanded="true"
                                                    aria-controls="allComments">
                                                    <?php echo !$commentInfo->isEmpty() ? sizeOf($commentInfo) : 0; ?> &nbsp; Comments
                                                </button>
                                            </h5>
                                        </div>
                                        <div id="allComments" class="collapse" aria-labelledby="headingComments"
                                            data-parent="#accordion">
                                            <div class="card-body">
                                                <div class="all-comments">
                                                    <?php if(!$commentInfo->isEmpty()): ?>
                                                        <?php $__currentLoopData = $commentInfo; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <div class="row margin-top-20">
                                                                <div class="col-md-1 comment-user-img">
                                                                    <?php if(!empty($comment->user_image)): ?>
                                                                        <img src="<?php echo e(URL::to('/')); ?>/uploads/user/<?php echo e($comment->user_image); ?>"
                                                                            alt="<?php echo e($comment->user_name); ?>" />
                                                                    <?php else: ?>
                                                                        <img src="<?php echo e(URL::to('/')); ?>/uploads/no.jpeg" />
                                                                    <?php endif; ?>
                                                                </div>
                                                                <div class="col-md-11">
                                                                    <div class="comment-user-name">
                                                                        <?php echo e($comment->user_name); ?>&nbsp; <span
                                                                            class="white font-12">.&nbsp;<?php echo e($comment->created_at->diffForHumans()); ?></span>
                                                                    </div>
                                                                    <div class="comment-user">
                                                                        <?php echo e($comment->comment); ?>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                        <?php endif; ?>
                        
                    </div>
                </div>
            </section>
        <?php else: ?>
            <section class="video singel-video-show-full">
                <div class="premium-content-alert text-center">
                    To Watch This Parental Content Please Do <br> <br>

                    <button type="button" class="premium-content-alert-btn" data-id="<?php echo e($selectedVideoInfo->id); ?>"
                        data-toggle="modal" data-target="#parentalPassword">
                        Login Your Parental Password
                    </button>

                </div>
            </section>
        <?php endif; ?>
    <?php else: ?>
        <section class="video singel-video-show-full">
            <div class="premium-content-alert text-center">
                To Watch This Premium Content Please Do <br> <br> <br>
                <a href="<?php echo e(url('/get-package')); ?>" class="premium-content-alert-btn">
                    <span class="iconify" data-icon="jam:crown-f"></span>
                    Subscribe
                </a>
            </div>
        </section>
    <?php endif; ?>
    <!-- Selected video section end -->

    
    <?php if($selectedVideoInfo->is_series === 'on'): ?>
        <div class="series-season row">
            <div class="col-md-2 offset-md-5">
                <div class="form-group margin-top-40">
                    <select name="season_id" id="seasonType" class="form-control create-form">
                        <option value="0">Select Season</option>
                        <?php $__currentLoopData = $seasonList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php
                            $selected = '';
                            if ($id == $selectedVideoInfo->season_id) {
                                $selected = 'selected';
                            }
                            ?>
                            <option value="<?php echo e($id); ?>" <?php echo e($selected); ?>><?php echo e($name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
            </div>

            
            <div class="container my-4 also-like" id="episodeData">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="content-section-title">
                            <div class="title">
                                Episodes
                            </div>
                            <div class="triangle"></div>
                            <div class="line"></div>
                        </div>
                    </div>
                </div>
                <!--Slides-->

                <div class="owl-carousel just-added-carousel owl-theme">
                    <?php $__currentLoopData = $episodeInfo; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
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
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
                <!--/.Slides-->
            </div>
            

        </div>
    <?php endif; ?>
    

    
    <?php if(!empty($youLikeVideo)): ?>
        <div class="container my-4 also-like">

            <div class="homepage-video-pannel-title">
                <div class="title">
                    You May Also Like
                    <div class="triangle-container">
                        <div class="triangle"></div>
                    </div>
                </div>
            </div>
            <!--Slides-->

            <div class="owl-carousel also-like-carousel owl-theme">
                <?php $__currentLoopData = $youLikeVideo; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php
                    $parentalContent = $data->is_parental == 'on' ? 'parental-image' : '';
                    ?>
                    <div class="card item homepage-video-slider  margin-top-20">
                        <div class="homepage-video-image">
                            <a href="/videoshow/<?php echo e($data->id); ?>">
                                <?php if(!empty($data->thumbnail_vertical)): ?>
                                    <img src="<?php echo e(URL::to('/')); ?>/uploads/video/thumbnail/<?php echo e($data->thumbnail_vertical); ?>"
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
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
            <!--/.Slides-->
        </div>
    <?php endif; ?>
    


    
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
                            <input type="text" id="videoUrl" class="form-control" readonly
                                value="<?php echo e(url()->full()); ?>">
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

    
    <div class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" id="trailerModal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content single-vido-modal">
                <div class="modal-header">
                    <span class="modal-title">Trailer</span>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?php echo $trailer ?? ''; ?>

                </div>
            </div>
        </div>
    </div>


    
    <div class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" id="renderTrailerModal">
        <div class="modal-dialog modal-lg">
            <div id="renderTrailerContent"></div>
        </div>
    </div>

    
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
                        <input type="hidden" value="<?php echo e($selectedVideoInfo->id); ?>" name="video_id">
                        <input type="password" name="password" id="password" class="form-control website-input-form"
                            placeholder="Please enter your parental Password">
                        <button type="submit" id="parentalLogin" class="website-input-submit submit">Login</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('custom-js'); ?>
    <script>

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
        
        $('.also-like-carousel').owlCarousel({
            items: 5,
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
                800: {
                    items: 4
                },
                1000: {
                    items: 5
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
                url: window.origin + '/report/create',
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
                url: window.origin + '/report/store',
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

        // get episode
        $(document).on("change", "#seasonType", function(e) {
            e.preventDefault();
            var id = $(this).val();
            $("#episodeData").html('');
            // alert(id);

            $('.loading-spinner').css("display", "flex");
            $.ajax({
                url: window.origin + '/get-episod',
                type: 'POST',
                dataType: "json",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    season_id: id,
                },
                complete: function() {
                    $('.loading-spinner').css("display", "none");
                },
                success: function(res) {
                    $("#episodeData").html(res.html);
                },
                error: function(jqXhr, ajaxOptions, thrownError) {
                    $('.loading-spinner').css("display", "none");
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


        // comment add
        $(document).on("click", "#createComment", function(e) {
            e.preventDefault();
            var formData = new FormData($('#commentCreateForm')[0]);

            var options = {
                closeButton: true,
                debug: false,
                positionClass: "toast-bottom-right",
                onclick: null
            };
            $('.loading-spinner').css("display", "flex");
            $.ajax({
                url: window.origin + '/comment/store',
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
                    toastr.success('Comment Added successfully', res, options);
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
                }
            });
        });

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
                url: window.origin + '/parental-authentication',
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
                    $(".singel-video-show-full").html(res.html);
                },
                error: function(jqXhr, ajaxOptions, thrownError) {
                        toastr.error('Authentication Error', 'Credentials does not matched...', options);
                    $('.loading-spinner').css("display", "none");
                }
            });
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('frontend.layouts.client.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ccninfot/movieflix.ccninfotech.com/resources/views/frontend/client/videoshow.blade.php ENDPATH**/ ?>