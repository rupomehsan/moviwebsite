<?php $__env->startSection('data_count'); ?>
    
    
    <!-- <img src="<?php echo e(asset('img/Hello.png')); ?>" alt="Hello"> -->
    <h4 class="margin-top-20">
        <span class="bold">Welcome</span> <span class="bold red">Onboard</span>
    </h4>
    <div class=" margin-top-20">
        <span class="red">User Overview</span>
        <div class="line margin-top-10"></div>
    </div>
    

    <div class="row">
        <div class="col-md-7 col-sm-12 col-12 margin-top-20">
            
            <div class="menu-carts">
                <div class="row">
                    

                    <div class="col-md-3 col-sm-6 col-12">
                        <a href="/admin/category">
                            <div class="cart">
                                <div class="row">
                                    <div class="col-md-9">
                                        <h4 class="bold"><?php echo e($totalCategory ?? '0'); ?></h4>
                                        <span class="cart-title">Category</span>
                                    </div>
                                    <div class="col-md-3">
                                        <span class="iconify" data-icon="ic:outline-category"></span>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="col-md-3 col-sm-6 col-12">
                        <a href="/admin/video">
                            <div class="cart">
                                <div class="row">
                                    <div class="col-md-9">
                                        <h4 class="bold"><?php echo e($totalVideo ?? '0'); ?></h4>
                                        <span class="cart-title">Total Video</span>
                                    </div>
                                    <div class="col-md-3">
                                        <span class="iconify" data-icon="ic:baseline-video-library"></span>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-3 col-sm-6 col-12">
                        <a href="/admin/user">
                            <div class="cart">
                                <div class="row">
                                    <div class="col-md-9">
                                        <h4 class="bold"><?php echo e($totalUser ?? '0'); ?></h4>
                                        <span class="cart-title">Total User</span>
                                    </div>
                                    <div class="col-md-3">
                                        <span class="iconify" data-icon="ph:users-four"></span>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-3 col-sm-6 col-12">
                        <div class="cart">
                            <div class="row">
                                <div class="col-md-9">
                                    <h4 class="bold"><?php echo e($totalVideoView ?? '0'); ?></h4>
                                    <span class="cart-title">Total View</span>
                                </div>
                                <div class="col-md-3">
                                    <span class="iconify" data-icon="ant-design:eye-filled"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            

            
            <div class="unread-carts margin-top-10">
                <div class="row">

                    <div class="col-md-4 col-sm-6 col-12">
                        <div class="unread-cart">
                            <div class="row">
                                <a href="/admin/report" style="padding:0;">
                                    <div class="text-center" style="padding:0;">
                                        <span class="unread-title">Unread Report</span>
                                        <p class="unread-number background-red"><?php echo e($unreadReport ?? '0'); ?></p>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            
        </div>
        <div class="col-md-5 col-sm-12 col-12 margin-top-20">
            
            <div class="right-cart">
                <div class="right-cart-top">
                    <div class="row">
                        <div class="col-md-9 col-sm-7 cl-6">
                            <ul class="">
                                <li class="right-cart-top-day right-cart-top-active">
                                    <button class="right-day-button" type="button">Last Day</button>
                                </li>
                                <li class="right-cart-top-week">
                                    <button class="right-week-button" type="button">Last Week</button>
                                </li>
                                
                            </ul>
                        </div>
                        <div class="col-md-3 col-sm-5 cl-6">
                            <select name="" id="cartYearSelect" class="">
                                <?php if(!empty($dateList)): ?>
                                    <?php $__currentLoopData = $dateList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value => $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($value); ?>"><?php echo e($data); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                            </select>
                        </div>
                    </div>



                </div>
                <div class="right-cart-body">
                    <div class="row">
                        <div class="col-md-3 border-left-purple">
                            <h5 class="bold day-view"><?php echo e($lastDayVideoView ?? '0'); ?></h5>
                            <h5 class="bold week-view display-none"><?php echo e($lastWeekVideoView ?? '0'); ?></h5>
                            <h5 class="bold month-view display-none"><?php echo e($lastMonthVideoView ?? '0'); ?></h5>
                            <h5 class="bold yearly-view display-none yearly-video"></h5>
                            <span class="cart-title">Total View</span>
                        </div>
                        <div class="col-md-3 border-left-green">
                            <h5 class="bold day-view"><?php echo e($lastDayComment ?? '0'); ?></h5>
                            <h5 class="bold week-view display-none"><?php echo e($lastWeekComment ?? '0'); ?></h5>
                            <h5 class="bold month-view display-none"><?php echo e($lastMonthComment ?? '0'); ?></h5>
                            <h5 class="bold yearly-view display-none yearly-comment"></h5>
                            <span class="cart-title">Total Comment</span>
                        </div>
                        <div class="col-md-3 border-left-orange">
                            <h5 class="bold day-view"><?php echo e($lastDayReport ?? '0'); ?></h5>
                            <h5 class="bold week-view display-none"><?php echo e($lastWeekReport ?? '0'); ?></h5>
                            <h5 class="bold month-view display-none"><?php echo e($lastMonthReport ?? '0'); ?></h5>
                            <h5 class="bold yearly-view display-none yearly-report"></h5>
                            <span class="cart-title">Total Report</span>
                        </div>
                        
                    </div>
                </div>
            </div>
            

            
            <div class="top-category-cart margin-top-20">
                <span class="category-cart-title bold">Top Categories</span>
                <div class="title-line"></div>
                <div class="row">
                    <?php if(!$categoryList->isEmpty()): ?>
                        <?php $__currentLoopData = $categoryList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="col-md-4 margin-top-20">
                                <div class="category-cart-content ">
                                    <div class="row ">
                                        <div class="col-md-4 category-cart-content-icon">

                                            <?php if(!empty($category->image)): ?>
                                                <img src="<?php echo e(URL::to('/')); ?>/uploads/category/<?php echo e($category->image); ?>"
                                                    alt="<?php echo e($category->name); ?>" title="<?php echo e($category->name); ?>" />
                                            <?php else: ?>
                                                <img src="<?php echo e(URL::to('/')); ?>/uploads/no.jpeg" alt="" />
                                            <?php endif; ?>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="text-center">
                                                <span class="category-cart-content-title"><?php echo e($category->name); ?></span>
                                            </div>
                                            <?php if(!empty($categoryPercentage[$category->id])): ?>
                                                <?php
                                                $color = 'green';
                                                if ($categoryPercentage[$category->id]['type'] != 'increase') {
                                                    $color = 'red';
                                                }
                                                ?>
                                                <div class="category-cart-content-number <?php echo e($color); ?> text-center">
                                                    <?php if($categoryPercentage[$category->id]['type'] == 'increase'): ?>
                                                        <span class="iconify" data-icon="oi:caret-top"></span> +
                                                    <?php else: ?>
                                                        <span class="iconify" data-icon="oi:caret-top"
                                                            data-rotate="180deg"></span>
                                                    <?php endif; ?>
                                                    <?php echo e(number_format($categoryPercentage[$category->id]['percentage'], 2, '.', '')); ?>

                                                    %
                                                </div>
                                            <?php endif; ?>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>

                </div>

                
                
                
            </div>
            
        </div>
        <div class="col-md-7 col-sm-12 col-12">
            
            <div class="top-category-cart margin-top-40">
                <span class="category-cart-title bold">Recent Subscriber</span>
                <div class="title-line"></div>
                <div class="row margin-top-40">
                    <div style="overflow-x:auto;">
                        <table class="table">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col" class="text-center">Name</th>
                                    <th scope="col" class="text-center">Email</th>
                                    <th scope="col" class="text-center">Package Name</th>
                                    <th scope="col" class="text-center">Subscribed At</th>
                                    <th scope="col" class="text-center">Expierd Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(!$recentSubscriber->isEmpty()): ?>
                                    <?php $__currentLoopData = $recentSubscriber; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td class="text-center"><?php echo e($data->user_name); ?></td>
                                            <td class="text-center"><?php echo e($data->user_email); ?></td>
                                            <td class="text-center"><?php echo e($data->package_name); ?></td>
                                            <td class="text-center">
                                                <?php echo e(\Carbon\Carbon::parse($data->start_date)->format('d F Y')); ?></td>
                                            <td class="text-center">
                                                <?php echo e(\Carbon\Carbon::parse($data->end_date)->format('d F Y')); ?></td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            
        </div>
        <div class="col-md-5 col-sm-12 col-12">
            
            <div class="top-category-cart margin-top-40">
                <span class="category-cart-title bold">Top Videos</span>
                <div class="title-line"></div>
                <div class="row margin-top-40">
                    <div style="overflow-x:auto;">
                        <table class="table">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col" class="text-center">SERIAL</th>
                                    <th scope="col" class="text-center">Video Title</th>
                                    <th scope="col" class="text-center">Release Date</th>
                                    <th scope="col" class="text-center">Total View</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php $sl = 1; ?>
                                <?php if(!$populerVideoInfo->isEmpty()): ?>
                                    <?php $__currentLoopData = $populerVideoInfo; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <th class="text-center" scope="row"><?php echo e($sl++); ?></th>
                                            <td class="text-center"><?php echo e($data->title); ?></td>
                                            <td class="text-center"><?php echo e($data->year); ?></td>
                                            <td class="text-center"><?php echo e($populerVideoCount[$data->id]); ?></td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('custom-js'); ?>
    <script type="text/javascript">
        $(function() {
            $(document).on("click", ".right-day-button", function() {
                $(".right-cart-top-month").removeClass('right-cart-top-active');
                $(".right-cart-top-week").removeClass('right-cart-top-active');
                $(".right-cart-top-day").addClass('right-cart-top-active');

                $(".day-view").removeClass('display-none');
                $(".week-view").addClass('display-none');
                $(".month-view").addClass('display-none');
                $(".yearly-view").addClass('display-none');
            });
            $(document).on("click", ".right-week-button", function() {
                $(".right-cart-top-day").removeClass('right-cart-top-active');
                $(".right-cart-top-month").removeClass('right-cart-top-active');
                $(".right-cart-top-week").addClass('right-cart-top-active');

                $(".day-view").addClass('display-none');
                $(".week-view").removeClass('display-none');
                $(".month-view").addClass('display-none');
                $(".yearly-view").addClass('display-none');
            });
            $(document).on("click", ".right-month-button", function() {
                $(".right-cart-top-day").removeClass('right-cart-top-active');
                $(".right-cart-top-week").removeClass('right-cart-top-active');
                $(".right-cart-top-month").addClass('right-cart-top-active');

                $(".day-view").addClass('display-none');
                $(".week-view").addClass('display-none');
                $(".month-view").removeClass('display-none');
                $(".yearly-view").addClass('display-none');
            });

            $(document).on("change", "#cartYearSelect", function(e) {
                e.preventDefault();
                var year = $("#cartYearSelect").val();

                $('.loading-spinner').css("display", "flex");
                $.ajax({
                    url: window.origin + '/admin/dashboard/get-yearly-data',
                    type: "POST",
                    dataType: "json",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        year: year,
                    },
                    complete: function() {
                        $('.loading-spinner').css("display", "none");
                    },
                    success: function(res) {
                        $(".yearly-video").html(res.yearlyVideoView);
                        $(".yearly-comment").html(res.yearlyComment);
                        $(".yearly-report").html(res.yearlyReport);

                        $(".day-view").addClass('display-none');
                        $(".week-view").addClass('display-none');
                        $(".month-view").addClass('display-none');
                        $(".yearly-view").removeClass('display-none');
                    },
                    error: function(jqXhr, ajaxOptions, thrownError) {
                        $('.loading-spinner').css("display", "none");
                    }
                }); //ajax
            });
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.default.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ccninfot/movieflix.ccninfotech.com/resources/views/dashboard.blade.php ENDPATH**/ ?>