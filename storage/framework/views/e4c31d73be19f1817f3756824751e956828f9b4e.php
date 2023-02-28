<?php $__env->startSection('content'); ?>
    <!-- video section start -->
    <section class="video ptb-90">
        <div class="container">

            <div class="category ptb-30">
                <div class="header-add-section ads-section category-top-header-section margin-top-40 row">
                    <div class="text-right">
                        <img src="<?php echo e(URL::to('/')); ?>/uploads/videoTopBanner.png" alt="">
                    </div>
                </div>


                
                <?php if(!$categoryInfo->isEmpty()): ?>
                    <div class="single-section margin-top-40">
                        <div class="heding">
                            <h3>Category</h3>
                            
                        </div>

                        <!--Slides-->
                        <div class="owl-carousel country-carousel owl-theme" id="owlCarousel6">
                            <?php $__currentLoopData = $categoryInfo; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="card item margin-top-40">
                                    <a href="<?php echo e(url('/category-index?category_id=' . $category->id)); ?>">
                                        <div class="country-slider-new">
                                            <div class="img">
                                                <?php if($category->file_type == 'link'): ?>
                                                    <img src="<?php echo e($category->file_link); ?>" alt="<?php echo e($category->name); ?>"
                                                        title="<?php echo e($category->name); ?>" />
                                                <?php else: ?>
                                                    <?php if(!empty($category->image)): ?>
                                                        <img src="<?php echo e(URL::to('/')); ?>/uploads/category/<?php echo e($category->image); ?>"
                                                            alt="<?php echo e($category->name); ?>" title="<?php echo e($category->name); ?>" />
                                                    <?php else: ?>
                                                        <img src="<?php echo e(URL::to('/')); ?>/uploads/no.jpeg" alt="" />
                                                    <?php endif; ?>
                                                <?php endif; ?>
                                            </div>
                                            <div class="name margin-top-10"><?php echo e($category->name); ?></div>
                                        </div>
                                    </a>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>

                        <div class="collapse" id="collapseExample6">
                            <div class="">
                                <?php $__currentLoopData = $categoryInfo; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="heading-img">
                                        <a href="<?php echo e(url('/category-index?category_id=' . $category->id)); ?>">
                                            <div class="country-slider-new">
                                                <div class="img">
                                                    <?php if(!empty($category->image)): ?>
                                                        <img src="<?php echo e(URL::to('/')); ?>/uploads/category/<?php echo e($category->image); ?>"
                                                            alt="<?php echo e($category->name); ?>" title="<?php echo e($category->name); ?>" />
                                                    <?php else: ?>
                                                        <img src="<?php echo e(URL::to('/')); ?>/uploads/no.jpeg" alt="" />
                                                    <?php endif; ?>
                                                </div>
                                                <div class="name margin-top-10"><?php echo e($category->name); ?></div>
                                            </div>
                                        </a>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                        <!--/.Slides-->
                    </div>
                <?php endif; ?>
                

                
                <?php if(!$countryInfo->isEmpty()): ?>
                    <div class="single-section margin-top-40">
                        <div class="heding">
                            <h3>Country</h3>
                            
                        </div>

                        <!--Slides-->
                        <div class="owl-carousel country-carousel owl-theme" id="owlCarousel">
                            <?php $__currentLoopData = $countryInfo; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="card item margin-top-40">
                                    <a href="<?php echo e(url('/video?type=country&country_id=' . $country->id)); ?>">
                                        <div class="country-slider-new">
                                            <div class="img">
                                                <?php if($country->file_type == 'link'): ?>
                                                    <img src="<?php echo e($country->file_link); ?>" alt="<?php echo e($country->name); ?>"
                                                        title="<?php echo e($country->name); ?>" />
                                                <?php else: ?>
                                                    <?php if(!empty($country->image)): ?>
                                                        <img src="<?php echo e(URL::to('/')); ?>/uploads/country/<?php echo e($country->image); ?>"
                                                            alt="<?php echo e($country->name); ?>" title="<?php echo e($country->name); ?>" />
                                                    <?php else: ?>
                                                        <img src="<?php echo e(URL::to('/')); ?>/uploads/no.jpeg" alt="" />
                                                    <?php endif; ?>
                                                <?php endif; ?>
                                            </div>
                                            <div class="name margin-top-10"><?php echo e($country->name); ?></div>
                                        </div>
                                    </a>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>

                        <div class="collapse" id="collapseExample">
                            <div class="">
                                <?php $__currentLoopData = $countryInfo; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="heading-img">
                                        <a href="<?php echo e(url('/video?type=country&country_id=' . $country->id)); ?>">
                                            <div class="country-slider-new">
                                                <div class="img">
                                                    <?php if(!empty($country->image)): ?>
                                                        <img src="<?php echo e(URL::to('/')); ?>/uploads/country/<?php echo e($country->image); ?>"
                                                            alt="<?php echo e($country->name); ?>" title="<?php echo e($country->name); ?>" />
                                                    <?php else: ?>
                                                        <img src="<?php echo e(URL::to('/')); ?>/uploads/no.jpeg" alt="" />
                                                    <?php endif; ?>
                                                </div>
                                                <div class="name margin-top-10"><?php echo e($country->name); ?></div>
                                            </div>
                                        </a>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                        <!--/.Slides-->
                    </div>
                <?php endif; ?>
                

                
                <?php if(!$years->isEmpty()): ?>
                    <div class="single-section">
                        <div class="heding">
                            <h3>Year</h3>
                        </div>

                        <div class="owl-carousel country-carousel owl-theme" id="owlCarousel">
                            <?php $__currentLoopData = $years; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $year): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="card item margin-top-40 year-carousel">
                                    <a href="<?php echo e(url('/video?type=year&year=' . $year->year)); ?>">
                                        <img src="<?php echo e(asset('assets/img/year.png')); ?>" alt="">
                                        <div class="name text-center margin-top-10"><?php echo e($year->year); ?></div>
                                    </a>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                <?php endif; ?>
                

                
                <?php if(!$celebrityInfo->isEmpty()): ?>
                    <div class="single-section">
                        <div class="heding">
                            <h3>Celebrity</h3>
                            
                        </div>


                        <!--Slides-->
                        <div class="owl-carousel country-carousel owl-theme" id="owlCarousel3">
                            <?php $__currentLoopData = $celebrityInfo; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $celebrity): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="card item margin-top-40">
                                    <a href="<?php echo e(url('/video?type=celebrity&celebrity_id=' . $celebrity->id)); ?>">
                                        <div class="country-slider">
                                            <div class="img">
                                                <?php if($celebrity->file_type == 'link'): ?>
                                                    <img src="<?php echo e($celebrity->file_link); ?>" alt="<?php echo e($celebrity->name); ?>"
                                                        title="<?php echo e($celebrity->name); ?>" />
                                                <?php else: ?>
                                                    <?php if(!empty($celebrity->image)): ?>
                                                        <img src="<?php echo e(URL::to('/')); ?>/uploads/celebrity/<?php echo e($celebrity->image); ?>"
                                                            alt="<?php echo e($celebrity->name); ?>" title="<?php echo e($celebrity->name); ?>" />
                                                    <?php else: ?>
                                                        <img src="<?php echo e(URL::to('/')); ?>/uploads/no.jpeg" alt="" />
                                                    <?php endif; ?>
                                                <?php endif; ?>
                                            </div>
                                            <div class="name margin-top-10"><?php echo e($celebrity->name); ?></div>
                                        </div>
                                    </a>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>

                        <div class="collapse" id="collapseExample3">
                            <div class="">
                                <?php $__currentLoopData = $celebrityInfo; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $celebrity): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="heading-img">
                                        <a href="<?php echo e(url('/video?type=celebrity&celebrity_id=' . $celebrity->id)); ?>">
                                            <div class="country-slider">
                                                <div class="img">
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
                                                            <img src="<?php echo e(URL::to('/')); ?>/uploads/no.jpeg"
                                                                alt="" />
                                                        <?php endif; ?>
                                                    <?php endif; ?>
                                                </div>
                                                <div class="name margin-top-10"><?php echo e($celebrity->name); ?></div>
                                            </div>
                                        </a>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                        <!--/.Slides-->
                    </div>
                <?php endif; ?>
                

                
                
                

                
                <?php if(!$tvInfo->isEmpty()): ?>
                    <div class="single-section">
                        <div class="heding">
                            <h3>Live TV</h3>
                        </div>


                        <!--Slides-->
                        <div class="owl-carousel country-carousel owl-theme" id="owlCarousel4">
                            <?php $__currentLoopData = $tvInfo; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tv): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="card item margin-top-40">
                                    <a href="<?php echo e(url('/live-tv/' . $tv->id)); ?>">
                                        <div class="country-slider-new">
                                            <div class="img">
                                                <?php if($tv->file_type == 'link'): ?>
                                                    <img src="<?php echo e($tv->file_link); ?>" alt="<?php echo e($tv->name); ?>"
                                                        title="<?php echo e($tv->name); ?>" />
                                                <?php else: ?>
                                                    <?php if(!empty($tv->image)): ?>
                                                        <img src="<?php echo e(URL::to('/')); ?>/uploads/tv/<?php echo e($tv->image); ?>"
                                                            alt="<?php echo e($tv->name); ?>" title="<?php echo e($tv->name); ?>" />
                                                    <?php else: ?>
                                                        <img src="<?php echo e(URL::to('/')); ?>/uploads/no.jpeg" alt="" />
                                                    <?php endif; ?>
                                                <?php endif; ?>
                                            </div>
                                            <div class="name margin-top-10"><?php echo e($tv->name); ?></div>
                                        </div>
                                    </a>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>

                        
                        <!--/.Slides-->
                    </div>
                <?php endif; ?>
            </div>


        </div>



        </div>
    </section><!-- video section end -->


