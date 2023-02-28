<?php $__env->startSection('data_count'); ?>
    
    <div class="content-heading">
        <div class="row">
            
            <div class="col-md-8 content-title">
                <span class="title">Add New Video</span>
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

    
    <form id="videoCreateForm" method="POST" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>
        <div class="row create-body margin-top-20">
            <div class="col-md-6">
                <div class="form-select">
                    <select id="categoryType" class="form-control create-form" name="category_id">
                        <option value="0" selected>Select Category *</option>
                        <?php if(!empty($categoryList)): ?>
                            <?php $__currentLoopData = $categoryList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($id); ?>"><?php echo e($name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                    </select>
                    <span class="text-danger"><?php echo e($errors->first('category_id')); ?></span>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-select" id="subCategoryList">
                    <select id="subCategoryType" class="form-control create-form" name="sub_category_id">
                        <option value="0" selected>Select Sub Category</option>
                    </select>
                    <span class="text-danger"><?php echo e($errors->first('sub_category_id')); ?></span>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <input name="title" type="text" class="form-control create-form" id="title"
                        placeholder="Video Title *">
                    <span class="text-danger"><?php echo e($errors->first('title')); ?></span>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <input name="year" type="text" class="form-control create-form" id="year"
                        placeholder="Publishing Year *">
                    <span class="text-danger"><?php echo e($errors->first('year')); ?></span>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text left">Video Duration</span>
                        </div>
                        <input type="number" name="duration_hour" class="form-control create-form" id="duration"
                            max="24" min="0" placeholder="Hour">
                        <div class="input-group-prepend">
                            <span class="input-group-text middle">Hour</span>
                        </div>
                        <input type="number" name="duration" class="form-control create-form" id="duration" min="0"
                            max="60" placeholder="Minute *">
                        <div class="input-group-prepend">
                            <span class="input-group-text middle">Min</span>
                        </div>
                        <input type="number" name="duration_sec" class="form-control create-form" id="duration"
                            min="0" max="60" placeholder="Secound">
                        <div class="input-group-prepend">
                            <span class="input-group-text right">Sec</span>
                        </div>
                    </div>
                    <span class="text-danger"><?php echo e($errors->first('duration_hour')); ?></span>
                    <span class="text-danger"><?php echo e($errors->first('duration')); ?></span>
                    <span class="text-danger"><?php echo e($errors->first('duration_sec')); ?></span>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-select">
                    <select name="video_type" id="videoType" class="form-control create-form">
                        <option selected value="0">Select Video Type *</option>
                        <option value="1">YouTube</option>
                        <option value="2">Vimeo</option>
                        <option value="3">Daily Motion</option>
                        <option value="4">Local Video</option>
                        <option value="5">Another Server</option>
                    </select>
                    <span class="text-danger"><?php echo e($errors->first('video_type')); ?></span>
                </div>
            </div>

            <div class="col-md-6" id="urlContent">
                <div class="form-group">
                    <input name="url" type="text" class="form-control create-form" id="url"
                        placeholder="Video URL *">
                    <span class="text-danger"><?php echo e($errors->first('url')); ?></span>
                </div>
            </div>

            <div class="col-md-6 display-none" id="videoArea">
                
                <div class="file-upload-video">
                    <div class="video-upload-wrap">
                        <input name="video" id="video" class="file-upload-input-video" type='file'
                            onchange="readURLVideo(this);" accept="video/*" />
                        <div class="drag-text-video text-left">
                            &nbsp;&nbsp;<span class="iconify" data-icon="fa-solid:photo-video"></span>
                            &nbsp;<span>Upload Video Or Drag Here*</span>
                        </div>
                    </div>
                    <div class="file-upload-content-video">
                        <img class="file-upload-video" src="#" alt="your video" />
                        <div class="video-title-wrap">
                            <button type="button" onclick="removeUploadVideo()" class="remove-video">Remove
                                
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <input name="slug" type="text" class="form-control create-form" id="slug"
                        placeholder="Slug (https://www.xflix.com/movie_name)">
                    <span class="text-danger"><?php echo e($errors->first('slug')); ?></span>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-select">
                    <select name="type" id="type" class="form-control create-form">
                        <option value="free">Free</option>
                        <option value="premium">Premium</option>
                    </select>
                    <span class="text-danger"><?php echo e($errors->first('type')); ?></span>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <input name="trailer" type="text" class="form-control create-form" id="trailer"
                        placeholder="Video Trailer (Youtube Only)">
                    <span class="text-danger"><?php echo e($errors->first('trailer')); ?></span>
                </div>
            </div>

            <div id="fileContent" class="">
                <div class="row">

                    <div class="col-md-4 margin-top-20">
                        <label for="thumbnail">Video Thumbnail <span class="red">(Poster)</span></label>
                        <div class="file-upload video-horizontal">
                            <div class="image-upload-wrap">
                                <input name="thumbnail" id="thumbnail" class="file-upload-input" type='file'
                                    onchange="readURL(this);" accept="image/*" />
                                <div class="drag-text text-center">
                                    <span class="iconify" data-icon="bx:bx-image-alt"></span><br>
                                    <span>Upload Thumbnail Or Drag Here</span>
                                </div>
                            </div>
                            <div class="image-size-recomandation"><ul><li>Recomanded Image Size 180px*270px</li></ul></div>
                            <div class="file-upload-content">
                                <div class="image-title-wrap">
                                    <img class="file-upload-image" src="#" alt="your image" />
                                    <button type="button" onclick="removeUpload()" class="remove-image">
                                        <span class="iconify" data-icon="akar-icons:cross"></span>
                                    </button>
                                </div>
                            </div>
                            <span class="text-danger"><?php echo e($errors->first('thumbnail')); ?></span>
                        </div>
                    </div>

                    <div class="col-md-4 margin-top-20">
                        <label for="thumbnail">Video Thumbnail <span class="red">(Banner)</span></label>
                        <div class="file-upload-sec">
                            <div class="image-upload-wrap-sec">
                                <input name="thumbnail_vertical" id="thumbnail" class="file-upload-input-sec"
                                    type='file' onchange="readURLSec(this);" accept="image/*" />
                                <div class="drag-text-sec text-center">
                                    <span class="iconify" data-icon="bx:bx-image-alt"></span> <br>
                                    <span>Upload Thumbnail Or Drag Here</span>
                                </div>
                            </div>
                            <div class="image-size-recomandation image-size-recomandation-sec"><ul><li>Recomanded Image Size 300px*165px</li></ul></div>
                            <div class="file-upload-content-sec">
                                <img class="file-upload-image-sec" src="#" alt="your image" />
                                <div class="image-title-wrap-sec">
                                    <button type="button" onclick="removeUploadSec()" class="remove-image-sec">
                                        <span class="iconify" data-icon="akar-icons:cross"></span>
                                    </button>
                                </div>
                            </div>
                            <span class="text-danger"><?php echo e($errors->first('thumbnail_vertical')); ?></span>
                        </div>
                    </div>
                </div>
            </div>

            <div id="onOffContent" class="margin-bottom-20">
                <div class="row">
                    <div class="col-md-4 margin-top-20">
                        <div class="form-check form-switch">
                            <label class="form-check-label" for="send_notification">Send Notification</label>
                            <input class="form-check-input" name="send_notification" type="checkbox"
                                id="send_notification">
                            <span class="text-danger"><?php echo e($errors->first('send_notification')); ?></span>
                        </div>
                    </div>

                    

                    <div class="col-md-4 margin-top-20">
                        <div class="form-check form-switch">
                            <label class="form-check-label" for="commentOnOff">Comment for this video - off/on</label>
                            <input class="form-check-input" name="comment_on_off" type="checkbox" id="commentOnOff"
                                checked>
                            <span class="text-danger"><?php echo e($errors->first('comment_on_off')); ?></span>
                        </div>
                    </div>

                    <div class="col-md-4 margin-top-20">
                        <div class="form-check form-switch">
                            <label class="form-check-label" for="seriesYesNo">Is this video a series? </label>
                            <input class="form-check-input" name="is_series" type="checkbox" id="seriesYesNo">
                            <span class="text-danger"><?php echo e($errors->first('is_series')); ?></span>
                        </div>
                    </div>
                </div>
            </div>

            <div id="seriesContents" class="display-none margin-top-10">
                <div class="row">

                    <div class="col-md-6">
                        <div class="form-select">
                            <select name="series_category_id" id="seriesCategoryId" class="form-control create-form">
                                <option value="0" selected>Select Series Category</option>
                                <?php if(!empty($seriesCategoryList)): ?>
                                    <?php $__currentLoopData = $seriesCategoryList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($id); ?>"><?php echo e($name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                            </select>
                            <span class="text-danger"><?php echo e($errors->first('series_id')); ?></span>
                        </div>
                    </div>

                    <div class="col-md-6" id="seriesContent">
                        <div class="form-select">
                            <select id="seriesId" class="form-control create-form" name="series_id">
                                <option value="0" selected>Select Series</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-6" id="seasonContent">
                        <div class="form-select">
                            <select id="season" class="form-control create-form" name="season_id">
                                <option value="0" selected>Select Season</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-6" id="episodContent">
                        <div class="form-select">
                            <select id="episod" class="form-control create-form" name="episod_id">
                                <option value="0" selected>Select Episode</option>
                            </select>
                        </div>
                    </div>

                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-check form-switch margin-top-20">
                        <label class="form-check-label" for="trendingYesNo">Is this video in Trending Video? </label>
                        <input class="form-check-input" name="is_trending" type="checkbox" id="trendingYesNo">
                        <span class="text-danger"><?php echo e($errors->first('is_trending')); ?></span>
                    </div>
                </div>
                <div class="col-md-6 margin-top-10">
                    <div class="form-group">
                        <input name="fake_view" type="number" class="form-control create-form" id="fake_view"
                            placeholder="Fake Views">
                        <span class="text-danger"><?php echo e($errors->first('fake_view')); ?></span>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-check form-switch margin-top-20 text-center">
                        <label class="form-check-label" for="parentalYesNo">Is this video is Parental Content? </label>
                        <input class="form-check-input" name="is_parental" type="checkbox" id="parentalYesNo">
                        <span class="text-danger"><?php echo e($errors->first('is_parental')); ?></span>
                    </div>
                </div>
            </div>

            <div class="col-md-12 margin-top-20">
                <div class="form-group">
                    <textarea class="form-control create-form" id="description" name="description" rows="10"
                        placeholder="Video Description *"></textarea>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-select">
                    <select name="country_id[]" multiple="multiple" id="videoCountry" class="form-control create-form">
                        <?php if(!empty($countryList)): ?>
                            <?php $__currentLoopData = $countryList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($id); ?>"><?php echo e($name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                    </select>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-select">
                    <select name="celebrity_id[]" multiple="multiple" id="videoActor" class="form-control create-form">
                        <?php if(!empty($celebrityList)): ?>
                            <?php $__currentLoopData = $celebrityList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($id); ?>"><?php echo e($name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                    </select>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-select">
                    <select name="genre_id[]" multiple="multiple" id="videoGenre" class="form-control create-form">
                        <?php if(!empty($genreList)): ?>
                            <?php $__currentLoopData = $genreList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($id); ?>"><?php echo e($name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                    </select>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <input name="director" type="text" class="form-control create-form" id="director"
                        placeholder="Enter Director Name">
                    <span class="text-danger"><?php echo e($errors->first('director')); ?></span>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <input name="writer" type="text" class="form-control create-form" id="writer"
                        placeholder="Enter Writer Name">
                    <span class="text-danger"><?php echo e($errors->first('writer')); ?></span>
                </div>
            </div>

            <div class="col-md-6"></div>


            

            <div class="col-md-6">
                <div class="form-select">
                    <select name="tmdb_type" id="tmdb_type" class="form-control create-form">
                        <option value="movie">Movie (TMDB)</option>
                        <option value="tv">TV Shows (TMDB)</option>
                    </select>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <input name="imdb_id" type="text" class="form-control create-form" id="tmdbId"
                        placeholder="TMDB ID">
                    <span class="text-danger"><?php echo e($errors->first('imdb_id')); ?></span>

                    <div class="form-check margin-top-10 display-none" id="showTmdb">
                        <input name="show_tmdb" class="form-check-input" type="checkbox" value="yes" id="showTmdb">
                        <label class="form-check-label" for="showTmdb">
                            Want to Show TMDB Info
                        </label>
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <div class="card">
                    <div class="card-seo" id="headingseo">
                        <h5 class="mb-0">
                            <button type="button" class="btn btn-link" data-toggle="collapse" data-target="#seoAd"
                                aria-expanded="true" aria-controls="seoAd">
                                SEO Content
                            </button>
                        </h5>
                    </div>


                    <div id="seoAd" class="collapse" aria-labelledby="headingseo" data-parent="#accordion">
                        <div class="card-body seo-card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input name="seo_title" type="text" class="form-control create-form"
                                            id="seo_title" placeholder="Write SEO Title Here">
                                        <span class="text-danger"><?php echo e($errors->first('seo_title')); ?></span>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <textarea class="form-control create-form" id="meta_description" name="meta_description" rows="10"
                                            placeholder="Write Meta Description Here"></textarea>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <textarea class="form-control create-form" id="focus_keyword" name="focus_keyword" rows="10"
                                            placeholder="Write Focus Keyword Here (use comma(,) to separate keyword)"></textarea>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <textarea class="form-control create-form" id="seo_tag" name="seo_tag" rows="10"
                                            placeholder="Write SEO Tag Here (use comma(,) to separate tags)"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-12 actions margin-top-10 text-center">
                <button class="submit margin-bottom-20" type="submit" id="createVideo">Add Video</button>
                <a href="/admin/video" class="full-page-cancel cancel">Cancel</a>
            </div>

            <div class=" margin-top-20"></div>
        </div>
    </form>
    



