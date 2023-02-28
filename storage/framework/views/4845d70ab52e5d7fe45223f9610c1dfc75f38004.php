<?php $__env->startSection('data_count'); ?>
    
    <div class="content-heading">
        <div class="row">
            
            <div class="col-md-8 content-title">
                <span class="title">Manage Ad</span>
                <div class="title-line"></div>
            </div>
            
        </div>
    </div>
    

    

    

    <div class="margin-top-10 action-buttons">

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
    
    <form id="mobileAdForm" method="POST" enctype="multipart/form-data"
        action="<?php echo e(URL::to('admin/advertisement/mobileAdUpdate')); ?>">
        <?php echo csrf_field(); ?>

        <div class="row margin-top-40">


            
            <?php if(!$target->isEmpty()): ?>
                <?php $__currentLoopData = $target; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($data->ad_type == 'google'): ?>
                        <div class="col-md-6 google-ad">
                            <div class="add-content">
                                <div class="ad-title">
                                    <div class="row">
                                        <div class="col-md-10 col-sm-8"><span class="title">Google Ad:</span></div>

                                        <input type="hidden" name="ad_type[]" value="google">

                                        <div class="col-md-2 col-sm-4 text-right">
                                            <input type="checkbox" name="google_status[google]" id="googleStatus"
                                                class="ad-switch" <?php echo $data->google_status == 'on' ? 'checked' : ''; ?>>

                                            
                                        </div>
                                    </div>
                                </div>

                                <div class="ad-body">
                                    <div class="form-group">
                                        <label for="googleBannerAdmob">Banner Admob ID</label>
                                        <input type="text" name="banner_id[google]" class="form-control create-form"
                                            id="googleBannerAdmob" value="<?php echo $data->banner_id ?? ''; ?>">
                                    </div>

                                    <div class="form-group">
                                        <label for="googleInteresticialAdmob">Interesticial Admob ID</label>
                                        <input type="text" name="interesticial_id[google]" class="form-control create-form"
                                            id="googleInteresticialAdmob" value="<?php echo $data->interesticial_id ?? ''; ?>">
                                    </div>
                                    <div class="interesticial-details">
                                        <div class="form-group">
                                            <label for="googleInteresticialAdmobClick">Interesticial Admob Click</label>
                                            <input type="number" name="interesticial_click[google]"
                                                value="<?php echo $data->interesticial_click ?? ''; ?>" class="form-control create-form"
                                                id="googleInteresticialAdmobClick">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="googleNativeAdmob">Native Admob ID</label>
                                        <input type="text" name="native_id[google]" class="form-control create-form"
                                            id="googleNativeAdmob" value="<?php echo $data->native_id ?? ''; ?>">
                                    </div>

                                    <div class="native-details">
                                        <div class="form-group">
                                            <label for="googlNativeAddPerVideo">Native Ad Per Video (You May Also
                                                Like)</label>
                                            <input type="number" name="native_per_video_like[google]"
                                                value="<?php echo $data->native_per_video_like ?? ''; ?>" class="form-control create-form"
                                                id="googlNativeAddPerVideo">
                                        </div>
                                        <div class="form-group">
                                            <label for="googlNativeAddPerVideoSeries">Native Ad Per Video (For
                                                Series)</label>
                                            <input type="number" name="native_per_video_series[google]"
                                                value="<?php echo $data->native_per_video_series ?? ''; ?>" class="form-control create-form"
                                                id="googlNativeAddPerVideoSeries">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="googleAppOpenAdmob">App Open ID</label>
                                        <input type="text" name="app_open_id[google]" class="form-control create-form"
                                            id="googleAppOpenAdmob" value="<?php echo $data->app_open_id ?? ''; ?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php else: ?>
                <div class="col-md-6 google-ad">
                    <div class="add-content">
                        <div class="ad-title">
                            <div class="row">
                                <div class="col-md-10 col-sm-8"><span class="title">Google Ad:</span></div>

                                <input type="hidden" name="ad_type[]" value="google">

                                <div class="col-md-2 col-sm-4 text-right">
                                    <input type="checkbox" name="google_status[google]" id="googleStatus"
                                        class="ad-switch">
                                    
                                </div>
                            </div>
                        </div>

                        <div class="ad-body">
                            <div class="form-group">
                                <label for="googleBannerAdmob">Banner Admob ID</label>
                                <input type="text" name="banner_id[google]" class="form-control create-form"
                                    id="googleBannerAdmob">
                            </div>

                            <div class="form-group">
                                <label for="googleInteresticialAdmob">Interesticial Admob ID</label>
                                <input type="text" name="interesticial_id[google]" class="form-control create-form"
                                    id="googleInteresticialAdmob">
                            </div>
                            <div class="interesticial-details">
                                <div class="form-group">
                                    <label for="googleInteresticialAdmobClick">Interesticial Admob Click</label>
                                    <input type="number" name="interesticial_click[google]" class="form-control create-form"
                                        id="googleInteresticialAdmobClick">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="googleNativeAdmob">Native Admob ID</label>
                                <input type="text" name="native_id[google]" class="form-control create-form"
                                    id="googleNativeAdmob">
                            </div>

                            <div class="native-details">
                                <div class="form-group">
                                    <label for="googlNativeAddPerVideo">Native Ad Per Video (You May Also
                                        Like)</label>
                                    <input type="number" name="native_per_video_like[google]"
                                        class="form-control create-form" id="googlNativeAddPerVideo">
                                </div>
                                <div class="form-group">
                                    <label for="googlNativeAddPerVideoSeries">Native Ad Per Video (For
                                        Series)</label>
                                    <input type="number" name="native_per_video_series[google]"
                                        class="form-control create-form" id="googlNativeAddPerVideoSeries">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="googleAppOpenAdmob">App Open ID</label>
                                <input type="text" name="app_open_id[google]" class="form-control create-form"
                                    id="googleAppOpenAdmob">
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
            

            
            <?php if(!$target->isEmpty()): ?>
                <?php $__currentLoopData = $target; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($data->ad_type == 'facebook'): ?>
                        <div class="col-md-6 fb-ad">
                            <div class="add-content">
                                <div class="ad-title">
                                    <div class="row">
                                        <div class="col-md-10 col-sm-8"><span class="title">Facebook Ad:</span>
                                        </div>

                                        <input type="hidden" name="ad_type[]" value="facebook">

                                        <div class="col-md-2 col-sm-4 text-right">
                                            <input type="checkbox" name="facebook_status[facebook]" id="facebookStatus"
                                                class="ad-switch" <?php echo $data->facebook_status == 'on' ? 'checked' : ''; ?>>

                                            
                                        </div>
                                    </div>
                                </div>

                                <div class="ad-body">
                                    <div class="form-group">
                                        <label for="facebookBannerAdmob">Banner Admob ID</label>
                                        <input type="text" name="banner_id[facebook]" class="form-control create-form"
                                            id="facebookBannerAdmob" value="<?php echo $data->banner_id ?? ''; ?>">
                                    </div>

                                    <div class="form-group">
                                        <label for="facebookInteresticialAdmob">Interesticial Admob ID</label>
                                        <input type="text" name="interesticial_id[facebook]" value="<?php echo $data->interesticial_id ?? ''; ?>"
                                            class="form-control create-form" id="facebookInteresticialAdmob">
                                    </div>
                                    <div class="interesticial-details">
                                        <div class="form-group">
                                            <label for="facebookInteresticialAdmobClick">Interesticial Admob Click</label>
                                            <input type="number" name="interesticial_click[facebook]"
                                                value="<?php echo $data->interesticial_click ?? ''; ?>" class="form-control create-form"
                                                id="facebookInteresticialAdmobClick">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="facebookNativeAdmob">Native Admob ID</label>
                                        <input type="text" name="native_id[facebook]" class="form-control create-form"
                                            id="facebookNativeAdmob" value="<?php echo $data->native_id ?? ''; ?>">
                                    </div>

                                    <div class="native-details">
                                        <div class="form-group">
                                            <label for="facebookNativeAddPerVideo">Native Ad Per Video (You May Also
                                                Like)</label>
                                            <input type="number" name="native_per_video_like[facebook]"
                                                value="<?php echo $data->native_per_video_like ?? ''; ?>" class="form-control create-form"
                                                id="facebookNativeAddPerVideo">
                                        </div>
                                        <div class="form-group">
                                            <label for="facebookNativeAddPerVideoSeries">Native Ad Per Video (For
                                                Series)</label>
                                            <input type="number" name="native_per_video_series[facebook]"
                                                value="<?php echo $data->native_per_video_series ?? ''; ?>" class="form-control create-form"
                                                id="facebookNativeAddPerVideoSeries">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php else: ?>
                <div class="col-md-6 fb-ad">
                    <div class="add-content">
                        <div class="ad-title">
                            <div class="row">
                                <div class="col-md-10"><span class="title">Facebook Ad:</span></div>

                                <input type="hidden" name="ad_type[]" value="facebook">

                                <div class="col-md-2 text-right">

                                    <input type="checkbox" name="facebook_status[facebook]" id="facebookStatus"
                                        class="ad-switch">
                                    
                                </div>
                            </div>
                        </div>

                        <div class="ad-body">
                            <div class="form-group">
                                <label for="facebookBannerAdmob">Banner Admob ID</label>
                                <input type="text" name="banner_id[facebook]" class="form-control create-form"
                                    id="facebookBannerAdmob">
                            </div>

                            <div class="form-group">
                                <label for="facebookInteresticialAdmob">Interesticial Admob ID</label>
                                <input type="text" name="interesticial_id[facebook]" class="form-control create-form"
                                    id="facebookInteresticialAdmob">
                            </div>
                            <div class="interesticial-details">
                                <div class="form-group">
                                    <label for="facebookInteresticialAdmobClick">Interesticial Admob Click</label>
                                    <input type="number" name="interesticial_click[facebook]"
                                        class="form-control create-form" id="facebookInteresticialAdmobClick">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="facebookNativeAdmob">Native Admob ID</label>
                                <input type="text" name="native_id[facebook]" class="form-control create-form"
                                    id="facebookNativeAdmob">
                            </div>

                            <div class="native-details">
                                <div class="form-group">
                                    <label for="facebookNativeAddPerVideo">Native Ad Per Video (You May Also Like)</label>
                                    <input type="number" name="native_per_video_like[facebook]"
                                        class="form-control create-form" id="facebookNativeAddPerVideo">
                                </div>
                                <div class="form-group">
                                    <label for="facebookNativeAddPerVideoSeries">Native Ad Per Video (For Series)</label>
                                    <input type="number" name="native_per_video_series[facebook]"
                                        class="form-control create-form" id="facebookNativeAddPerVideoSeries">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
            


            
            <?php if(!$target->isEmpty()): ?>
                <?php $__currentLoopData = $target; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($data->ad_type == 'custom'): ?>
                        <div class="col-md-12 custom-ad margin-top-40">
                            <div class="add-content">
                                <div class="ad-title">
                                    <div class="row">
                                        <div class="col-md-10 col-sm-8"><span class="title">Custom Ad:</span>
                                        </div>

                                        <input type="hidden" name="ad_type[]" value="custom">


                                        <div class="col-md-2 col-sm-4 text-right">
                                            <input type="checkbox" name="custom_status[custom]" id="customStatus"
                                                class="ad-switch" <?php echo $data->custom_status == 'on' ? 'checked' : ''; ?>>

                                            
                                        </div>
                                    </div>
                                </div>
                                <div class="ad-body">
                                    <div class="row">
                                        <div class="col-md-6 custom-banner">

                                            <div class="form-group">
                                                <span class="bold">Upload Banner Image :</span>
                                                <p>
                                                    <input type="file" accept="image/*" name="banner_image[custom]"
                                                        id="fileCH" onchange="loadFileCH(event)" style="display: none;">
                                                </p>
                                                <p class="btn btn-outline-dark btn-sm web-ad-img-btn">
                                                    <label for="fileCH" style="cursor: pointer;">Upload Image Here</label>
                                                </p>
                                                <p>
                                                    <?php if(!empty($data->banner_image)): ?>
                                                        <img src="<?php echo e(URL::to('/')); ?>/uploads/ad/<?php echo e($data->banner_image); ?>"
                                                            alt="Custom" title="Custom" id="CHImg" width="200" />
                                                    <?php else: ?>
                                                        <img id="CHImg" width="200" />
                                                    <?php endif; ?>
                                                </p>
                                            </div>

                                            <div class="form-group margin-top-20">
                                                <label for="customBannerAdmob">Custom Banner Link</label>
                                                <input type="text" name="banner_link[custom]"
                                                    value="<?php echo $data->banner_link ?? ''; ?>" class="form-control create-form"
                                                    id="customBannerAdmob">
                                            </div>


                                        </div>

                                        <div class="col-md-6 custom-interseticial">

                                            

                                            <div class="form-group">
                                                <span class="bold">Upload Interesticial Image :</span>
                                                <p><input type="file" accept="image/*" name="interesticial_image[custom]"
                                                        id="fileCAC" onchange="loadFileCAC(event)" style="display: none;">
                                                </p>
                                                <p class="btn btn-outline-dark btn-sm web-ad-img-btn">
                                                    <label for="fileCAC" style="cursor: pointer;">Upload Image
                                                        Here</label>
                                                </p>
                                                <p>
                                                    <?php if(!empty($data->interesticial_image)): ?>
                                                        <img src="<?php echo e(URL::to('/')); ?>/uploads/ad/<?php echo e($data->interesticial_image); ?>"
                                                            alt="Custom After Category" title="Custom After Category"
                                                            id="CACImg" width="200" />
                                                    <?php else: ?>
                                                        <img id="CACImg" width="200" />
                                                    <?php endif; ?>
                                                </p>
                                            </div>

                                            <div class="form-group margin-top-20">
                                                <label for="interesticialBannerLink">Interesticial AD Link</label>
                                                <input type="text" name="interesticial_link[custom]"
                                                    value="<?php echo $data->interesticial_link ?? ''; ?>" class="form-control create-form"
                                                    id="interesticialBannerLink">
                                            </div>


                                            <div class="form-group">
                                                <label for="customInteresticialAdmobClick">Custom Interesticial
                                                    Click</label>
                                                <input type="number" name="interesticial_click[custom]"
                                                    value="<?php echo $data->interesticial_click ?? ''; ?>" class="form-control create-form"
                                                    id="customInteresticialAdmobClick">
                                            </div>
                                        </div>

                                        <div class="col-md-6 native-interseticial">

                                            

                                            <div class="form-group">
                                                <span class="bold">Upload Native Image :</span>
                                                <p><input type="file" accept="image/*" name="native_image[custom]"
                                                        id="fileCNL" onchange="loadFileCNL(event)" style="display: none;">
                                                </p>
                                                <p class="btn btn-outline-dark btn-sm web-ad-img-btn">
                                                    <label for="fileCNL" style="cursor: pointer;">Upload Image
                                                        Here</label>
                                                </p>
                                                <p>
                                                    <?php if(!empty($data->native_image)): ?>
                                                        <img src="<?php echo e(URL::to('/')); ?>/uploads/ad/<?php echo e($data->native_image); ?>"
                                                            alt="Custom Native like" title="Custom Native like" id="CNLImg"
                                                            width="200" />
                                                    <?php else: ?>
                                                        <img id="CNLImg" width="200" />
                                                    <?php endif; ?>
                                                </p>
                                            </div>

                                            <div class="form-group margin-top-20">
                                                <label for="nativeNativeAdmob">Native AD Link</label>
                                                <input type="text" name="native_link[custom]"
                                                    value="<?php echo $data->native_link ?? ''; ?>" class="form-control create-form"
                                                    id="nativeNativeAdmob">
                                            </div>

                                            <div class="form-group">
                                                <label for="customNativeAddPerVideo">Native Ad Per Video (You May Also
                                                    Like)</label>
                                                <input type="number" name="native_per_video_like[custom]"
                                                    value="<?php echo $data->native_per_video_like ?? ''; ?>" class="form-control create-form"
                                                    id="customNativeAddPerVideo">
                                            </div>

                                            <div class="form-group">
                                                <label for="customNativeAddPerVideoSeries">Native Ad Per Video (For
                                                    Series)</label>
                                                <input type="number" name="native_per_video_series[custom]"
                                                    value="<?php echo $data->native_per_video_series ?? ''; ?>" class="form-control create-form"
                                                    id="customNativeAddPerVideoSeries">
                                            </div>

                                        </div>

                                        <div class="col-md-6 custom-banner margin-top-20">

                                            <div class="form-group">
                                                <span class="bold">Upload App Open Image :</span>
                                                <p>
                                                    <input type="file" accept="image/*" name="app_open_image[custom]"
                                                        id="fileAP" onchange="loadFileAP(event)" style="display: none;">
                                                </p>
                                                <p class="btn btn-outline-dark btn-sm web-ad-img-btn">
                                                    <label for="fileAP" style="cursor: pointer;">Upload Image Here</label>
                                                </p>
                                                <p>
                                                    <?php if(!empty($data->app_open_image)): ?>
                                                        <img src="<?php echo e(URL::to('/')); ?>/uploads/ad/<?php echo e($data->app_open_image); ?>"
                                                            alt="Custom" title="Custom" id="APImg" width="200" />
                                                    <?php else: ?>
                                                        <img id="APImg" width="200" />
                                                    <?php endif; ?>
                                                </p>
                                            </div>

                                            <div class="form-group margin-top-20">
                                                <label for="customAppOpenAdmob">Custom App Open Link</label>
                                                <input type="text" name="app_open_link[custom]"
                                                    value="<?php echo $data->app_open_link ?? ''; ?>" class="form-control create-form"
                                                    id="customAppOpenAdmob">
                                            </div>


                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php else: ?>
                <div class="col-md-12 custom-ad margin-top-40">
                    <div class="add-content">
                        <div class="ad-title">
                            <div class="row">
                                <div class="col-md-10 col-sm-8"><span class="title">Custom Ad:</span></div>

                                <input type="hidden" name="ad_type[]" value="custom">


                                <div class="col-md-2 col-sm-4 text-right">

                                    <input type="checkbox" name="custom_status[custom]" id="customStatus"
                                        class="ad-switch">
                                </div>
                            </div>
                        </div>
                        <div class="ad-body">
                            <div class="row">
                                <div class="col-md-6 custom-banner">

                                    

                                    <div class="form-group">
                                        <span class="bold">Upload Banner Image :</span>
                                        <p><input type="file" accept="image/*" name="banner_image[custom]" id="fileCH"
                                                onchange="loadFileCH(event)" style="display: none;">
                                        </p>
                                        <p class="btn btn-outline-dark btn-sm web-ad-img-btn">
                                            <label for="fileCH" style="cursor: pointer;">Upload Image
                                                Here</label>
                                        </p>
                                        <p>
                                            <img id="CHImg" width="200" />
                                        </p>
                                    </div>

                                    <div class="form-group margin-top-20">
                                        <label for="customBannerAdmob">Banner Admob Link</label>
                                        <input type="text" name="banner_link[custom]" class="form-control create-form"
                                            id="customBannerAdmob">
                                    </div>


                                </div>
                                <div class="col-md-6 custom-interseticial">

                                    

                                    <div class="form-group">
                                        <span class="bold">Upload Interesticial Image :</span>
                                        <p><input type="file" accept="image/*" name="interesticial_image[custom]"
                                                id="fileCAC" onchange="loadFileCAC(event)" style="display: none;"></p>
                                        <p class="btn btn-outline-dark btn-sm web-ad-img-btn">
                                            <label for="fileCAC" style="cursor: pointer;">Upload Image
                                                Here</label>
                                        </p>
                                        <p>
                                            <img id="CACImg" width="200" />
                                        </p>
                                    </div>

                                    <div class="form-group margin-top-20">
                                        <label for="interesticialBannerLink">Interesticial AD Link</label>
                                        <input type="text" name="interesticial_link[custom]"
                                            class="form-control create-form" id="interesticialBannerLink">
                                    </div>


                                    <div class="form-group">
                                        <label for="customInteresticialAdmobClick">Interesticial Admob Click</label>
                                        <input type="number" name="interesticial_click[custom]"
                                            class="form-control create-form" id="customInteresticialAdmobClick">
                                    </div>
                                </div>

                                <div class="col-md-6 native-interseticial">

                                    

                                    <div class="form-group">
                                        <span class="bold">Upload Native Image :</span>
                                        <p><input type="file" accept="image/*" name="native_image[custom]" id="fileCNL"
                                                onchange="loadFileCNL(event)" style="display: none;"></p>
                                        <p class="btn btn-outline-dark btn-sm web-ad-img-btn">
                                            <label for="fileCNL" style="cursor: pointer;">Upload Image
                                                Here</label>
                                        </p>
                                        <p>
                                            <img id="CNLImg" width="200" />
                                        </p>
                                    </div>

                                    <div class="form-group margin-top-20">
                                        <label for="nativeNativeAdmob">Native AD Link</label>
                                        <input type="text" name="native_link[custom]" class="form-control create-form"
                                            id="nativeNativeAdmob">
                                    </div>

                                    <div class="form-group">
                                        <label for="customNativeAddPerVideo">Native Ad Per Video (You May Also Like)</label>
                                        <input type="number" name="native_per_video_like[custom]"
                                            class="form-control create-form" id="customNativeAddPerVideo">
                                    </div>

                                    <div class="form-group">
                                        <label for="customNativeAddPerVideoSeries">Native Ad Per Video (For Series)</label>
                                        <input type="number" name="native_per_video_series[custom]"
                                            class="form-control create-form" id="customNativeAddPerVideoSeries">
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
            

            
            <?php if(!$target->isEmpty()): ?>
                <?php $__currentLoopData = $target; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($data->ad_type == 'startup'): ?>
                        <div class="col-md-12 startup-ad margin-top-40">
                            <div class="add-content">
                                <div class="ad-title">
                                    <div class="row">
                                        <div class="col-md-10 col-sm-8"><span class="title">Startup Ad:</span>
                                        </div>

                                        <input type="hidden" name="ad_type[]" value="startup">


                                        <div class="col-md-2 col-sm-4 text-right">

                                            <input type="checkbox" name="startup_status[startup]" id="startupStatus"
                                                class="ad-switch" <?php echo $data->startup_status == 'on' ? 'checked' : ''; ?>>

                                            
                                        </div>
                                    </div>
                                </div>
                                <div class="ad-body">
                                    <div class="row">
                                        <div class="col-md-6 startup-banner">

                                            <div class="form-group margin-top-20">
                                                <label for="startupBannerAdmob">Startup AD ID</label>
                                                <input type="text" name="startup_id[startup]"
                                                    value="<?php echo $data->startup_id ?? ''; ?>" class="form-control create-form"
                                                    id="startupBannerAdmob">
                                            </div>


                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php else: ?>
                <div class="col-md-12 startup-ad margin-top-40">
                    <div class="add-content">
                        <div class="ad-title">
                            <div class="row">
                                <div class="col-md-10 col-sm-8"><span class="title">Startup Ad:</span></div>

                                <input type="hidden" name="ad_type[]" value="startup">


                                <div class="col-md-2 col-sm-4 text-right">
                                    <input type="checkbox" name="startup_status[startup]" id="startupStatus"
                                        class="ad-switch">
                                </div>
                            </div>
                        </div>
                        <div class="ad-body">
                            <div class="row">
                                <div class="col-md-6 startup-banner">

                                    <div class="form-group margin-top-20">
                                        <label for="startupBannerAdmob">Startup AD ID</label>
                                        <input type="text" name="startup_id[startup]" class="form-control create-form"
                                            id="startupBannerAdmob">
                                    </div>


                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
            

            
            <?php if(!$target->isEmpty()): ?>
                <?php $__currentLoopData = $target; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($data->ad_type == 'unity'): ?>
                        <div class="col-md-6 unity-ad margin-top-40">
                            <div class="add-content">
                                <div class="ad-title">
                                    <div class="row">
                                        <div class="col-md-10 col-sm-8"><span class="title">Unity Ad:</span></div>

                                        <input type="hidden" name="ad_type[]" value="unity">


                                        <div class="col-md-2 col-sm-4 text-right">

                                            <input type="checkbox" name="unity_status[unity]" id="unityStatus"
                                                class="ad-switch" <?php echo $data->unity_status == 'on' ? 'checked' : ''; ?>>

                                            
                                        </div>
                                    </div>
                                </div>
                                <div class="ad-body">
                                    <div class="form-group">
                                        <label for="unityBannerAdmob">Banner Admob ID</label>
                                        <input type="text" name="banner_id[unity]" class="form-control create-form"
                                            id="unityBannerAdmob" value="<?php echo $data->banner_id ?? ''; ?>">
                                    </div>

                                    <div class="form-group">
                                        <label for="unityInteresticialAdmob">Interesticial Admob ID</label>
                                        <input type="text" name="interesticial_id[unity]" class="form-control create-form"
                                            id="unityInteresticialAdmob" value="<?php echo $data->interesticial_id ?? ''; ?>">
                                    </div>
                                    <div class="interesticial-details">
                                        <div class="form-group">
                                            <label for="unityInteresticialAdmobClick">Interesticial Admob Click</label>
                                            <input type="number" name="interesticial_click[unity]"
                                                value="<?php echo $data->interesticial_click ?? ''; ?>" class="form-control create-form"
                                                id="unityInteresticialAdmobClick">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php else: ?>
                <div class="col-md-6 unity-ad margin-top-40">
                    <div class="add-content">
                        <div class="ad-title">
                            <div class="row">
                                <div class="col-md-10 col-sm-8"><span class="title">Unity Ad:</span></div>

                                <input type="hidden" name="ad_type[]" value="unity">


                                <div class="col-md-2 col-sm-4 text-right">
                                    <input type="checkbox" name="unity_status[unity]" id="unityStatus"
                                        class="ad-switch">
                                </div>
                            </div>
                        </div>
                        <div class="ad-body">
                            <div class="form-group">
                                <label for="unityBannerAdmob">Banner Admob ID</label>
                                <input type="text" name="banner_id[unity]" class="form-control create-form"
                                    id="unityBannerAdmob">
                            </div>

                            <div class="form-group">
                                <label for="unityInteresticialAdmob">Interesticial Admob ID</label>
                                <input type="text" name="interesticial_id[unity]" class="form-control create-form"
                                    id="unityInteresticialAdmob">
                            </div>
                            <div class="interesticial-details">
                                <div class="form-group">
                                    <label for="unityInteresticialAdmobClick">Interesticial Admob Click</label>
                                    <input type="number" name="interesticial_click[unity]" class="form-control create-form"
                                        id="unityInteresticialAdmobClick">
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            <?php endif; ?>
            

            
            <?php if(!$target->isEmpty()): ?>
            <?php $__currentLoopData = $target; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if($data->ad_type == 'app_lovin_max'): ?>
                    <div class="col-md-6 custom-ad margin-top-40">
                        <div class="add-content">
                            <div class="ad-title">
                                <div class="row">
                                    <div class="col-md-10 col-sm-8"><span class="title">App Lovin Max Ad:</span></div>

                                    <input type="hidden" name="ad_type[]" value="app_lovin_max">


                                    <div class="col-md-2 col-sm-4 text-right">

                                        <input type="checkbox" name="app_lovin_max_status[app_lovin_max]" id="app_lovin_maxStatus"
                                            class="ad-switch" <?php echo $data->unity_status == 'on' ? 'checked' : ''; ?>>

                                        
                                    </div>
                                </div>
                            </div>
                            <div class="ad-body">
                                <div class="form-group">
                                    <label for="app_lovin_maxBannerAdmob">Banner Admob ID</label>
                                    <input type="text" name="banner_id[app_lovin_max]" class="form-control create-form"
                                        id="app_lovin_maxBannerAdmob" value="<?php echo $data->banner_id ?? ''; ?>">
                                </div>

                                <div class="form-group">
                                    <label for="app_lovin_maxInteresticialAdmob">Interesticial Admob ID</label>
                                    <input type="text" name="interesticial_id[app_lovin_max]" class="form-control create-form"
                                        id="app_lovin_maxInteresticialAdmob" value="<?php echo $data->interesticial_id ?? ''; ?>">
                                </div>
                                <div class="interesticial-details">
                                    <div class="form-group">
                                        <label for="app_lovin_maxInteresticialAdmobClick">Interesticial Admob Click</label>
                                        <input type="number" name="interesticial_click[app_lovin_max]"
                                            value="<?php echo $data->interesticial_click ?? ''; ?>" class="form-control create-form"
                                            id="app_lovin_maxInteresticialAdmobClick">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php else: ?>
            <div class="col-md-6 custom-ad margin-top-40">
                <div class="add-content">
                    <div class="ad-title">
                        <div class="row">
                            <div class="col-md-10 col-sm-8"><span class="title">App Lovin Max Ad:</span></div>

                            <input type="hidden" name="ad_type[]" value="app_lovin_max">


                            <div class="col-md-2 col-sm-4 text-right">
                                <input type="checkbox" name="app_lovin_max_status[app_lovin_max]" id="app_lovin_maxStatus"
                                    class="ad-switch">
                            </div>
                        </div>
                    </div>
                    <div class="ad-body">
                        <div class="form-group">
                            <label for="app_lovin_maxBannerAdmob">Banner Admob ID</label>
                            <input type="text" name="banner_id[app_lovin_max]" class="form-control create-form"
                                id="app_lovin_maxBannerAdmob">
                        </div>

                        <div class="form-group">
                            <label for="app_lovin_maxInteresticialAdmob">Interesticial Admob ID</label>
                            <input type="text" name="interesticial_id[app_lovin_max]" class="form-control create-form"
                                id="app_lovin_maxInteresticialAdmob">
                        </div>
                        <div class="interesticial-details">
                            <div class="form-group">
                                <label for="app_lovin_maxInteresticialAdmobClick">Interesticial Admob Click</label>
                                <input type="number" name="interesticial_click[app_lovin_max]" class="form-control create-form"
                                    id="app_lovin_maxInteresticialAdmobClick">
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        <?php endif; ?>
        

            
            <?php if(!$target->isEmpty()): ?>
                <?php $__currentLoopData = $target; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($data->ad_type == 'iron'): ?>
                        <div class="col-md-12 iron-ad margin-top-40">
                            <div class="add-content">
                                <div class="ad-title">
                                    <div class="row">
                                        <div class="col-md-10 col-sm-8"><span class="title">Iron Source
                                                Ads:</span>
                                        </div>

                                        <input type="hidden" name="ad_type[]" value="iron">


                                        <div class="col-md-2 col-sm-4 text-right">

                                            <input type="checkbox" name="iron_status[iron]" id="ironStatus"
                                                class="ad-switch" <?php echo $data->iron_status == 'on' ? 'checked' : ''; ?>>

                                            
                                        </div>
                                    </div>
                                </div>
                                <div class="ad-body">
                                    <div class="row">
                                        <div class="col-md-6 iron-banner">

                                            <div class="form-group margin-top-20">
                                                <label for="ironBannerAdmob">Enter Your AppKey</label>
                                                <input type="text" name="iron_id[iron]" value="<?php echo $data->iron_id ?? ''; ?>"
                                                    class="form-control create-form" id="ironBannerAdmob">
                                            </div>


                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php else: ?>
                <div class="col-md-12 iron-ad margin-top-40">
                    <div class="add-content">
                        <div class="ad-title">
                            <div class="row">
                                <div class="col-md-10 col-sm-8"><span class="title">Iron Source Ads:</span></div>

                                <input type="hidden" name="ad_type[]" value="iron">


                                <div class="col-md-2 col-sm-4 text-right">
                                    <input type="checkbox" name="iron_status[iron]" id="ironStatus" class="ad-switch">
                                </div>
                            </div>
                        </div>
                        <div class="ad-body">
                            <div class="row">
                                <div class="col-md-6 iron-banner">

                                    <div class="form-group margin-top-20">
                                        <label for="ironBannerAdmob">Enter Your AppKey</label>
                                        <input type="text" name="iron_id[iron]" class="form-control create-form"
                                            id="ironBannerAdmob">
                                    </div>


                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
            


            
            <?php if(!$target->isEmpty()): ?>
                <?php $__currentLoopData = $target; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($data->ad_type == 'next'): ?>
                        <div class="col-md-12 next-ad margin-top-40">
                            <div class="add-content">
                                <div class="ad-title">
                                    <div class="row">
                                        <div class="col-md-10 col-sm-8"><span class="title">App Next Ads:</span>
                                        </div>

                                        <input type="hidden" name="ad_type[]" value="next">


                                        <div class="col-md-2 col-sm-4 text-right">

                                            <input type="checkbox" name="next_status[next]" id="nextStatus"
                                                class="ad-switch" <?php echo $data->next_status == 'on' ? 'checked' : ''; ?>>

                                            
                                        </div>
                                    </div>
                                </div>
                                <div class="ad-body">
                                    <div class="row">
                                        <div class="col-md-6 next-banner">

                                            <div class="form-group margin-top-20">
                                                <label for="nextBannerAdmob">Enter Your PlacementId</label>
                                                <input type="text" name="next_id[next]" value="<?php echo $data->next_id ?? ''; ?>"
                                                    class="form-control create-form" id="nextBannerAdmob">
                                            </div>


                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php else: ?>
                <div class="col-md-12 next-ad margin-top-40">
                    <div class="add-content">
                        <div class="ad-title">
                            <div class="row">
                                <div class="col-md-10 col-sm-8"><span class="title">App Next Ads:</span></div>

                                <input type="hidden" name="ad_type[]" value="next">


                                <div class="col-md-2 col-sm-4 text-right">
                                    <input type="checkbox" name="next_status[next]" id="nextStatus" class="ad-switch">
                                </div>
                            </div>
                        </div>
                        <div class="ad-body">
                            <div class="row">
                                <div class="col-md-6 next-banner">

                                    <div class="form-group margin-top-20">
                                        <label for="nextBannerAdmob">Enter Your PlacementId</label>
                                        <input type="text" name="next_id[next]" class="form-control create-form"
                                            id="nextBannerAdmob">
                                    </div>


                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
            

            <div class="col-md-12 actions margin-top-20">
                <button type="submit" class="submit margin-bottom-20">Update</button>
                <a href="/admin/advertisement" class="cancel">Cancel</a>
            </div>

        </div>
    </form>
    


