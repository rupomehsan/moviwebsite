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
<div class="owl-carousel also-like-carousel owl-theme">
    <?php $__currentLoopData = $episodeInfo; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="card item margin-top-40">
            
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
            

            <?php if(!empty($data->thumbnail)): ?>
                <img src="<?php echo e(URL::to('/')); ?>/uploads/video/thumbnail/<?php echo e($data->thumbnail); ?>"
                    alt="<?php echo e($data->title); ?>" title="<?php echo e($data->title); ?>" />
            <?php else: ?>
                <img src="<?php echo e(URL::to('/')); ?>/uploads/no.jpeg" alt="" />
            <?php endif; ?>
            <div class="card-body">
                <h4 class="card-title"><?php echo e($data->short_title); ?></h4>
                <p class="card-text">
                    <?php echo e($data->short_description); ?>

                </p>
                <a class="btn btn-primary mt-20" href="/videoshow/<?php echo e($data->id); ?>">
                    <i class="fa fa-play" aria-hidden="true"></i>
                    Watch Movie
                </a>
            </div>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>
<!--/.Slides-->
<script>
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
</script>
<?php /**PATH /home/ccninfot/movieflix.ccninfotech.com/resources/views/frontend/client/getEpisod.blade.php ENDPATH**/ ?>