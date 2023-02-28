
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

    <div class="single-vidio-description ptb-30">
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
                        <h3><?php echo e($selectedVideoInfo->title ?? ''); ?></h3>
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

                            <button type="button" class="watch-trailer-btn-style <?php echo !empty($data->trailer) ? '' : 'no-trailer-avilable'; ?>" data-toggle="modal"
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
    </div><?php /**PATH /home/ccninfot/movieflix.ccninfotech.com/resources/views/frontend/client/getParentalVideo.blade.php ENDPATH**/ ?>