<?php $__env->stopSection(); ?>
<?php $__env->startPush('custom-js'); ?>
    <script type="text/javascript">
        $(document).on("change", "#googleStatus", function(e) {
            e.preventDefault();
            if (this.checked == true) {
                $('#facebookStatus').prop('checked', false);
                $('#customStatus').prop('checked', false);
                $('#startupStatus').prop('checked', false);
                $('#unityStatus').prop('checked', false);
                $('#ironStatus').prop('checked', false);
                $('#nextStatus').prop('checked', false);
            }
        });
        $(document).on("change", "#facebookStatus", function(e) {
            e.preventDefault();
            if (this.checked == true) {
                $('#googleStatus').prop('checked', false);
                $('#customStatus').prop('checked', false);
                $('#startupStatus').prop('checked', false);
                $('#unityStatus').prop('checked', false);
                $('#ironStatus').prop('checked', false);
                $('#nextStatus').prop('checked', false);
            }
        });
        $(document).on("change", "#customStatus", function(e) {
            e.preventDefault();
            if (this.checked == true) {
                $('#googleStatus').prop('checked', false);
                $('#facebookStatus').prop('checked', false);
                $('#startupStatus').prop('checked', false);
                $('#unityStatus').prop('checked', false);
                $('#ironStatus').prop('checked', false);
                $('#nextStatus').prop('checked', false);
            }
        });

        $(document).on("change", "#startupStatus", function(e) {
            e.preventDefault();
            if (this.checked == true) {
                $('#googleStatus').prop('checked', false);
                $('#facebookStatus').prop('checked', false);
                $('#customStatus').prop('checked', false);
                $('#unityStatus').prop('checked', false);
                $('#ironStatus').prop('checked', false);
                $('#nextStatus').prop('checked', false);
            }
        });

        $(document).on("change", "#unityStatus", function(e) {
            e.preventDefault();
            if (this.checked == true) {
                $('#googleStatus').prop('checked', false);
                $('#facebookStatus').prop('checked', false);
                $('#customStatus').prop('checked', false);
                $('#startupStatus').prop('checked', false);
                $('#ironStatus').prop('checked', false);
                $('#nextStatus').prop('checked', false);
            }
        });

        $(document).on("change", "#ironStatus", function(e) {
            e.preventDefault();
            if (this.checked == true) {
                $('#googleStatus').prop('checked', false);
                $('#facebookStatus').prop('checked', false);
                $('#customStatus').prop('checked', false);
                $('#unityStatus').prop('checked', false);
                $('#startupStatus').prop('checked', false);
                $('#nextStatus').prop('checked', false);
            }
        });

        $(document).on("change", "#nextStatus", function(e) {
            e.preventDefault();
            if (this.checked == true) {
                $('#googleStatus').prop('checked', false);
                $('#facebookStatus').prop('checked', false);
                $('#customStatus').prop('checked', false);
                $('#unityStatus').prop('checked', false);
                $('#startupStatus').prop('checked', false);
                $('#ironStatus').prop('checked', false);
            }
        });

        var loadFileCH = function(event) {
            var image = document.getElementById('CHImg');
            image.src = URL.createObjectURL(event.target.files[0]);
        };
        var loadFileAP = function(event) {
            var image = document.getElementById('APImg');
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
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.default.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ccninfot/movieflix.ccninfotech.com/resources/views/advertisement/mobileAd.blade.php ENDPATH**/ ?>