<?php $__env->stopSection(); ?>
<?php $__env->startPush('custom-js'); ?>
    <script>
        $('.country-carousel').owlCarousel({
            items: 8,
            loop: true,
            autoplay: true,
            responsiveClass: true,
            margin: 20,
            nav: true,
            // dots: false,
            navText: ["<div class='nav-btn prev-slide'></div>", "<div class='nav-btn next-slide'></div>"],
            responsive: {
                0: {
                    items: 3
                },
                600: {
                    items: 6
                },
                1000: {
                    items: 8
                }
            }
        });

        $('.genre-carousel').owlCarousel({
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
                    items: 2
                },
                600: {
                    items: 3
                },
                1000: {
                    items: 4
                }
            }
        });

        $('#collapseExample').on('shown.bs.collapse', function() {
            $("#owlCarousel").addClass("display-none");
        });
        $('#collapseExample').on('hidden.bs.collapse', function() {
            $("#owlCarousel").removeClass("display-none");
        });

        $('#collapseExample3').on('shown.bs.collapse', function() {
            $("#owlCarousel3").addClass("display-none");
        });
        $('#collapseExample3').on('hidden.bs.collapse', function() {
            $("#owlCarousel3").removeClass("display-none");
        });


        $('#collapseExample6').on('shown.bs.collapse', function() {
            $("#owlCarousel6").addClass("display-none");
        });
        $('#collapseExample6').on('hidden.bs.collapse', function() {
            $("#owlCarousel6").removeClass("display-none");
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('frontend.layouts.client.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ccninfot/movieflix.ccninfotech.com/resources/views/frontend/client/category.blade.php ENDPATH**/ ?>