<?php $__env->stopSection(); ?>
<?php $__env->startPush('custom-js'); ?>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#videoCountry').select2();
            $('#videoCountry').select2({
                placeholder: 'Select Country'
            });

            $('#videoActor').select2();
            $('#videoActor').select2({
                placeholder: 'Select Celebrity'
            });

            $('#videoGenre').select2();
            $('#videoGenre').select2({
                placeholder: 'Select Genre'
            });
        });

        // get sub category
        $(document).on("change", "#categoryType", function(e) {
            e.preventDefault();
            var categoryId = $("#categoryType").val();
            $("#subCategoryList").html('');
            //    alert(categoryId);
            $('.loading-spinner').css("display", "flex");
            $.ajax({
                url: window.origin + '/admin/video/get-sub-category',
                type: "POST",
                dataType: "json",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    category_id: categoryId,
                },
                complete: function() {
                    $('.loading-spinner').css("display", "none");
                },
                success: function(res) {
                    $("#subCategoryList").html(res.html);
                },
                error: function(jqXhr, ajaxOptions, thrownError) {
                    $('.loading-spinner').css("display", "none");
                }
            }); //ajax
        });

        // get Series
        $(document).on("change", "#seriesCategoryId", function(e) {
            e.preventDefault();
            var seriesCategoryId = $("#seriesCategoryId").val();
            $("#seriesContent").html('');
            $("#seasonContent").html(
                '<div class="form-select"><select id="season" class="form-control create-form" name="season"><option value="0" selected>Select Season</option></select></div>'
            );
            $("#episodContent").html(
                '<div class="form-select"><select id="episod" class="form-control create-form" name="episod"><option value="0" selected>Select Episode</option></select></div>'
            );
            //    alert(categoryId);
            $('.loading-spinner').css("display", "flex");
            $.ajax({
                url: window.origin + '/admin/video/get-series',
                type: "POST",
                dataType: "json",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    series_category_id: seriesCategoryId,
                },
                complete: function() {
                    $('.loading-spinner').css("display", "none");
                },
                success: function(res) {
                    $("#seriesContent").html(res.html);
                },
                error: function(jqXhr, ajaxOptions, thrownError) {
                    $('.loading-spinner').css("display", "none");
                }
            }); //ajax
        });

        // get season
        $(document).on("change", "#seriesId", function(e) {
            e.preventDefault();
            var seriesId = $("#seriesId").val();
            // alert(seriesId);
            $("#seasonContent").html('');
            $("#episodContent").html(
                '<div class="form-select"><select id="episod" class="form-control create-form" name="episod"><option value="0" selected>Select Episode</option></select></div>'
            );
            //    alert(categoryId);
            $('.loading-spinner').css("display", "flex");
            $.ajax({
                url: window.origin + '/admin/video/get-season',
                type: "POST",
                dataType: "json",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    series_id: seriesId,
                },
                complete: function() {
                    $('.loading-spinner').css("display", "none");
                },
                success: function(res) {
                    $("#seasonContent").html(res.html);
                },
                error: function(jqXhr, ajaxOptions, thrownError) {
                    $('.loading-spinner').css("display", "none");
                }
            }); //ajax
        });

        // get episode
        $(document).on("change", "#season", function(e) {
            e.preventDefault();
            var season = $("#season").val();
            $("#episodContent").html('');
            //    alert(season);
            $('.loading-spinner').css("display", "flex");
            $.ajax({
                url: window.origin + '/admin/video/get-episod',
                type: "POST",
                dataType: "json",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    season_id: season,
                },
                complete: function() {
                    $('.loading-spinner').css("display", "none");
                },
                success: function(res) {
                    $("#episodContent").html(res.html);
                },
                error: function(jqXhr, ajaxOptions, thrownError) {
                    $('.loading-spinner').css("display", "none");
                }
            }); //ajax
        });

        // season input type
        $(document).on("change", ".is-new-season", function(e) {
            e.preventDefault();

            if (($(this).val()) == 'yes') {
                $('#seasonContentText').show();
                $('#seasonContent').hide();
            }
            if (($(this).val()) == 'no') {
                $('#seasonContent').show();
                $('#seasonContentText').hide();
            }
        });

        // get upload Video content
        $(document).on("change", "#videoType", function(e) {
            e.preventDefault();
            var videoType = $("#videoType").val();

            if (videoType == "4") {
                $('#videoArea').show();
                $('#urlContent').hide();
            } else {
                $('#videoArea').hide();
                $('#urlContent').show();
            }
        });

        // get series content
        $(document).on("change", "#seriesYesNo", function(e) {
            e.preventDefault();

            if (this.checked != true) {
                $('#seriesContents').hide();
            }
            if (this.checked == true) {
                $('#seriesContents').show();
            }
        });

        //tmdb hide show
        $(document).on("keyup", "#tmdbId", function(e) {
            e.preventDefault();
            if (this.value != '') {
                $('#showTmdb').show();
            } else {
                $('#showTmdb').hide();
            }
        });

        // save
        $(document).on("click", "#createVideo", function(e) {
            e.preventDefault();
            var formData = new FormData($('#videoCreateForm')[0]);

            var options = {
                closeButton: true,
                debug: false,
                positionClass: "toast-bottom-right",
                onclick: null
            };
            $('.loading-spinner').css("display", "flex");
            $.ajax({
                url: window.origin + '/admin/video/store',
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
                    toastr.success('Video Added successfully', res, options);
                    var delay = 1000;
                    var url = '/admin/video'
                    setTimeout(function() {
                        window.location = url;
                    }, delay);
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

<?php echo $__env->make('layouts.default.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/projectx/Desktop/laravelProjects/movieflix-main/resources/views/video/create.blade.php ENDPATH**/ ?>