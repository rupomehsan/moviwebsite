<?php $__env->startSection('data_count'); ?>
    
    <div class="content-heading">
        <div class="row">
            
            <div class="col-md-8 content-title">
                <span class="title">Manage Ad</span>
                <div class="title-line"></div>
                <!-- Button trigger modal -->
            </div>
            
        </div>
    </div>
    

    
    
    
    <div class="margin-top-20 action-buttons">

        <a class="single-action" href="/admin/advertisement">
            <span class="iconify" data-icon="bi:plus-circle-fill"></span> &nbsp; Add For Mobile
        </a>

        <a class="single-action" href="/admin/advertisement/web-ad">
            <span class="iconify" data-icon="bi:plus-circle-fill"></span> &nbsp; Add For Web
        </a>
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

    <div class="row margin-top-40">
        <div id="accordion">
            <form id="mobileAdForm" method="POST" enctype="multipart/form-data"
                action="<?php echo e(URL::to('admin/advertisement/webAdUpdate')); ?>">
                <?php echo csrf_field(); ?>
                
                <?php if(!$target->isEmpty()): ?>
                    <?php $__currentLoopData = $target; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($data->ad_type == 'header'): ?>
                            <div class="card">
                                <div class="card-header" id="headingheader">
                                    <h5 class="mb-0">
                                        <button type="button" class="btn btn-link" data-toggle="collapse"
                                            data-target="#headerAd" aria-expanded="true" aria-controls="headerAd">
                                            Header Ad
                                        </button>
                                    </h5>
                                </div>


                                <div id="headerAd" class="collapse" aria-labelledby="headingheader"
                                    data-parent="#accordion">
                                    <div class="card-body">
                                        <div class="row margin-top-20">

                                            <input type="hidden" name="ad_type[]" value="header">

                                            <div class="col-md-3">
                                                <span class="bold"> Your Header Ad</span> <br /><br />
                                                <span>Paste your ad code here. Google AdSense will be made responsive
                                                    automatically.</span>
                                            </div>
                                            <div class="offset-1 col-md-8">
                                                <textarea name="add_link[header]" class="add-link-input" cols="85"
                                                    rows="10"><?php echo e($data->ad_link); ?></textarea>
                                            </div>
                                        </div>
                                        <div class="row margin-top-10">
                                            <div class="col-md-3">
                                                <span class="bold"> Ad Title :</span> <br /><br />
                                                <span>A title for the Ad, like - Advertisement - if you leave it blank the
                                                    ad spot will
                                                    not
                                                    have a title.</span>
                                            </div>
                                            <div class="offset-1 col-md-8">
                                                <input type="text" name="add_title[header]" class="add-link-input"
                                                    value="<?php echo e($data->ad_title); ?>">
                                            </div>
                                        </div>
                                        <div class="row margin-top-40">
                                            <div class="col-md-12">
                                                <span class="bold"> ADVANCE USASE:</span> <br /><br />
                                                <span>If you leave the AdSense size boxes on Auto, the theme will
                                                    automatically resize
                                                    the
                                                    Google Ads.</span>
                                            </div>

                                            <div class="col-md-6 margin-top-40">
                                                <div class="form-check form-switch">
                                                    <div class="row">
                                                        <div class="col-md-8">
                                                            <label class="form-check-label bold"
                                                                for="disableDesktopHeader">DISABLE ON
                                                                DESKTOP</label>
                                                        </div>

                                                        <div class="col-md-4">
                                                            <input class="form-check-input" data-class="featured"
                                                                name="disable_desktop[header]" type="checkbox"
                                                                id="disableDesktopHeader" <?php echo $data->disable_desktop == 'on' ? 'checked' : ''; ?>>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-6 margin-top-40">
                                                <div class="form-check form-switch">
                                                    <div class="row">
                                                        <div class="col-md-4 text-right">
                                                            <label class="form-check-label" for="">Adsense Size</label>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <select name="desktop_adsense[header]" class="adsense-select">
                                                                <option value="0">Select a size</option>

                                                                <?php if(!empty($adsenseSizeArr)): ?>
                                                                    <?php $__currentLoopData = $adsenseSizeArr; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $size): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                        <?php
                                                                        $selected = '';
                                                                        if ($data->desktop_adsense == $size) {
                                                                            $selected = 'selected';
                                                                        }
                                                                        ?>
                                                                        <option <?php echo e($selected); ?>><?php echo e($size); ?>

                                                                        </option>
                                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                <?php endif; ?>

                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6 margin-top-20">
                                                <div class="form-check form-switch">
                                                    <div class="row">
                                                        <div class="col-md-8">
                                                            <label class="form-check-label bold"
                                                                for="disableTabletLandscapeHeader">DISABLE ON
                                                                TABLET LANDSCAPE</label>
                                                        </div>

                                                        <div class="col-md-4">
                                                            <input class="form-check-input" data-class="featured"
                                                                name="disable_tablet_landscape[header]" type="checkbox"
                                                                id="disableTabletLandscapeHeader" <?php echo $data->disable_tablet_landscape == 'on' ? 'checked' : ''; ?>>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 margin-top-20">
                                                <div class="form-check form-switch">
                                                    <div class="row">
                                                        <div class="col-md-4 text-right">
                                                            <label class="form-check-label" for="">Adsense Size</label>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <select name="tablet_landscape_adsense[header]"
                                                                class="adsense-select">
                                                                <option value="0">Select a size</option>

                                                                <?php if(!empty($adsenseSizeArr)): ?>
                                                                    <?php $__currentLoopData = $adsenseSizeArr; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $size): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                        <?php
                                                                        $selected = '';
                                                                        if ($data->tablet_landscape_adsense == $size) {
                                                                            $selected = 'selected';
                                                                        }
                                                                        ?>
                                                                        <option <?php echo e($selected); ?>><?php echo e($size); ?>

                                                                        </option>
                                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                <?php endif; ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6 margin-top-20">
                                                <div class="form-check form-switch">
                                                    <div class="row">
                                                        <div class="col-md-8">
                                                            <label class="form-check-label bold"
                                                                for="disableTabletPortraitHeader">DISABLE ON
                                                                TABLET PORTRAIT</label>
                                                        </div>

                                                        <div class="col-md-4">
                                                            <input class="form-check-input" data-class="featured"
                                                                name="disable_tablet_portrait[header]" type="checkbox"
                                                                id="disableTabletPortraitHeader" <?php echo $data->disable_tablet_portrait == 'on' ? 'checked' : ''; ?>>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 margin-top-20">
                                                <div class="form-check form-switch">
                                                    <div class="row">
                                                        <div class="col-md-4 text-right">
                                                            <label class="form-check-label" for="">Adsense Size</label>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <select name="tablet_portrait_adsense[header]"
                                                                class="adsense-select">
                                                                <option value="0">Select a size</option>

                                                                <?php if(!empty($adsenseSizeArr)): ?>
                                                                    <?php $__currentLoopData = $adsenseSizeArr; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $size): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                        <?php
                                                                        $selected = '';
                                                                        if ($data->tablet_portrait_adsense == $size) {
                                                                            $selected = 'selected';
                                                                        }
                                                                        ?>
                                                                        <option <?php echo e($selected); ?>><?php echo e($size); ?>

                                                                        </option>
                                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                <?php endif; ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6 margin-top-20">
                                                <div class="form-check form-switch">
                                                    <div class="row">
                                                        <div class="col-md-8">
                                                            <label class="form-check-label bold"
                                                                for="disablePhoneHeader">DISABLE ON
                                                                PHONE</label>
                                                        </div>

                                                        <div class="col-md-4">
                                                            <input class="form-check-input" data-class="featured"
                                                                name="disable_phone[header]" type="checkbox"
                                                                id="disablePhoneHeader" <?php echo $data->disable_phone == 'on' ? 'checked' : ''; ?>>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 margin-top-20">
                                                <div class="form-check form-switch">
                                                    <div class="row">
                                                        <div class="col-md-4 text-right">
                                                            <label class="form-check-label" for="">Adsense Size</label>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <select name="phone_adsense[header]" class="adsense-select">
                                                                <option value="0">Select a size</option>

                                                                <?php if(!empty($adsenseSizeArr)): ?>
                                                                    <?php $__currentLoopData = $adsenseSizeArr; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $size): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                        <?php
                                                                        $selected = '';
                                                                        if ($data->phone_adsense == $size) {
                                                                            $selected = 'selected';
                                                                        }
                                                                        ?>
                                                                        <option <?php echo e($selected); ?>><?php echo e($size); ?>

                                                                        </option>
                                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                <?php endif; ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php else: ?>
                    <div class="card">
                        <div class="card-header" id="headingheader">
                            <h5 class="mb-0">
                                <button type="button" class="btn btn-link" data-toggle="collapse" data-target="#headerAd"
                                    aria-expanded="true" aria-controls="headerAd">
                                    Header Ad
                                </button>
                            </h5>
                        </div>


                        <div id="headerAd" class="collapse" aria-labelledby="headingheader" data-parent="#accordion">
                            <div class="card-body">
                                <div class="row margin-top-20">

                                    <input type="hidden" name="ad_type[]" value="header">

                                    <div class="col-md-3">
                                        <span class="bold"> Your Header Ad</span> <br /><br />
                                        <span>Paste your ad code here. Google AdSense will be made responsive
                                            automatically.</span>
                                    </div>
                                    <div class="offset-1 col-md-8">
                                        <textarea name="add_link[header]" class="add-link-input" cols="85"
                                            rows="10"></textarea>
                                    </div>
                                </div>
                                <div class="row margin-top-10">
                                    <div class="col-md-3">
                                        <span class="bold"> Ad Title :</span> <br /><br />
                                        <span>A title for the Ad, like - Advertisement - if you leave it blank the ad spot
                                            will
                                            not
                                            have a title.</span>
                                    </div>
                                    <div class="offset-1 col-md-8">
                                        <input type="text" name="add_title[header]" class="add-link-input">
                                    </div>
                                </div>
                                <div class="row margin-top-40">
                                    <div class="col-md-12">
                                        <span class="bold"> ADVANCE USASE:</span> <br /><br />
                                        <span>If you leave the AdSense size boxes on Auto, the theme will automatically
                                            resize
                                            the
                                            Google Ads.</span>
                                    </div>

                                    <div class="col-md-6 margin-top-40">
                                        <div class="form-check form-switch">
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <label class="form-check-label bold" for="disableDesktopHeader">DISABLE
                                                        ON
                                                        DESKTOP</label>
                                                </div>

                                                <div class="col-md-4">
                                                    <input class="form-check-input" data-class="featured"
                                                        name="disable_desktop[header]" type="checkbox"
                                                        id="disableDesktopHeader">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 margin-top-40">
                                        <div class="form-check form-switch">
                                            <div class="row">
                                                <div class="col-md-4 text-right">
                                                    <label class="form-check-label" for="">Adsense Size</label>
                                                </div>

                                                <div class="col-md-6">
                                                    <select name="desktop_adsense[header]" class="adsense-select">
                                                        <option value="0">Select a size</option>
                                                        <?php if(!empty($adsenseSizeArr)): ?>
                                                            <?php $__currentLoopData = $adsenseSizeArr; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $size): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <option><?php echo e($size); ?></option>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        <?php endif; ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6 margin-top-20">
                                        <div class="form-check form-switch">
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <label class="form-check-label bold"
                                                        for="disableTabletLandscapeHeader">DISABLE ON
                                                        TABLET LANDSCAPE</label>
                                                </div>

                                                <div class="col-md-4">
                                                    <input class="form-check-input" data-class="featured"
                                                        name="disable_tablet_landscape[header]" type="checkbox"
                                                        id="disableTabletLandscapeHeader">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 margin-top-20">
                                        <div class="form-check form-switch">
                                            <div class="row">
                                                <div class="col-md-4 text-right">
                                                    <label class="form-check-label" for="">Adsense Size</label>
                                                </div>

                                                <div class="col-md-6">
                                                    <select name="tablet_landscape_adsense[header]" class="adsense-select">
                                                        <option value="0">Select a size</option>
                                                        <?php if(!empty($adsenseSizeArr)): ?>
                                                            <?php $__currentLoopData = $adsenseSizeArr; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $size): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <option><?php echo e($size); ?></option>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        <?php endif; ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6 margin-top-20">
                                        <div class="form-check form-switch">
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <label class="form-check-label bold"
                                                        for="disableTabletPortraitHeader">DISABLE ON
                                                        TABLET PORTRAIT</label>
                                                </div>

                                                <div class="col-md-4">
                                                    <input class="form-check-input" data-class="featured"
                                                        name="disable_tablet_portrait[header]" type="checkbox"
                                                        id="disableTabletPortraitHeader">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 margin-top-20">
                                        <div class="form-check form-switch">
                                            <div class="row">
                                                <div class="col-md-4 text-right">
                                                    <label class="form-check-label" for="">Adsense Size</label>
                                                </div>

                                                <div class="col-md-6">
                                                    <select name="tablet_portrait_adsense[header]" class="adsense-select">
                                                        <option value="0">Select a size</option>
                                                        <?php if(!empty($adsenseSizeArr)): ?>
                                                            <?php $__currentLoopData = $adsenseSizeArr; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $size): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <option><?php echo e($size); ?></option>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        <?php endif; ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6 margin-top-20">
                                        <div class="form-check form-switch">
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <label class="form-check-label bold" for="disablePhoneHeader">DISABLE
                                                        ON
                                                        PHONE</label>
                                                </div>

                                                <div class="col-md-4">
                                                    <input class="form-check-input" data-class="featured"
                                                        name="disable_phone[header]" type="checkbox"
                                                        id="disablePhoneHeader">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 margin-top-20">
                                        <div class="form-check form-switch">
                                            <div class="row">
                                                <div class="col-md-4 text-right">
                                                    <label class="form-check-label" for="">Adsense Size</label>
                                                </div>

                                                <div class="col-md-6">
                                                    <select name="phone_adsense[header]" class="adsense-select">
                                                        <option value="0">Select a size</option>
                                                        <?php if(!empty($adsenseSizeArr)): ?>
                                                            <?php $__currentLoopData = $adsenseSizeArr; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $size): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <option><?php echo e($size); ?></option>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        <?php endif; ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
                

                
                <?php if(!$target->isEmpty()): ?>
                    <?php $__currentLoopData = $target; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($data->ad_type == 'after_category'): ?>
                            <div class="card margin-top-20">
                                <div class="card-header" id="headingAfterCategory">
                                    <h5 class="mb-0">
                                        <button type="button" class="btn btn-link collapsed" data-toggle="collapse"
                                            data-target="#afterCategoryAd" aria-expanded="false"
                                            aria-controls="afterCategoryAd">
                                            After Category Ad
                                        </button>
                                    </h5>
                                </div>
                                <div id="afterCategoryAd" class="collapse" aria-labelledby="headingAfterCategory"
                                    data-parent="#accordion">
                                    <div class="card-body">
                                        <div class="row margin-top-20">
                                            <input type="hidden" name="ad_type[]" value="after_category">

                                            <div class="col-md-3">
                                                <span class="bold"> Your After Category Ad</span> <br /><br />
                                                <span>Paste your ad code here. Google AdSense will be made responsive
                                                    automatically.</span>
                                            </div>
                                            <div class="offset-1 col-md-8">
                                                <textarea name="add_link[after_category]" class="add-link-input" cols="85"
                                                    rows="10"><?php echo e($data->ad_link); ?></textarea>
                                            </div>
                                        </div>
                                        <div class="row margin-top-10">
                                            <div class="col-md-3">
                                                <span class="bold"> Ad Title :</span> <br /><br />
                                                <span>A title for the Ad, like - Advertisement - if you leave it blank the
                                                    ad spot will
                                                    not
                                                    have a title.</span>
                                            </div>
                                            <div class="offset-1 col-md-8">
                                                <input type="text" name="add_title[after_category]" class="add-link-input"
                                                    value="<?php echo e($data->ad_title); ?>">
                                            </div>
                                        </div>
                                        <div class="row margin-top-20">
                                            <div class="col-md-3">
                                                <span class="bold"> Show Add (Per Category) :</span>
                                            </div>
                                            <div class="offset-1 col-md-8">
                                                <input type="number" name="show_per_video_category[after_category]"
                                                    class="add-link-input" value="<?php echo e($data->show_per_video_category); ?>">
                                            </div>
                                        </div>
                                        <div class="row margin-top-40">
                                            <div class="col-md-12">
                                                <span class="bold"> ADVANCE USASE:</span> <br /><br />
                                                <span>If you leave the AdSense size boxes on Auto, the theme will
                                                    automatically resize
                                                    the
                                                    Google Ads.</span>
                                            </div>

                                            <div class="col-md-6 margin-top-40">
                                                <div class="form-check form-switch">
                                                    <div class="row">
                                                        <div class="col-md-8">
                                                            <label class="form-check-label bold"
                                                                for="disableDesktopAfterCategory">DISABLE ON
                                                                DESKTOP</label>
                                                        </div>

                                                        <div class="col-md-4">
                                                            <input class="form-check-input" data-class="featured"
                                                                name="disable_desktop[after_category]" type="checkbox"
                                                                id="disableDesktopAfterCategory" <?php echo $data->disable_desktop == 'on' ? 'checked' : ''; ?>>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 margin-top-40">
                                                <div class="form-check form-switch">
                                                    <div class="row">
                                                        <div class="col-md-4 text-right">
                                                            <label class="form-check-label" for="">Adsense Size</label>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <select name="desktop_adsense[after_category]"
                                                                class="adsense-select">
                                                                <option value="0">Select a size</option>

                                                                <?php if(!empty($adsenseSizeArr)): ?>
                                                                    <?php $__currentLoopData = $adsenseSizeArr; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $size): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                        <?php
                                                                        $selected = '';
                                                                        if ($data->desktop_adsense == $size) {
                                                                            $selected = 'selected';
                                                                        }
                                                                        ?>
                                                                        <option <?php echo e($selected); ?>><?php echo e($size); ?>

                                                                        </option>
                                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                <?php endif; ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6 margin-top-20">
                                                <div class="form-check form-switch">
                                                    <div class="row">
                                                        <div class="col-md-8">
                                                            <label class="form-check-label bold"
                                                                for="disableTabletLandscapeAfterCategory">DISABLE ON
                                                                TABLET LANDSCAPE</label>
                                                        </div>

                                                        <div class="col-md-4">
                                                            <input class="form-check-input" data-class="featured"
                                                                name="disable_tablet_landscape[after_category]"
                                                                type="checkbox" id="disableTabletLandscapeAfterCategory"
                                                                <?php echo $data->disable_tablet_landscape == 'on' ? 'checked' : ''; ?>>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 margin-top-20">
                                                <div class="form-check form-switch">
                                                    <div class="row">
                                                        <div class="col-md-4 text-right">
                                                            <label class="form-check-label" for="">Adsense Size</label>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <select name="tablet_landscape_adsense[after_category]"
                                                                class="adsense-select">
                                                                <option value="0">Select a size</option>

                                                                <?php if(!empty($adsenseSizeArr)): ?>
                                                                    <?php $__currentLoopData = $adsenseSizeArr; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $size): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                        <?php
                                                                        $selected = '';
                                                                        if ($data->tablet_landscape_adsense == $size) {
                                                                            $selected = 'selected';
                                                                        }
                                                                        ?>
                                                                        <option <?php echo e($selected); ?>><?php echo e($size); ?>

                                                                        </option>
                                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                <?php endif; ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6 margin-top-20">
                                                <div class="form-check form-switch">
                                                    <div class="row">
                                                        <div class="col-md-8">
                                                            <label class="form-check-label bold"
                                                                for="disableTabletPortraitAfterCategory">DISABLE ON
                                                                TABLET PORTRAIT</label>
                                                        </div>

                                                        <div class="col-md-4">
                                                            <input class="form-check-input" data-class="featured"
                                                                name="disable_tablet_portrait[after_category]"
                                                                type="checkbox" id="disableTabletPortraitAfterCategory"
                                                                <?php echo $data->disable_tablet_portrait == 'on' ? 'checked' : ''; ?>>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 margin-top-20">
                                                <div class="form-check form-switch">
                                                    <div class="row">
                                                        <div class="col-md-4 text-right">
                                                            <label class="form-check-label" for="">Adsense Size</label>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <select name="tablet_portrait_adsense[after_category]"
                                                                class="adsense-select">
                                                                <option value="0">Select a size</option>

                                                                <?php if(!empty($adsenseSizeArr)): ?>
                                                                    <?php $__currentLoopData = $adsenseSizeArr; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $size): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                        <?php
                                                                        $selected = '';
                                                                        if ($data->tablet_portrait_adsense == $size) {
                                                                            $selected = 'selected';
                                                                        }
                                                                        ?>
                                                                        <option <?php echo e($selected); ?>><?php echo e($size); ?>

                                                                        </option>
                                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                <?php endif; ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6 margin-top-20">
                                                <div class="form-check form-switch">
                                                    <div class="row">
                                                        <div class="col-md-8">
                                                            <label class="form-check-label bold"
                                                                for="disablePhoneAfterCategory">DISABLE ON
                                                                PHONE</label>
                                                        </div>

                                                        <div class="col-md-4">
                                                            <input class="form-check-input" data-class="featured"
                                                                name="disable_phone[after_category]" type="checkbox"
                                                                id="disablePhoneAfterCategory" <?php echo $data->disable_phone == 'on' ? 'checked' : ''; ?>>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 margin-top-20">
                                                <div class="form-check form-switch">
                                                    <div class="row">
                                                        <div class="col-md-4 text-right">
                                                            <label class="form-check-label" for="">Adsense Size</label>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <select name="phone_adsense[after_category]"
                                                                class="adsense-select">
                                                                <option value="0">Select a size</option>

                                                                <?php if(!empty($adsenseSizeArr)): ?>
                                                                    <?php $__currentLoopData = $adsenseSizeArr; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $size): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                        <?php
                                                                        $selected = '';
                                                                        if ($data->phone_adsense == $size) {
                                                                            $selected = 'selected';
                                                                        }
                                                                        ?>
                                                                        <option <?php echo e($selected); ?>><?php echo e($size); ?>

                                                                        </option>
                                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                <?php endif; ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php else: ?>
                    <div class="card margin-top-20">
                        <div class="card-header" id="headingAfterCategory">
                            <h5 class="mb-0">
                                <button type="button" class="btn btn-link collapsed" data-toggle="collapse"
                                    data-target="#afterCategoryAd" aria-expanded="false" aria-controls="afterCategoryAd">
                                    After Category Ad
                                </button>
                            </h5>
                        </div>
                        <div id="afterCategoryAd" class="collapse" aria-labelledby="headingAfterCategory"
                            data-parent="#accordion">
                            <div class="card-body">
                                <div class="row margin-top-20">

                                    <input type="hidden" name="ad_type[]" value="after_category">

                                    <div class="col-md-3">
                                        <span class="bold"> Your After Category Ad</span> <br /><br />
                                        <span>Paste your ad code here. Google AdSense will be made responsive
                                            automatically.</span>
                                    </div>
                                    <div class="offset-1 col-md-8">
                                        <textarea name="add_link[after_category]" class="add-link-input" cols="85"
                                            rows="10"></textarea>
                                    </div>
                                </div>
                                <div class="row margin-top-10">
                                    <div class="col-md-3">
                                        <span class="bold"> Ad Title :</span> <br /><br />
                                        <span>A title for the Ad, like - Advertisement - if you leave it blank the ad spot
                                            will
                                            not
                                            have a title.</span>
                                    </div>
                                    <div class="offset-1 col-md-8">
                                        <input type="text" name="add_title[after_category]" class="add-link-input">
                                    </div>
                                </div>
                                <div class="row margin-top-20">
                                    <div class="col-md-3">
                                        <span class="bold"> Show Add (Per Category) :</span>
                                    </div>
                                    <div class="offset-1 col-md-8">
                                        <input type="number" name="show_per_video_category[after_category]"
                                            class="add-link-input">
                                    </div>
                                </div>
                                <div class="row margin-top-40">
                                    <div class="col-md-12">
                                        <span class="bold"> ADVANCE USASE:</span> <br /><br />
                                        <span>If you leave the AdSense size boxes on Auto, the theme will automatically
                                            resize
                                            the
                                            Google Ads.</span>
                                    </div>

                                    <div class="col-md-6 margin-top-40">
                                        <div class="form-check form-switch">
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <label class="form-check-label bold"
                                                        for="disableDesktopAfterCategory">DISABLE ON
                                                        DESKTOP</label>
                                                </div>

                                                <div class="col-md-4">
                                                    <input class="form-check-input" data-class="featured"
                                                        name="disable_desktop[after_category]" type="checkbox"
                                                        id="disableDesktopAfterCategory">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 margin-top-40">
                                        <div class="form-check form-switch">
                                            <div class="row">
                                                <div class="col-md-4 text-right">
                                                    <label class="form-check-label" for="">Adsense Size</label>
                                                </div>

                                                <div class="col-md-6">
                                                    <select name="desktop_adsense[after_category]" class="adsense-select">
                                                        <option value="0">Select a size</option>
                                                        <?php if(!empty($adsenseSizeArr)): ?>
                                                            <?php $__currentLoopData = $adsenseSizeArr; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $size): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <option><?php echo e($size); ?></option>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        <?php endif; ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6 margin-top-20">
                                        <div class="form-check form-switch">
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <label class="form-check-label bold"
                                                        for="disableTabletLandscapeAfterCategory">DISABLE ON
                                                        TABLET LANDSCAPE</label>
                                                </div>

                                                <div class="col-md-4">
                                                    <input class="form-check-input" data-class="featured"
                                                        name="disable_tablet_landscape[after_category]" type="checkbox"
                                                        id="disableTabletLandscapeAfterCategory">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 margin-top-20">
                                        <div class="form-check form-switch">
                                            <div class="row">
                                                <div class="col-md-4 text-right">
                                                    <label class="form-check-label" for="">Adsense Size</label>
                                                </div>

                                                <div class="col-md-6">
                                                    <select name="tablet_landscape_adsense[after_category]"
                                                        class="adsense-select">
                                                        <option value="0">Select a size</option>
                                                        <?php if(!empty($adsenseSizeArr)): ?>
                                                            <?php $__currentLoopData = $adsenseSizeArr; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $size): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <option><?php echo e($size); ?></option>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        <?php endif; ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6 margin-top-20">
                                        <div class="form-check form-switch">
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <label class="form-check-label bold"
                                                        for="disableTabletPortraitAfterCategory">DISABLE ON
                                                        TABLET PORTRAIT</label>
                                                </div>

                                                <div class="col-md-4">
                                                    <input class="form-check-input" data-class="featured"
                                                        name="disable_tablet_portrait[after_category]" type="checkbox"
                                                        id="disableTabletPortraitAfterCategory">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 margin-top-20">
                                        <div class="form-check form-switch">
                                            <div class="row">
                                                <div class="col-md-4 text-right">
                                                    <label class="form-check-label" for="">Adsense Size</label>
                                                </div>

                                                <div class="col-md-6">
                                                    <select name="tablet_portrait_adsense[after_category]"
                                                        class="adsense-select">
                                                        <option value="0">Select a size</option>
                                                        <?php if(!empty($adsenseSizeArr)): ?>
                                                            <?php $__currentLoopData = $adsenseSizeArr; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $size): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <option><?php echo e($size); ?></option>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        <?php endif; ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6 margin-top-20">
                                        <div class="form-check form-switch">
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <label class="form-check-label bold"
                                                        for="disablePhoneAfterCategory">DISABLE
                                                        ON
                                                        PHONE</label>
                                                </div>

                                                <div class="col-md-4">
                                                    <input class="form-check-input" data-class="featured"
                                                        name="disable_phone[after_category]" type="checkbox"
                                                        id="disablePhoneAfterCategory">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 margin-top-20">
                                        <div class="form-check form-switch">
                                            <div class="row">
                                                <div class="col-md-4 text-right">
                                                    <label class="form-check-label" for="">Adsense Size</label>
                                                </div>

                                                <div class="col-md-6">
                                                    <select name="phone_adsense[after_category]" class="adsense-select">
                                                        <option value="0">Select a size</option>
                                                        <?php if(!empty($adsenseSizeArr)): ?>
                                                            <?php $__currentLoopData = $adsenseSizeArr; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $size): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <option><?php echo e($size); ?></option>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        <?php endif; ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
                

                
                <?php if(!$target->isEmpty()): ?>
                    <?php $__currentLoopData = $target; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($data->ad_type == 'native_like'): ?>
                            <div class="card margin-top-20">
                                <div class="card-header" id="headingnativeLike">
                                    <h5 class="mb-0">
                                        <button type="button" class="btn btn-link collapsed" data-toggle="collapse"
                                            data-target="#nativeLikeAd" aria-expanded="false" aria-controls="nativeLikeAd">
                                            Native Video Ad (for you may also like)
                                        </button>
                                    </h5>
                                </div>
                                <div id="nativeLikeAd" class="collapse" aria-labelledby="headingnativeLike"
                                    data-parent="#accordion">
                                    <div class="card-body">
                                        <div class="row margin-top-20">

                                            <input type="hidden" name="ad_type[]" value="native_like">

                                            <div class="col-md-3">
                                                <span class="bold"> Your Native Ad(for you may also like)</span>
                                                <br /><br />
                                                <span>Paste your ad code here. Google AdSense will be made responsive
                                                    automatically.</span>
                                            </div>
                                            <div class="offset-1 col-md-8">
                                                <textarea name="add_link[native_like]" class="add-link-input" cols="85"
                                                    rows="10"><?php echo e($data->ad_link); ?></textarea>
                                            </div>
                                        </div>
                                        <div class="row margin-top-10">
                                            <div class="col-md-3">
                                                <span class="bold"> Ad Title :</span> <br /><br />
                                                <span>A title for the Ad, like - Advertisement - if you leave it blank the
                                                    ad spot will
                                                    not
                                                    have a title.</span>
                                            </div>
                                            <div class="offset-1 col-md-8">
                                                <input type="text" name="add_title[native_like]" class="add-link-input"
                                                    value="<?php echo e($data->ad_title); ?>">
                                            </div>
                                        </div>
                                        <div class="row margin-top-20">
                                            <div class="col-md-3">
                                                <span class="bold"> Show Add (Per Video) :</span>
                                            </div>
                                            <div class="offset-1 col-md-8">
                                                <input type="number" name="show_per_video_category[native_like]"
                                                    class="add-link-input" value="<?php echo e($data->show_per_video_category); ?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php else: ?>
                    <div class="card margin-top-20">
                        <div class="card-header" id="headingnativeLike">
                            <h5 class="mb-0">
                                <button type="button" class="btn btn-link collapsed" data-toggle="collapse"
                                    data-target="#nativeLikeAd" aria-expanded="false" aria-controls="nativeLikeAd">
                                    Native Video Ad (for you may also like)
                                </button>
                            </h5>
                        </div>
                        <div id="nativeLikeAd" class="collapse" aria-labelledby="headingnativeLike"
                            data-parent="#accordion">
                            <div class="card-body">
                                <div class="row margin-top-20">

                                    <input type="hidden" name="ad_type[]" value="native_like">

                                    <div class="col-md-3">
                                        <span class="bold"> Your Native Ad(for you may also like)</span>
                                        <br /><br />
                                        <span>Paste your ad code here. Google AdSense will be made responsive
                                            automatically.</span>
                                    </div>
                                    <div class="offset-1 col-md-8">
                                        <textarea name="add_link[native_like]" class="add-link-input" cols="85"
                                            rows="10"></textarea>
                                    </div>
                                </div>
                                <div class="row margin-top-10">
                                    <div class="col-md-3">
                                        <span class="bold"> Ad Title :</span> <br /><br />
                                        <span>A title for the Ad, like - Advertisement - if you leave it blank the ad spot
                                            will
                                            not
                                            have a title.</span>
                                    </div>
                                    <div class="offset-1 col-md-8">
                                        <input type="text" name="add_title[native_like]" class="add-link-input">
                                    </div>
                                </div>
                                <div class="row margin-top-20">
                                    <div class="col-md-3">
                                        <span class="bold"> Show Add (Per Video) :</span>
                                    </div>
                                    <div class="offset-1 col-md-8">
                                        <input type="number" name="show_per_video_category[native_like]"
                                            class="add-link-input">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
                

                
                <?php if(!$target->isEmpty()): ?>
                    <?php $__currentLoopData = $target; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($data->ad_type == 'native_series'): ?>
                            <div class="card margin-top-20">
                                <div class="card-header" id="headingnativeSeries">
                                    <h5 class="mb-0">
                                        <button type="button" class="btn btn-link collapsed" data-toggle="collapse"
                                            data-target="#nativeSeriesAd" aria-expanded="false"
                                            aria-controls="nativeSeriesAd">
                                            Native Video Ad (for series video)
                                        </button>
                                    </h5>
                                </div>
                                <div id="nativeSeriesAd" class="collapse" aria-labelledby="headingnativeSeries"
                                    data-parent="#accordion">
                                    <div class="card-body">
                                        <div class="row margin-top-20">

                                            <input type="hidden" name="ad_type[]" value="native_series">

                                            <div class="col-md-3">
                                                <span class="bold"> Your Native Ad (for series video)</span>
                                                <br /><br />
                                                <span>Paste your ad code here. Google AdSense will be made responsive
                                                    automatically.</span>
                                            </div>
                                            <div class="offset-1 col-md-8">
                                                <textarea name="add_link[native_series]" class="add-link-input" cols="85"
                                                    rows="10"><?php echo e($data->ad_link); ?></textarea>
                                            </div>
                                        </div>
                                        <div class="row margin-top-10">
                                            <div class="col-md-3">
                                                <span class="bold"> Ad Title :</span> <br /><br />
                                                <span>A title for the Ad, like - Advertisement - if you leave it blank the
                                                    ad spot will
                                                    not
                                                    have a title.</span>
                                            </div>
                                            <div class="offset-1 col-md-8">
                                                <input type="text" name="add_title[native_series]" class="add-link-input"
                                                    value="<?php echo e($data->ad_title); ?>">
                                            </div>
                                        </div>
                                        <div class="row margin-top-20">
                                            <div class="col-md-3">
                                                <span class="bold"> Show Add (Per Video) :</span>
                                            </div>
                                            <div class="offset-1 col-md-8">
                                                <input type="number" name="show_per_video_category[native_series]"
                                                    class="add-link-input" value="<?php echo e($data->show_per_video_category); ?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php else: ?>
                    <div class="card margin-top-20">
                        <div class="card-header" id="headingnativeSeries">
                            <h5 class="mb-0">
                                <button type="button" class="btn btn-link collapsed" data-toggle="collapse"
                                    data-target="#nativeSeriesAd" aria-expanded="false" aria-controls="nativeSeriesAd">
                                    Native Video Ad (for series video)
                                </button>
                            </h5>
                        </div>
                        <div id="nativeSeriesAd" class="collapse" aria-labelledby="headingnativeSeries"
                            data-parent="#accordion">
                            <div class="card-body">
                                <div class="row margin-top-20">

                                    <input type="hidden" name="ad_type[]" value="native_series">

                                    <div class="col-md-3">
                                        <span class="bold"> Your Native Ad (for series video)</span> <br /><br />
                                        <span>Paste your ad code here. Google AdSense will be made responsive
                                            automatically.</span>
                                    </div>
                                    <div class="offset-1 col-md-8">
                                        <textarea name="add_link[native_series]" class="add-link-input" cols="85"
                                            rows="10"></textarea>
                                    </div>
                                </div>
                                <div class="row margin-top-10">
                                    <div class="col-md-3">
                                        <span class="bold"> Ad Title :</span> <br /><br />
                                        <span>A title for the Ad, like - Advertisement - if you leave it blank the ad spot
                                            will
                                            not
                                            have a title.</span>
                                    </div>
                                    <div class="offset-1 col-md-8">
                                        <input type="text" name="add_title[native_series]" class="add-link-input">
                                    </div>
                                </div>
                                <div class="row margin-top-20">
                                    <div class="col-md-3">
                                        <span class="bold"> Show Add (Per Video) :</span>
                                    </div>
                                    <div class="offset-1 col-md-8">
                                        <input type="number" name="show_per_video_category[native_series]"
                                            class="add-link-input">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
                

                
                <?php if(!$target->isEmpty()): ?>
                    <?php $__currentLoopData = $target; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($data->ad_type == 'popup'): ?>
                            <div class="card margin-top-20">
                                <div class="card-header" id="headingPopup">
                                    <h5 class="mb-0">
                                        <button type="button" class="btn btn-link collapsed" data-toggle="collapse"
                                            data-target="#popupAd" aria-expanded="false" aria-controls="popupAd">
                                            Popup Ad
                                        </button>
                                    </h5>
                                </div>
                                <div id="popupAd" class="collapse" aria-labelledby="headingPopup"
                                    data-parent="#accordion">
                                    <div class="card-body">
                                        <input type="hidden" name="ad_type[]" value="popup">

                                        <div class="row margin-top-20">
                                            <div class="col-md-3">
                                                <span class="bold">Popup Image :</span>
                                            </div>
                                            <div class="offset-1 col-md-8">
                                                <p><input type="file" accept="image/*" name="image[popup]" id="file"
                                                        onchange="loadFile(event)" style="display: none;"></p>
                                                <p class="btn btn-outline-dark btn-sm web-ad-img-btn">
                                                    <label for="file" style="cursor: pointer;">Upload Image Here</label>
                                                </p>
                                                <p>
                                                    <?php if(!empty($data->image)): ?>
                                                        <img src="<?php echo e(URL::to('/')); ?>/uploads/ad/<?php echo e($data->image); ?>"
                                                            alt="popup" title="popup" id="popupImg" width="200" />
                                                    <?php else: ?>
                                                        <img id="popupImg" width="200" />
                                                    <?php endif; ?>
                                                </p>
                                            </div>
                                        </div>

                                        <div class="row margin-top-20">
                                            <div class="col-md-3">
                                                <span class="bold">Popup Link :</span>
                                            </div>
                                            <div class="offset-1 col-md-8">
                                                <textarea name="add_link[popup]" class="add-link-input" cols="85"
                                                    rows="2"><?php echo e($data->ad_link); ?></textarea>
                                            </div>
                                        </div>
                                        <div class="row margin-top-20">
                                            <div class="col-md-3">
                                                <span class="bold"> Show Add (Per Click) :</span>
                                            </div>
                                            <div class="offset-1 col-md-8">
                                                <input type="number" name="show_per_video_category[popup]"
                                                    class="add-link-input" value="<?php echo e($data->show_per_video_category); ?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php else: ?>
                    <div class="card margin-top-20">
                        <div class="card-header" id="headingPopup">
                            <h5 class="mb-0">
                                <button type="button" class="btn btn-link collapsed" data-toggle="collapse"
                                    data-target="#popupAd" aria-expanded="false" aria-controls="popupAd">
                                    Popup Ad
                                </button>
                            </h5>
                        </div>
                        <div id="popupAd" class="collapse" aria-labelledby="headingPopup" data-parent="#accordion">
                            <div class="card-body">
                                <input type="hidden" name="ad_type[]" value="popup">
                                <div class="row margin-top-20">
                                    <div class="col-md-3">
                                        <span class="bold">Popup Image :</span>
                                    </div>
                                    <div class="offset-1 col-md-8">
                                        <p><input type="file" accept="image/*" name="image[popup]" id="file"
                                                onchange="loadFile(event)" style="display: none;"></p>
                                        <p class="btn btn-outline-dark btn-sm web-ad-img-btn">
                                            <label for="file" style="cursor: pointer;">Upload Image Here</label>
                                        </p>

                                        <p>
                                            <img id="popupImg" width="200" />
                                        </p>
                                    </div>
                                </div>

                                <div class="row margin-top-20">
                                    <div class="col-md-3">
                                        <span class="bold">Popup Link :</span>
                                    </div>
                                    <div class="offset-1 col-md-8">
                                        <textarea name="add_link[popup]" class="add-link-input" cols="85"
                                            rows="2"></textarea>
                                    </div>
                                </div>

                                <div class="row margin-top-20">
                                    <div class="col-md-3">
                                        <span class="bold"> Show Add (Per Click) :</span>
                                    </div>
                                    <div class="offset-1 col-md-8">
                                        <input type="number" name="show_per_video_category[popup]" class="add-link-input">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
                

                
                <div id="customAdSection" class="margin-top-20">
                    <div class="form-check form-switch custom-ad-heading">
                        <div class="row">
                            <div class="col-md-11">
                                <h5 class="bold">Custom Add Section</h5>
                            </div>
                            <?php
                            $checked = '';
                            if (!$target->isEmpty()) {
                                foreach ($target as $data) {
                                    if ($data->ad_type == 'custom_header') {
                                        if ($data->status == 'on') {
                                            $checked = 'checked';
                                        }
                                    }
                                }
                            }
                            ?>
                            <div class="col-md-1">
                                <input class="form-check-input" data-class="featured" name="status" type="checkbox"
                                    id="disableCustom" <?php echo e($checked); ?>>
                            </div>
                        </div>
                    </div>

                    <div class="custom-ad-body">
                        <?php if(!$target->isEmpty()): ?>

                            
                            <?php $__currentLoopData = $target; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($data->ad_type == 'custom_header'): ?>
                                    <div class="card">
                                        <div class="card-header" id="headingCustomHeader">
                                            <h5 class="mb-0">
                                                <button type="button" class="btn btn-link collapsed" data-toggle="collapse"
                                                    data-target="#customHeaderAd" aria-expanded="false"
                                                    aria-controls="customHeaderAd">
                                                    Custom Header Ad
                                                </button>
                                            </h5>
                                        </div>

                                        <div id="customHeaderAd" class="collapse"
                                            aria-labelledby="headingCustomHeader" data-parent="#accordion">
                                            <div class="card-body">
                                                <div class="card-body">
                                                    <input type="hidden" name="ad_type[]" value="custom_header">
                                                    <div class="row margin-top-20">

                                                        <div class="col-md-3">
                                                            <span class="bold">Custom Header Image :</span>
                                                        </div>
                                                        <div class="offset-1 col-md-8">
                                                            <p><input type="file" accept="image/*"
                                                                    name="image[custom_header]" id="fileCH"
                                                                    onchange="loadFileCH(event)" style="display: none;"></p>
                                                            <p class="btn btn-outline-dark btn-sm web-ad-img-btn">
                                                                <label for="fileCH" style="cursor: pointer;">Upload Image
                                                                    Here</label>
                                                            </p>
                                                            <p>
                                                                <?php if(!empty($data->image)): ?>
                                                                    <img src="<?php echo e(URL::to('/')); ?>/uploads/ad/<?php echo e($data->image); ?>"
                                                                        alt="Custom" title="Custom" id="CHImg"
                                                                        width="200" />
                                                                <?php else: ?>
                                                                    <img id="CHImg" width="200" />
                                                                <?php endif; ?>
                                                            </p>
                                                        </div>
                                                    </div>

                                                    <div class="row margin-top-20">
                                                        <div class="col-md-3">
                                                            <span class="bold">Custom Header Link :</span>
                                                        </div>
                                                        <div class="offset-1 col-md-8">
                                                            <textarea name="add_link[custom_header]" class="add-link-input"
                                                                cols="85" rows="2"><?php echo e($data->ad_link); ?></textarea>
                                                        </div>
                                                    </div>
                                                    
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            

                            
                            <?php $__currentLoopData = $target; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($data->ad_type == 'custom_after_category'): ?>
                                    <div class="card margin-top-20">
                                        <div class="card-header" id="headingCustomAfterCategory">
                                            <h5 class="mb-0">
                                                <button type="button" class="btn btn-link collapsed" data-toggle="collapse"
                                                    data-target="#customAfterCategoryAd" aria-expanded="false"
                                                    aria-controls="customAfterCategoryAd">
                                                    Custom After Category Ad
                                                </button>
                                            </h5>
                                        </div>
                                        <div id="customAfterCategoryAd" class="collapse"
                                            aria-labelledby="headingCustomAfterCategory" data-parent="#accordion">
                                            <div class="card-body">
                                                <div class="card-body">
                                                    <input type="hidden" name="ad_type[]" value="custom_after_category">
                                                    <div class="row margin-top-20">
                                                        <div class="col-md-3">
                                                            <span class="bold">Custom After Category Image
                                                                :</span>
                                                        </div>
                                                        <div class="offset-1 col-md-8">
                                                            <p><input type="file" accept="image/*"
                                                                    name="image[custom_after_category]" id="fileCAC"
                                                                    onchange="loadFileCAC(event)" style="display: none;">
                                                            </p>
                                                            <p class="btn btn-outline-dark btn-sm web-ad-img-btn">
                                                                <label for="fileCAC" style="cursor: pointer;">Upload Image
                                                                    Here</label>
                                                            </p>
                                                            <p>
                                                                <?php if(!empty($data->image)): ?>
                                                                    <img src="<?php echo e(URL::to('/')); ?>/uploads/ad/<?php echo e($data->image); ?>"
                                                                        alt="Custom After Category"
                                                                        title="Custom After Category" id="CACImg"
                                                                        width="200" />
                                                                <?php else: ?>
                                                                    <img id="CACImg" width="200" />
                                                                <?php endif; ?>
                                                            </p>
                                                        </div>
                                                    </div>

                                                    <div class="row margin-top-20">
                                                        <div class="col-md-3">
                                                            <span class="bold">Custom After Category Link
                                                                :</span>
                                                        </div>
                                                        <div class="offset-1 col-md-8">
                                                            <textarea name="add_link[custom_after_category]"
                                                                class="add-link-input" cols="85"
                                                                rows="2"><?php echo e($data->ad_link); ?></textarea>
                                                        </div>
                                                    </div>

                                                    <div class="row margin-top-20">
                                                        <div class="col-md-3">
                                                            <span class="bold"> Show Add (Per Video) :</span>
                                                        </div>
                                                        <div class="offset-1 col-md-8">
                                                            <input type="number"
                                                                name="show_per_video_category[custom_after_category]"
                                                                class="add-link-input"
                                                                value="<?php echo e($data->show_per_video_category); ?>">
                                                        </div>
                                                    </div>

                                                    
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            

                            
                            <?php $__currentLoopData = $target; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($data->ad_type == 'custom_native_like'): ?>
                                    <div class="card margin-top-20">
                                        <div class="card-header" id="headingCustomNativeLike">
                                            <h5 class="mb-0">
                                                <button type="button" class="btn btn-link collapsed" data-toggle="collapse"
                                                    data-target="#customNativeLikeAd" aria-expanded="false"
                                                    aria-controls="customNativeLikeAd">
                                                    Custom Native Ad (You May Also Like)
                                                </button>
                                            </h5>
                                        </div>
                                        <div id="customNativeLikeAd" class="collapse"
                                            aria-labelledby="headingCustomNativeLike" data-parent="#accordion">
                                            <div class="card-body">
                                                <div class="card-body">
                                                    <div class="row margin-top-20">

                                                        <input type="hidden" name="ad_type[]" value="custom_native_like">

                                                        <div class="col-md-3">
                                                            <span class="bold">Custom Native Image (You May Also Like):</span>
                                                        </div>
                                                        <div class="offset-1 col-md-8">
                                                            <p><input type="file" accept="image/*"
                                                                    name="image[custom_native_like]" id="fileCNL"
                                                                    onchange="loadFileCNL(event)" style="display: none;">
                                                            </p>
                                                            <p class="btn btn-outline-dark btn-sm web-ad-img-btn">
                                                                <label for="fileCNL" style="cursor: pointer;">Upload Image
                                                                    Here</label>
                                                            </p>
                                                            <p>
                                                                <?php if(!empty($data->image)): ?>
                                                                    <img src="<?php echo e(URL::to('/')); ?>/uploads/ad/<?php echo e($data->image); ?>"
                                                                        alt="Custom Native like" title="Custom Native like"
                                                                        id="CNLImg" width="200" />
                                                                <?php else: ?>
                                                                    <img id="CNLImg" width="200" />
                                                                <?php endif; ?>
                                                            </p>
                                                        </div>
                                                    </div>

                                                    <div class="row margin-top-20">
                                                        <div class="col-md-3">
                                                            <span class="bold">Custom Native Link (You May Also Like)
                                                                :</span>
                                                        </div>
                                                        <div class="offset-1 col-md-8">
                                                            <textarea name="add_link[custom_native_like]"
                                                                class="add-link-input" cols="85"
                                                                rows="2"><?php echo e($data->ad_link); ?></textarea>
                                                        </div>
                                                    </div>

                                                    <div class="row margin-top-20">
                                                        <div class="col-md-3">
                                                            <span class="bold"> Show Add (Per Video) :</span>
                                                        </div>
                                                        <div class="offset-1 col-md-8">
                                                            <input type="number"
                                                                name="show_per_video_category[custom_native_like]"
                                                                class="add-link-input"
                                                                value="<?php echo e($data->show_per_video_category); ?>">
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            

                            
                            <?php $__currentLoopData = $target; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($data->ad_type == 'custom_native_series'): ?>
                                    <div class="card margin-top-20">
                                        <div class="card-header" id="headingCustomNativeSeries">
                                            <h5 class="mb-0">
                                                <button type="button" class="btn btn-link collapsed" data-toggle="collapse"
                                                    data-target="#customNativeSeriesAd" aria-expanded="false"
                                                    aria-controls="customNativeSeriesAd">
                                                    Custom Native Ad (For Series Video)
                                                </button>
                                            </h5>
                                        </div>
                                        <div id="customNativeSeriesAd" class="collapse"
                                            aria-labelledby="headingCustomNativeSeries" data-parent="#accordion">
                                            <div class="card-body">
                                                <div class="card-body">
                                                    <div class="row margin-top-20">

                                                        <input type="hidden" name="ad_type[]" value="custom_native_series">

                                                        <div class="col-md-3">
                                                            <span class="bold">Custom Native Image (For Series Video):</span>
                                                        </div>
                                                        <div class="offset-1 col-md-8">
                                                            <p><input type="file" accept="image/*"
                                                                    name="image[custom_native_series]" id="fileCNS"
                                                                    onchange="loadFileCNS(event)" style="display: none;">
                                                            </p>
                                                            <p class="btn btn-outline-dark btn-sm web-ad-img-btn">
                                                                <label for="fileCNS" style="cursor: pointer;">Upload Image
                                                                    Here</label>
                                                            </p>
                                                            <p>
                                                                <?php if(!empty($data->image)): ?>
                                                                    <img src="<?php echo e(URL::to('/')); ?>/uploads/ad/<?php echo e($data->image); ?>"
                                                                        alt="Custom Native Series"
                                                                        title="Custom Native series" id="CNSImg"
                                                                        width="200" />
                                                                <?php else: ?>
                                                                    <img id="CNSImg" width="200" />
                                                                <?php endif; ?>
                                                            </p>
                                                        </div>
                                                    </div>

                                                    <div class="row margin-top-20">
                                                        <div class="col-md-3">
                                                            <span class="bold">Custom Native Link (For Series Video)
                                                                :</span>
                                                        </div>
                                                        <div class="offset-1 col-md-8">
                                                            <textarea name="add_link[custom_native_series]"
                                                                class="add-link-input" cols="85"
                                                                rows="2"><?php echo e($data->ad_link); ?></textarea>
                                                        </div>
                                                    </div>

                                                    <div class="row margin-top-20">
                                                        <div class="col-md-3">
                                                            <span class="bold"> Show Add (Per Episode) :</span>
                                                        </div>
                                                        <div class="offset-1 col-md-8">
                                                            <input type="number"
                                                                name="show_per_video_category[custom_native_series]"
                                                                class="add-link-input"
                                                                value="<?php echo e($data->show_per_video_category); ?>">
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            

                        <?php else: ?>
                            
                            <div class="card">
                                <div class="card-header" id="headingCustomHeader">
                                    <h5 class="mb-0">
                                        <button type="button" class="btn btn-link collapsed" data-toggle="collapse"
                                            data-target="#customHeaderAd" aria-expanded="false"
                                            aria-controls="customHeaderAd">
                                            Custom Header Ad
                                        </button>
                                    </h5>
                                </div>
                                <div id="customHeaderAd" class="collapse" aria-labelledby="headingCustomHeader"
                                    data-parent="#accordion">
                                    <div class="card-body">
                                        <div class="card-body">
                                            <div class="row margin-top-20">

                                                <input type="hidden" name="ad_type[]" value="custom_header">

                                                <div class="col-md-3">
                                                    <span class="bold">Custom Header Image :</span>
                                                </div>
                                                <div class="offset-1 col-md-8">
                                                    <p><input type="file" accept="image/*" name="image[custom_header]"
                                                            id="fileCH" onchange="loadFileCH(event)" style="display: none;">
                                                    </p>
                                                    <p class="btn btn-outline-dark btn-sm web-ad-img-btn">
                                                        <label for="fileCH" style="cursor: pointer;">Upload Image
                                                            Here</label>
                                                    </p>
                                                    <p>
                                                        <img id="CHImg" width="200" />
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="row margin-top-20">
                                                <div class="col-md-3">
                                                    <span class="bold">Custom Header Link :</span>
                                                </div>
                                                <div class="offset-1 col-md-8">
                                                    <textarea name="add_link[custom_header]" class="add-link-input"
                                                        cols="85" rows="2"></textarea>
                                                </div>
                                            </div>

                                            
                                        </div>

                                    </div>
                                </div>
                            </div>
                            

                            
                            <div class="card margin-top-20">
                                <div class="card-header" id="headingCustomAfterCategory">
                                    <h5 class="mb-0">
                                        <button type="button" class="btn btn-link collapsed" data-toggle="collapse"
                                            data-target="#customAfterCategoryAd" aria-expanded="false"
                                            aria-controls="customAfterCategoryAd">
                                            Custom After Category Ad
                                        </button>
                                    </h5>
                                </div>
                                <div id="customAfterCategoryAd" class="collapse"
                                    aria-labelledby="headingCustomAfterCategory" data-parent="#accordion">
                                    <div class="card-body">
                                        <div class="card-body">
                                            <div class="row margin-top-20">

                                                <input type="hidden" name="ad_type[]" value="custom_after_category">

                                                <div class="col-md-3">
                                                    <span class="bold">Custom After Category Image
                                                        :</span>
                                                </div>
                                                <div class="offset-1 col-md-8">
                                                    <p><input type="file" accept="image/*"
                                                            name="image[custom_after_category]" id="fileCAC"
                                                            onchange="loadFileCAC(event)" style="display: none;"></p>
                                                    <p class="btn btn-outline-dark btn-sm web-ad-img-btn">
                                                        <label for="fileCAC" style="cursor: pointer;">Upload Image
                                                            Here</label>
                                                    </p>
                                                    <p>
                                                        <img id="CACImg" width="200" />
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="row margin-top-20">
                                                <div class="col-md-3">
                                                    <span class="bold">Custom After Category Link
                                                        :</span>
                                                </div>
                                                <div class="offset-1 col-md-8">
                                                    <textarea name="add_link[custom_after_category]" class="add-link-input"
                                                        cols="85" rows="2"></textarea>
                                                </div>
                                            </div>


                                            <div class="row margin-top-20">
                                                <div class="col-md-3">
                                                    <span class="bold"> Show Add (Per Video) :</span>
                                                </div>
                                                <div class="offset-1 col-md-8">
                                                    <input type="number"
                                                        name="show_per_video_category[custom_after_category]"
                                                        class="add-link-input">
                                                </div>
                                            </div>

                                            
                                        </div>

                                    </div>
                                </div>
                            </div>
                            

                            
                            <div class="card margin-top-20">
                                <div class="card-header" id="headingCustomNativeLike">
                                    <h5 class="mb-0">
                                        <button type="button" class="btn btn-link collapsed" data-toggle="collapse"
                                            data-target="#customNativeLikeAd" aria-expanded="false"
                                            aria-controls="customNativeLikeAd">
                                            Custom Native Ad (You May Also Like)
                                        </button>
                                    </h5>
                                </div>
                                <div id="customNativeLikeAd" class="collapse"
                                    aria-labelledby="headingCustomNativeLike" data-parent="#accordion">
                                    <div class="card-body">
                                        <div class="card-body">
                                            <div class="row margin-top-20">

                                                <input type="hidden" name="ad_type[]" value="custom_native_like">

                                                <div class="col-md-3">
                                                    <span class="bold">Custom Native Image (You May Also Like):</span>
                                                </div>
                                                <div class="offset-1 col-md-8">
                                                    <p><input type="file" accept="image/*" name="image[custom_native_like]"
                                                            id="fileCNL" onchange="loadFileCNL(event)"
                                                            style="display: none;"></p>
                                                    <p class="btn btn-outline-dark btn-sm web-ad-img-btn">
                                                        <label for="fileCNL" style="cursor: pointer;">Upload Image
                                                            Here</label>
                                                    </p>
                                                    <p>
                                                        <img id="CNLImg" width="200" />
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="row margin-top-20">
                                                <div class="col-md-3">
                                                    <span class="bold">Custom Native Link (You May Also Like) :</span>
                                                </div>
                                                <div class="offset-1 col-md-8">
                                                    <textarea name="add_link[custom_native_like]" class="add-link-input"
                                                        cols="85" rows="2"></textarea>
                                                </div>
                                            </div>

                                            <div class="row margin-top-20">
                                                <div class="col-md-3">
                                                    <span class="bold"> Show Add (Per Video) :</span>
                                                </div>
                                                <div class="offset-1 col-md-8">
                                                    <input type="number" name="show_per_video_category[custom_native_like]"
                                                        class="add-link-input">
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            

                            
                            <div class="card margin-top-20">
                                <div class="card-header" id="headingCustomNativeSeries">
                                    <h5 class="mb-0">
                                        <button type="button" class="btn btn-link collapsed" data-toggle="collapse"
                                            data-target="#customNativeSeriesAd" aria-expanded="false"
                                            aria-controls="customNativeSeriesAd">
                                            Custom Native Ad (For Series Video)
                                        </button>
                                    </h5>
                                </div>
                                <div id="customNativeSeriesAd" class="collapse"
                                    aria-labelledby="headingCustomNativeSeries" data-parent="#accordion">
                                    <div class="card-body">
                                        <div class="card-body">
                                            <div class="row margin-top-20">

                                                <input type="hidden" name="ad_type[]" value="custom_native_series">

                                                <div class="col-md-3">
                                                    <span class="bold">Custom Native Image (For Series Video):</span>
                                                </div>
                                                <div class="offset-1 col-md-8">
                                                    <p><input type="file" accept="image/*"
                                                            name="image[custom_native_series]" id="filecns"
                                                            onchange="loadFileCNS(event)" style="display: none;"></p>
                                                    <p class="btn btn-outline-dark btn-sm web-ad-img-btn">
                                                        <label for="fileCNS" style="cursor: pointer;">Upload Image
                                                            Here</label>
                                                    </p>
                                                    <p>
                                                        <img id="CNSImg" width="200" />
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="row margin-top-20">
                                                <div class="col-md-3">
                                                    <span class="bold">Custom Native Link (For Series Video) :</span>
                                                </div>
                                                <div class="offset-1 col-md-8">
                                                    <textarea name="add_link[custom_native_series]" class="add-link-input"
                                                        cols="85" rows="2"></textarea>
                                                </div>
                                            </div>

                                            <div class="row margin-top-20">
                                                <div class="col-md-3">
                                                    <span class="bold"> Show Add (Per Episode) :</span>
                                                </div>
                                                <div class="offset-1 col-md-8">
                                                    <input type="number"
                                                        name="show_per_video_category[custom_native_series]"
                                                        class="add-link-input">
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            
                        <?php endif; ?>
                    </div>
                </div>
                
                <div class="col-md-12 actions margin-top-20 text-center">
                    <button type="submit" class="submit">Update</button>
                </div>
            </form>
        </div>
    </div>
    


<?php $__env->stopSection(); ?>
<?php $__env->startPush('custom-js'); ?>
    <script type="text/javascript">
        var loadFile = function(event) {
            var image = document.getElementById('popupImg');
            image.src = URL.createObjectURL(event.target.files[0]);
        };
        var loadFileCH = function(event) {
            var image = document.getElementById('CHImg');
            image.src = URL.createObjectURL(event.target.files[0]);
        };
        var loadFileCAC = function(event) {
            var image = document.getElementById('CACImg');
            image.src = URL.createObjectURL(event.target.files[0]);
        };
        var loadFileCNL = function(event) {
            var image = document.getElementById('CNLImg');
            image.src = URL.createObjectURL(event.target.files[0]);
        };
        var loadFileCNS = function(event) {
            var image = document.getElementById('CNSImg');
            image.src = URL.createObjectURL(event.target.files[0]);
        };
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.default.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ccninfot/movieflix.ccninfotech.com/resources/views/advertisement/webAd.blade.php ENDPATH**/ ?>