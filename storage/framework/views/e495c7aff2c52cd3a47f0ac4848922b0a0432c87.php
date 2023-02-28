<?php echo $__env->make('layouts.default.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<body>
    <div class="full-body">
        <div class="container-fluid">
            <div class="row">
                <?php echo $__env->make('layouts.default.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <div class="main-body  col-md-10  col-sm-12 col-12">
                    <?php echo $__env->make('layouts.default.topNavbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <div class="content-body">
                        <?php echo $__env->yieldContent('data_count'); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="loading-spinner display-none-important">
        <div class="sk-folding-cube">
            <div class="sk-cube1 sk-cube"></div>
            <div class="sk-cube2 sk-cube"></div>
            <div class="sk-cube4 sk-cube"></div>
            <div class="sk-cube3 sk-cube"></div>
        </div>
    </div>
    <?php echo $__env->make('layouts.default.footerScript', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</body>
</html>

<?php /**PATH /home/projectx/Desktop/laravelProjects/movieflix-main/resources/views/layouts/default/master.blade.php ENDPATH**/ ?>